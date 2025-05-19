# Solicitud de Desarrollo: Gestión de Secciones en el Personalizador de WordPress

## Objetivo Principal
Implementar una funcionalidad en el tema de WordPress `boots2025` que permita al usuario gestionar (reordenar y controlar la visibilidad) de las secciones de la página de inicio directamente desde el Personalizador de WordPress. La interfaz en el Personalizador debe ser similar a la gestión de menús de WordPress.

## Contexto del Tema y Archivos Relevantes
*   **Tema:** `boots2025` (tema personalizado).
*   **Estructura de Secciones:** Las plantillas para las secciones de la página de inicio se encuentran en `wp-content/themes/boots2025/template-parts/sections/` y siguen el patrón de nomenclatura `section-NOMBRESECCION.php` (ej. `section-carousel.php`, `section-productos.php`).
*   **Carga Actual de Secciones (en `index.php`):**
    ```php
    // <?php
    // get_header();
    // ?>
    // <div id="home-sections-container"> // Contenedor principal para las secciones
        // <?php
        // // Lógica actual para cargar secciones (probablemente get_template_part() para cada una)
        // // Ejemplo original era estático:
        // // get_template_part( 'template-parts/sections/section', 'carousel' );
        // // get_template_part( 'template-parts/sections/section', 'productos' );
        // // ...etc.
        // // Esto se reemplazará por una carga dinámica basada en los settings del Personalizador.
        // ?>
    // </div>
    // <?php
    // get_footer();
    // ?>
    ```
*   **Archivos del Personalizador Existentes:**
    *   `inc/customizer.php`: Contiene la configuración actual del personalizador (para estilos del tema).
    *   `inc/customizer-dynamic-css.php`: Genera CSS dinámico.
    *   `assets/js/customizer-preview.js`: Maneja la previsualización en vivo para los estilos del tema.
*   **Archivos a Crear/Modificar (Sugeridos):**
    *   `inc/customizer-section-manager.php` (nuevo): Para la lógica del nuevo panel/sección, settings y control personalizado.
    *   `assets/js/customizer-section-manager.js` (nuevo): Para el JavaScript del control personalizado (drag & drop, interacción con el ojo).
    *   `assets/css/customizer-section-manager-control.css` (nuevo): Para los estilos del control.
    *   `functions.php` (modificar): Para incluir los nuevos archivos PHP.
    *   `index.php` (modificar): Para cargar dinámicamente las secciones.
    *   `assets/js/customizer-preview.js` (modificar): Para la previsualización en vivo del orden y visibilidad.
    *   Archivos en `template-parts/sections/` (modificar): Para añadir `id="section-SLUG"` y `class="home-section"` a cada plantilla.

## Requisitos Detallados

### 1. Nueva Sección/Panel en el Personalizador
*   Crear una nueva **Sección** de nivel superior en el Personalizador (similar a "Estilos del Tema Boots2025" o "Menús").
    *   **Título Sugerido:** "Gestión de Secciones del Inicio"
    *   **ID Sugerido:** `boots2025_section_manager_section`
    *   **Prioridad:** Apropiada para que aparezca lógicamente (ej. `35`).

### 2. Detección Automática de Secciones
*   El sistema debe escanear el directorio `template-parts/sections/` para encontrar todos los archivos `section-*.php`.
*   Para cada archivo, extraer un "slug" (ej. de `section-productos.php` el slug es `productos`) y un nombre legible (se puede intentar leer un comentario `// Nombre Sección: Mis Productos` dentro del archivo, o por defecto convertir el slug a título, ej. "Productos").

### 3. Settings del Personalizador
*   **Orden de Secciones:**
    *   ID: `boots2025_home_sections_order`
    *   Tipo: `theme_mod`
    *   Valor: Un array de slugs de sección en el orden deseado.
    *   Default: Un array con los slugs de todas las secciones detectadas, en su orden alfabético o de archivo.
    *   Transport: `'refresh'` (para asegurar que la previsualización se actualice correctamente, especialmente con componentes complejos como carruseles).
    *   Sanitize Callback: Una función que asegure que el valor sea un array de strings (keys sanitizadas).
*   **Visibilidad de Secciones:**
    *   ID: `boots2025_home_sections_visibility`
    *   Tipo: `theme_mod`
    *   Valor: Un array asociativo `[ 'slug_seccion' => true/false, ... ]`.
    *   Default: Un array asociativo con todos los slugs de sección detectados, todos con valor `true` (visibles).
    *   Transport: `'refresh'` (inicialmente se intentó `'postMessage'`, pero causó problemas; `'refresh'` es más robusto para asegurar que el botón "Publicar" se active y la previsualización sea consistente).
    *   Sanitize Callback: Una función que asegure que sea un array asociativo con claves sanitizadas y valores booleanos.

### 4. Control Personalizado en el Personalizador
*   Crear una clase PHP que extienda `WP_Customize_Control` para manejar la lista de secciones.
    *   ID del Control: `boots2025_home_sections_control`
    *   Asignado a la sección `boots2025_section_manager_section`.
    *   Vinculado al setting `boots2025_home_sections_order` (el setting de visibilidad se manejará indirectamente a través de JS).
*   **Renderizado del Control (`render_content()`):**
    *   Debe mostrar una lista `<ul>` de las secciones detectadas.
    *   Cada `<li>` debe representar una sección y tener:
        *   Un `data-section-slug` con el slug de la sección.
        *   Un ícono de arrastre (ej. `dashicons-sort` o `dashicons-menu`).
        *   El nombre legible de la sección.
        *   Un control de visibilidad (un checkbox oculto y un `<label>` con un ícono de ojo `dashicons-visibility` / `dashicons-hidden`).
    *   La lista debe ser ordenable usando jQuery UI Sortable.
    *   Un `<input type="hidden">` vinculado (`$this->link()`) al setting `boots2025_home_sections_order` para ayudar con la comunicación inicial del orden.
*   **JavaScript del Control (`assets/js/customizer-section-manager.js`):**
    *   Inicializar jQuery UI Sortable en la lista.
        *   En el evento `update` de sortable:
            *   Recopilar el nuevo orden de slugs.
            *   Actualizar el valor del input oculto.
            *   Llamar a `wp.customize('boots2025_home_sections_order').set(newOrderArray);`.
    *   Manejar el evento `change` del checkbox de visibilidad:
        *   Obtener el slug de la sección y el nuevo estado de visibilidad.
        *   Actualizar el objeto de visibilidad global.
        *   Llamar a `wp.customize('boots2025_home_sections_visibility').set(newVisibilityObject);`.
        *   Cambiar la clase del ícono del ojo (`dashicons-visibility` / `dashicons-hidden`).
        *   **Importante:** "Tocar" el setting `boots2025_home_sections_order` (ej. `orderSetting.set([]); orderSetting.set(tempOrder);`) después de cambiar la visibilidad para asegurar que el botón "Publicar" del Customizer se active, ya que ambos settings ahora usan `transport='refresh'`.
*   **CSS del Control (`assets/css/customizer-section-manager-control.css`):**
    *   Estilizar los ítems de la lista para que se parezcan a los ítems de menú de WordPress (bordes, padding, área de cabecera, etc.).
    *   Asegurar que el ícono de arrastre y el ojo sean claros y funcionales.
*   **Enqueue de Assets:** Encolar el JS y CSS del control desde el método `enqueue()` de la clase del control.

### 5. Carga Dinámica en el Frontend (`index.php`)
*   Modificar `index.php` para:
    *   Obtener el orden de secciones desde `get_theme_mod('boots2025_home_sections_order', DEFAULT_ORDER_ARRAY)`.
    *   Obtener los estados de visibilidad desde `get_theme_mod('boots2025_home_sections_visibility', DEFAULT_VISIBILITY_OBJECT)`.
    *   Recorrer las secciones según el orden guardado.
    *   Para cada sección, si está marcada como visible, cargar su plantilla usando `get_template_part('template-parts/sections/section', $section_slug)`.
    *   Asegurar que el contenedor principal de las secciones en `index.php` tenga `id="home-sections-container"`.

### 6. Modificación de Plantillas de Sección
*   Cada archivo de plantilla en `template-parts/sections/` (ej. `section-productos.php`) debe tener su elemento HTML raíz modificado para incluir:
    *   `id="section-SLUG"` (ej. `id="section-productos"`)
    *   `class="home-section"` (además de cualquier otra clase existente).
    *   Si la sección es un carrusel (ej. `section-carousel.php`), cualquier `data-bs-target` interno que apunte a su propio ID también debe actualizarse.

### 7. Previsualización en Vivo (`assets/js/customizer-preview.js`)
*   Dado que ambos settings (`order` y `visibility`) ahora usarán `transport='refresh'`, la lógica compleja de `postMessage` en `customizer-preview.js` para estos dos settings específicos ya no es necesaria y puede ser eliminada o comentada. El refresco automático del Customizer se encargará de actualizar la previsualización.

## Consideraciones Adicionales
*   Asegurar que la función `get_file_data()` esté disponible en `inc/customizer-section-manager.php` (ej. `if ( ! function_exists( 'get_file_data' ) ) { require_once ABSPATH . 'wp-admin/includes/file.php'; }`).
*   Probar exhaustivamente el guardado de cambios, la activación del botón "Publicar", y la correcta visualización en el frontend y en la previsualización del Personalizador después de cada recarga.
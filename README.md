# Tema Boots2025 - Opciones de Personalización (v1.0)

Este tema de WordPress (`boots2025`) incluye opciones de personalización que te permiten modificar la apariencia de tu sitio directamente desde el Personalizador de WordPress ("Apariencia" > "Personalizar").

## Funcionalidades Implementadas

Actualmente, puedes personalizar los siguientes aspectos de tu tema a través de la sección **"Estilos del Tema Boots2025"** en el Personalizador:

### 1. Colores
Puedes ajustar los colores principales de tu sitio:

*   **Color de Fondo del Cuerpo**: Cambia el color de fondo general de tus páginas.
    *   *Previsualización en vivo*: Sí.
    *   *Valor por defecto*: Blanco (`#FFFFFF`).
*   **Color de Texto Principal del Cuerpo**: Modifica el color del texto principal en tus páginas.
    *   *Previsualización en vivo*: Sí.
    *   *Valor por defecto*: Gris oscuro (`#212529`).
*   **Color de Fondo del Header**: Establece el color de fondo para la barra de navegación principal.
    *   *Previsualización en vivo*: Sí (confirmado recientemente).
    *   *Valor por defecto*: Gris claro (`#f8f9fa`).
*   **Color de Texto del Header (Enlaces Navbar)**: Cambia el color de los enlaces y el título/logo en la barra de navegación.
    *   *Previsualización en vivo*: Funcional.
    *   *Guardado y Frontend*: Funcional.
    *   *Valor por defecto*: Gris oscuro (`#212529`).
*   **Color de Fondo del Footer**: Define el color de fondo para el pie de página.
    *   *Previsualización en vivo*: Por confirmar/depurar. El cambio se aplica al publicar.
    *   *Valor por defecto*: Gris claro (`#f8f9fa`).
*   **Color de Texto del Footer**: Modifica el color del texto en el pie de página.
    *   *Previsualización en vivo*: Por confirmar/depurar. El cambio se aplica al publicar.
    *   *Valor por defecto*: Gris oscuro (`#212529`).

### 2. Tipografía
Puedes seleccionar una fuente principal para todo tu sitio:

*   **Fuente Principal del Sitio**: Elige entre una selección de 6 fuentes comunes para aplicar globalmente al cuerpo del texto y a los encabezados.
    *   *Opciones*: Sistema Sans-serif (Defecto), Georgia (Serif), Verdana (Sans-serif), Courier New (Monospace), Times New Roman (Serif), Arial (Sans-serif).
    *   *Previsualización en vivo*: Sí.
    *   *Guardado y Frontend*: Sí.
    *   *Valor por defecto*: Sistema Sans-serif.
    *   *Nota*: La opción "Courier New (Monospace)" actualmente aplica la familia genérica `monospace` (esto fue un cambio para depuración, se puede restaurar la pila completa `"Courier New", Courier, monospace"`).

### 3. Tamaños de Fuente
Ajusta los tamaños de fuente para elementos clave:

*   **Tamaño de Fuente del Cuerpo (px)**: Define el tamaño base para el texto del cuerpo. (Defecto: 16px)
    *   *Previsualización en vivo*: Sí.
    *   *Guardado y Frontend*: Sí.
*   **Tamaño de Fuente H1 (px)**: Define el tamaño para los encabezados de nivel 1 (`<h1>`). (Defecto: 40px)
    *   *Previsualización en vivo*: Sí.
    *   *Guardado y Frontend*: Sí.

### Separadores Visuales
Dentro del panel del Personalizador, se han añadido líneas horizontales (`<hr>`) para separar visualmente los grupos de opciones (Colores, Tipografía, Tamaños de Fuente). Los valores por defecto también se muestran en los labels de los controles de fuente y tamaño.

### Guía de Estilos
Para ayudarte a ver el impacto de tus cambios, puedes crear una página en WordPress usando la plantilla "**Guía de Estilos Bootstrap**". Esta página mostrará varios componentes comunes de Bootstrap, permitiéndote previsualizar tus personalizaciones.
Para usarla:
1.  Crea una nueva Página en WordPress.
2.  Asígnale la plantilla "Guía de Estilos Bootstrap".
3.  Publica y navega a esta página en el Personalizador.

## Cómo Usar
1.  Ve a "Apariencia" > "Personalizar" en tu panel de WordPress.
2.  Busca la sección "Estilos del Tema Boots2025".
3.  Ajusta las opciones según tus preferencias.
4.  Observa los cambios en la ventana de previsualización.
5.  Haz clic en "Publicar" para guardar tus cambios y aplicarlos a tu sitio en vivo.

## Archivos Modificados/Creados
La funcionalidad del Personalizador se encuentra principalmente en los siguientes archivos dentro del tema:
*   `inc/customizer.php`: Define las secciones, settings y controles.
*   `inc/customizer-dynamic-css.php`: Genera el CSS dinámico para el frontend.
*   `assets/js/customizer-preview.js`: Maneja la previsualización en vivo.
*   `template-styleguide.php`: Plantilla para la página de guía de estilos.
*   `functions.php`: Carga los archivos del Personalizador.

---
*Nota: El estado de la previsualización en vivo para los colores del footer y el texto del header necesita una verificación final. La pila de fuentes para "Courier New" está simplificada a `monospace`.*

<?php
/**
 * Template Name: Guía de Estilos Bootstrap
 *
 * @package Boots2025
 */

get_header();
?>

<div class="container py-5">
	<header class="mb-5">
		<h1><?php the_title(); ?></h1>
		<p class="lead">Esta página muestra varios componentes de Bootstrap para previsualizar los cambios del Personalizador.</p>
	</header>

	<section class="mb-5">
		<h2>Tipografía</h2>
		<h1>Encabezado h1</h1>
		<h2>Encabezado h2</h2>
		<h3>Encabezado h3</h3>
		<h4>Encabezado h4</h4>
		<h5>Encabezado h5</h5>
		<h6>Encabezado h6</h6>
		<p class="lead">Párrafo lead: Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
		<p>Este es un párrafo de texto normal. Contiene <strong>texto en negrita</strong>, <em>texto en cursiva</em>, y un <a href="#">enlace de ejemplo</a>. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		<blockquote>
			<p class="mb-0">Esto es una cita (blockquote).</p>
			<footer class="blockquote-footer">Alguien famoso en <cite title="Source Title">Título de la Fuente</cite></footer>
		</blockquote>
		<ul>
			<li>Elemento de lista desordenada 1</li>
			<li>Elemento de lista desordenada 2
				<ul>
					<li>Sub-elemento</li>
				</ul>
			</li>
		</ul>
		<ol>
			<li>Elemento de lista ordenada 1</li>
			<li>Elemento de lista ordenada 2</li>
		</ol>
	</section>

	<section class="mb-5">
		<h2>Botones</h2>
		<p>
			<button type="button" class="btn btn-primary">Primario</button>
			<button type="button" class="btn btn-secondary">Secundario</button>
			<button type="button" class="btn btn-success">Éxito</button>
			<button type="button" class="btn btn-danger">Peligro</button>
			<button type="button" class="btn btn-warning">Advertencia</button>
			<button type="button" class="btn btn-info">Info</button>
			<button type="button" class="btn btn-light">Claro</button>
			<button type="button" class="btn btn-dark">Oscuro</button>
			<button type="button" class="btn btn-link">Enlace</button>
		</p>
		<p>
			<button type="button" class="btn btn-outline-primary">Primario Outline</button>
			<button type="button" class="btn btn-outline-secondary">Secundario Outline</button>
		</p>
		<p>
			<button type="button" class="btn btn-primary btn-lg">Botón Grande</button>
			<button type="button" class="btn btn-secondary btn-sm">Botón Pequeño</button>
		</p>
	</section>

	<section class="mb-5">
		<h2>Alertas</h2>
		<div class="alert alert-primary" role="alert">
			Una alerta simple de tipo primary—¡compruébalo!
		</div>
		<div class="alert alert-secondary" role="alert">
			Una alerta simple de tipo secondary—¡compruébalo!
		</div>
		<div class="alert alert-success" role="alert">
			Una alerta simple de tipo success—¡compruébalo!
		</div>
		<div class="alert alert-danger" role="alert">
			Una alerta simple de tipo danger—¡compruébalo!
		</div>
		<div class="alert alert-warning" role="alert">
			Una alerta simple de tipo warning—¡compruébalo!
		</div>
		<div class="alert alert-info" role="alert">
			Una alerta simple de tipo info—¡compruébalo!
		</div>
		<div class="alert alert-light" role="alert">
			Una alerta simple de tipo light—¡compruébalo!
		</div>
		<div class="alert alert-dark" role="alert">
			Una alerta simple de tipo dark—¡compruébalo!
		</div>
	</section>

	<section class="mb-5">
		<h2>Tarjetas (Cards)</h2>
		<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h5 class="card-title">Título de la Tarjeta</h5>
				<h6 class="card-subtitle mb-2 text-muted">Subtítulo de la tarjeta</h6>
				<p class="card-text">Un texto de ejemplo rápido para construir sobre el título de la tarjeta y componer la mayor parte del contenido de la tarjeta.</p>
				<a href="#" class="card-link">Enlace de tarjeta</a>
				<a href="#" class="card-link">Otro enlace</a>
			</div>
		</div>
	</section>
	
	<?php
	// Puedes añadir más secciones de componentes de Bootstrap aquí
	// Ej: Formularios, Tablas, Badges, Navbars de ejemplo, etc.
	// Copia el HTML de la documentación de Bootstrap: getbootstrap.com
	?>

</div><!-- /.container -->

<?php
get_footer();
?>

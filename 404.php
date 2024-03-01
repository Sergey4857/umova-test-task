<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package umova
 */

get_header();
?>
<section class="page-container">
	<div class="page_content">
		<h1 class="page_title">
			<?php esc_html_e('Oops! That page can&rsquo;t be found.', 'umova'); ?>
		</h1>
		<p>
			<?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'umova'); ?>
		</p>
		<?php get_search_form(); ?>
	</div>
</section>




<?php
get_footer();

<?php
get_header();
?>
<main class="col-md-8 site-main bg-white primary">
		<?php if ( have_posts() ) : ?>

			<?php
			/* 遍历文章列表 */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content');

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();

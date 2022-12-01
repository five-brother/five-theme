<?php
get_header();
?>

<main class="col-md-8 site-main bg-white">


		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="h3 mt-4 page-title ">
					<?php
					printf('关于【%s】的搜索结果：', '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'search' );

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

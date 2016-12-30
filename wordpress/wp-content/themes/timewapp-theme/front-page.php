<?php
/**
 * This is the frontpage template.
 */
get_header();

$args = array(
	'post_type'      => 'projects',
	'order'          => 'ASC',
	'order_by'       => 'name'
);

$query = new WP_Query( $args );
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
			<?php while ( $query->have_posts() ) : $query->the_post() ?>
				<a id="post-<?php the_ID(); ?>" class="project-wrap" href="<?php the_permalink(); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'frontpage-project' ); ?>>
						<div class="project-header">
							<h2>
								<?php the_title(); ?>
								<small>
									<?php $client = get_field( 'choose_client' ); ?>
									Client: <?php echo $client->post_title; ?>
								</small>
							</h2>
						</div><!-- .entry-header -->

						<div class="project-total-time text-center">
							<span class="total-time">Time Spent</span>
							<p>xx:xx:xx</p>
						</div>

					</article><!-- #post-## -->
				</a>
			<?php endwhile; ?>
		<?php endif; ?>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>

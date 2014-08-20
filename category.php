<?php Nuclear::render_template($header_templates); ?>
	<?php if (have_posts()): ?>

		<h2>Category Archive: <?php echo single_cat_title( '', false ); ?></h2>

		<ol class="list-unstyled">
			<?php while (have_posts()) : the_post(); ?>
				<li>
					<article id="post-<?php the_ID(); ?>" <?php post_class('cf entry'); ?> role="article">

						<header class="entry-header">
							<h1 class="entry-title single-title">
								<a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
							</h1>
							<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
								<?php the_date(); ?> <?php the_time(); ?>
							</time>
							<?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
						</header>

						<section class="cf entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages([
								'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:') . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
			                ]); ?>
						</section>

					</article>
				</li>
			<?php endwhile; ?>
		</ol>
	<?php else: ?>
		<h2>No posts to display in <?php echo single_cat_title( '', false ); ?></h2>
	<?php endif; ?>

<?php Nuclear::render_template($footer_templates); ?>

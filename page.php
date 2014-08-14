<?php Nuclear::render_template($header_templates); ?>
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('cf entry'); ?> role="article" itemscope>

			<header class="article-header">
				<h1 class="article-title single-title" itemprop="headline">
					<a href="<?php esc_url(the_permalink()); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h1>
				<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> 
				<?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
			</header>

			<section itemprop="articleBody" class="cf article-content">
				<?php the_content(); ?>
				<?php wp_link_pages([
						'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:') . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
               ]); ?>
			</section>

			<footer class="article-footer">

			</footer>

			<?php comments_template(); ?>

		</article>

	<?php endwhile; else : ?>

		<article id="post-not-found" class="hentry cf">

			<header class="article-header">
				<h1 class="article-title single-title" itemprop="headline">
					<?php __('Page not found.'); ?>
				</h1>
			</header>

			<section class="article-content">
				<p><?php __('Uh Oh. Something is missing. Try double checking things.'); ?></p>
			</section>

			<footer class="article-footer">
				<p><?php _e('This is the error message in the page.php template.'); ?></p>
			</footer>

		</article>

	<?php endif; ?>
<?php Nuclear::render_template($footer_templates); ?>

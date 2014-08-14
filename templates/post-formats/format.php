<article id="post-<?php the_ID(); ?>" <?php post_class('cf entry'); ?> role="article" itemscope>

	<header class="article-header">
		<h1 class="article-title single-title" itemprop="headline">
			<a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">
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

	<?php if (get_the_author_meta('description')): ?>
		<aside>
			<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
			<h3>About <?php echo get_the_author(); ?></h3>
			<?php the_author_meta('description'); ?>
		</aside>
	<?php endif; ?>

	<footer class="article-footer">

	</footer>

	<?php comments_template(); ?>

</article>

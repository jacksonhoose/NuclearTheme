<?php Nuclear::render_template($header_templates); ?>
	<?php if ( have_posts() ): ?>
		<h2>Search Results for '<?php echo get_search_query(); ?>'</h2>
		<ol>
			<?php while ( have_posts() ) : the_post(); ?>
				<li>
					<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">
						<header class="article-header">
							<h3 class="search-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						</header>

						<section class="entry-content">
							<?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'bonestheme' ) . '</span>' ); ?>
						</section>
					</article>
				</li>
			<?php endwhile; ?>
		</ol>
	<?php else: ?>
		<h2>No results found for '<?php echo get_search_query(); ?>'</h2>
	<?php endif; ?>
<?php Nuclear::render_template($footer_templates); ?>

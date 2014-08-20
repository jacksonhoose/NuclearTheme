<?php Nuclear::render_template($header_templates); ?>

	<?php if (have_posts()): while (have_posts()): the_post(); ?>

		<?php get_template_part('templates/post-formats/format', get_post_format()); ?>

	<?php endwhile; ?>

	<?php else: ?>

		<h1>Sorry, page not found.</h1>

	<?php endif; ?>

<?php Nuclear::render_template($footer_templates); ?>

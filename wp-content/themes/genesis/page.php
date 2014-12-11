<?php get_header(); ?>
<?php global $post; while (have_posts()) :the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="title"><?php the_title() ?></h1>
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        <?php edit_post_link('Edit this entry.', '<p class="clear">', '</p>'); ?>
    </div>
<?php endwhile; ?>


<?php get_footer(); ?>

<?php global $post; while (have_posts()) :the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="title"><?php the_title() ?></h1>
       
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        <?php edit_post_link('Edit this entry.', '<p class="clear">', '</p>'); ?>
    </div>
    <?php
	$tags = wp_get_post_tags($post->ID);
	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	
		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'showposts'=>3, // Number of related posts that will be shown.
			'caller_get_posts'=>1
		);
		$my_query = new wp_query($args);
		if( $my_query->have_posts() ) {
			echo '<div class="related"><h3><span>Bài viết liên quan</span></h3><ul>';
			while ($my_query->have_posts()) {
				$my_query->the_post();
			?>
				<li><?php img2(157,100) ?>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php
			}
			echo '</ul></div>';
		}
	}
	?>
    <?php
		$categories = get_the_category($post->ID);
		if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		
			$args=array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
				'showposts'=>3, // Number of related posts that will be shown.
				'caller_get_posts'=>1
			);
		$my_query = new wp_query($args);
		if( $my_query->have_posts() ) {
			echo '<div class="related"><h3><span></span></h3><ul>';
			while ($my_query->have_posts()) {
				$my_query->the_post();
			?>
				<li><?php img2(157,100) ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php
			}
			echo '</ul></div>';
			wp_reset_query();
		}
	}
	?>


<?php endwhile; ?>

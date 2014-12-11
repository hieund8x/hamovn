<h1 class="title arc_title"><span>Search</span> Result</h1>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php img2(130,100); ?>
		<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'genesis' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <p class="headline_meta"><span class="sep">Viết ngày </span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><time class="entry-date" datetime="<?php the_time(__('d/m/Y','genesis')) ?>" pubdate><?php the_time(__('d/m/Y','genesis')) ?></time></a><span class="by-author"> <span class="sep"> bởi </span> <span class="author vcard"><?php the_author(); ?></span></span></p>
		<?php the_excerpt(); ?>
	</div>
<?php endwhile; else: ?>
	<h1>No post found</h1>
<?php endif; ?> 
<?php if(function_exists('wp_paginator')) { wp_paginator(); } ?>

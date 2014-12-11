<h1 class="title arc_title">
	<span>
    <?php if ( is_day() ) : ?>
    <?php printf( __( 'Daily Archives: <span>%s</span>', 'genesis' ), get_the_date() ); ?>
    <?php elseif ( is_month() ) : ?>
    <?php printf( __( 'Monthly Archives: <span>%s</span>', 'genesis' ), get_the_date('F Y') ); ?>
    <?php elseif ( is_year() ) : ?>
    <?php printf( __( 'Yearly Archives: <span>%s</span>', 'genesis' ), get_the_date('Y') ); ?>
    <?php elseif ( is_category() ) : ?>
    <?php single_cat_title(''); ?>
    <?php elseif ( is_tag() ) : ?>
    <?php single_term_title(''); ?>
    <?php else : ?>
    <?php __( 'Blog Archives', 'genesis' ); ?>
    <?php endif; ?>
    </span>
</h1>
<?php while (have_posts()) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php img2(130,100); ?>
		<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'genesis' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <p class="headline_meta"><span class="sep">Viết ngày </span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><time class="entry-date" datetime="<?php the_time(__('d/m/Y','genesis')) ?>" pubdate><?php the_time(__('d/m/Y','genesis')) ?></time></a></p>
		<?php the_excerpt(); ?>
	</div>
<?php endwhile;?>
<?php page_navi(); ?>

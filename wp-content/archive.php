
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="main-content">

		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h1> THƯ MỤC &#8216;<?php single_cat_title(); ?>&#8217;     </h1>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h3>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h3>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h3>Archive for <?php the_time('F jS, Y'); ?></h3>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h3>Archive for <?php the_time('F, Y'); ?></h3>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h3>Archive for <?php the_time('Y'); ?></h3>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h3>Author Archive</h3>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['4']) && !empty($_GET['4'])) { ?>
				<h3>Blog Archives</h3>
			
			<?php } ?>

 <div class="post">
    	<?php
            while( have_posts()): the_post(); ?>
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>                 
                        <p><?php the_excerpt(); ?></p>
                 
         <?php endwhile; ?>
	
   </div>
	<?php  endif; ?>
			
		</div>
        
<?php get_sidebar('second'); ?>

<?php get_footer(); ?>
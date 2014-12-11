<?php get_header(); ?>

<ul class="double-cloumn clearfix">
    <li id="left-column">		
		<h4 class="section-title"><?php _e("Your Search Results for");?> "<em><?php the_search_query(); ?></em>"</h4>
        <ul class="blog-main-post-container">
			<?php if (have_posts()) :
                global $show_author;
                $show_author = 1;
                while (have_posts()) :	the_post(); setup_postdata($post);
                    include(TEMPLATEPATH."/functions/fetch-list.php");
                endwhile;
            else :
                ocmx_no_posts();
            endif; ?>
        </ul> 
                <?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
    	<?php comments_template(); ?>
	</li>
	<?php get_sidebar(); ?>
</ul>
<?php get_footer(); ?>
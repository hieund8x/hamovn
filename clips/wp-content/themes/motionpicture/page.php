<?php get_header(); ?>

<?php $hd_video = get_post_meta($post->ID, "hd_video", true); ?>

<?php if ($hd_video == "yes") : ?>
	<?php if (have_posts()) :
        global $show_author, $post;
        $show_author = 1;
        while (have_posts()) : the_post(); setup_postdata($post);
            get_template_part("/functions/fetch-video");
        endwhile; 
    endif;
endif;?>
<ul class="double-cloumn clearfix">
    <li id="left-column">
        <ul class="blog-main-post-container">
            <li class="post clearfix">
                <?php if (have_posts()) :
                    global $show_author, $post;
                    $show_author = 1;
                    while (have_posts()) : the_post(); setup_postdata($post);
                       get_template_part("/functions/fetch-post");
                    endwhile;
                else :
                    ocmx_no_posts();
                endif; ?> 
                <?php if(comments_open()){comments_template();} ?>
    		</li>
    	</ul>
    </li>
    <?php get_sidebar(); ?>
</ul>
<?php get_footer(); ?>
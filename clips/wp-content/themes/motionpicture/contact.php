<?php 
/*
Template Name: Contact */
get_header(); ?>


<ul class="double-cloumn clearfix">
    <li id="left-column">
        <ul class="blog-main-post-container">
            <li class="post clearfix">
                <?php if (have_posts()) :
                    global $show_author, $post;
                    $show_author = 1;
                    while (have_posts()) : the_post(); setup_postdata($post); ?>
                       <div class="post-title-block">
                         <h2 class="post-title typography-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
                       </div>
	                   <div class="copy <?php echo $image_class; ?> clearfix">
                       <?php the_content(""); ?>
                       </div>  
                  <?php endwhile; endif; ?> 
    		</li>
    	</ul>
    </li>
    <?php get_sidebar(); ?>
</ul>
<?php get_footer(); ?>
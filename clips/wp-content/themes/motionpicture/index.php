<?php get_header(); ?>
<?php dynamic_sidebar(1); ?>

<?php if(get_option("ocmx_home_page_layout") == "widget") :
	if (function_exists('dynamic_sidebar') && is_active_sidebar(2)) : ?> 
	<div id="widget-block" class="clearfix">
		<ul class="widget-list">
			<?php dynamic_sidebar(2); ?>
		</ul>
	</div>
	<?php endif; 
else : ?>
	<ul class="double-cloumn clearfix">
		<li id="left-column">
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
		</li>
		<?php get_sidebar(); ?>
	</ul>
<?php endif; ?>
<?php get_footer(); ?>
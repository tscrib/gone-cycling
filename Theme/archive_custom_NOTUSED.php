<?php 


$layout=theme_get_option('archives','layout');
get_header(); ?>
<?php theme_generator('introduce');?>
<div id="page">
	<div class="inner right_sidebar">
		<div id="main">
			<?php theme_generator('breadcrumbs');?>
			<div class="content">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div class="content">
						<?php the_content(); ?>
						<?php edit_post_link(__('Edit', 'striking_front'),'<footer><p class="entry_edit">','</p></footer>'); ?>
						<div class="clearboth"></div>
					</div>
				<?php endwhile; ?>
				<div class="clearboth"></div>

<?php 
	$archive_query = new WP_Query( array('showposts' => 1000,'category__not_in' => $exclude_cats ));
?>
				<ul>
<?php while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __("Permanent Link to %s", 'striking_front'), get_the_title() ); ?>"><?php the_title(); ?></a> (<?php comments_number('0', '1', '%'); ?>)</li>
<?php endwhile; ?>
				</ul>


			</div>
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>






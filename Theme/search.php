<?php get_header(); ?>
<?php theme_generator('introduce');?>
<div id="page">
	<div class="inner right_sidebar">
		<div id="main">
			<?php theme_generator('breadcrumbs');?>
			<div class="content">
			<?php 
				$exclude_cats = theme_get_option('blog','exclude_categorys');
				foreach ($exclude_cats as $key => $value) {
					$exclude_cats[$key] = -$value;
				}
				$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$s = get_query_var('s');
// To fix integration with Relevanssi
//				query_posts("s=$s&paged=$page&cat=".implode(",",$exclude_cats));
				get_template_part( 'loop','search');
			?>
				<div class="clearboth"></div>
			</div>
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
		</div>
		<?php get_sidebar(); ?>
<!--
		<div>Is search? <?php //echo is_search()?></div>
	<div>Post Id: <?php //echo $post->ID?></div>
	<div>sidebar: <?php //echo $sidebar?></div>
	<div>sidebar names: <?php //echo $post_id->sidebar_names['single']?></div>
-->
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>

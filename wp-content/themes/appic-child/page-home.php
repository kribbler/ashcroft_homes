<?php
/*
 * Template Name: Home Page Child
 */

// hiding breadcrumbs for this template
ThemeFlags::set('hide_breadcrumbs', true);

get_header();
?>
<div class="clearfix"></div>
<?php 
if ($_SERVER['REMOTE_ADDR'] != '83.103.200.163'){?>

	<div class="container">
	<?php echo do_shortcode( '[rev_slider homepage]' );?>
	</div>
<?php } ?>

<div class="white-wrap container page-content" style="display: none">
	<?php if (have_posts()): ?>
		<?php while(have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>
</div>

<div id="home_block1" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=39 ]');
			else 
				echo do_shortcode('[content_block id=67 ]'); 
		?>
	</div>
</div>

<div class="clearfix"></div>

<div id="home_block2" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=41 ]');
			else 
				echo do_shortcode('[content_block id=69 ]'); 
		?>
		<div class="clearfix"></div>
	</div>
</div>

<div class="clearfix"></div>

<div id="home_block3" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=43 ]');
			else 
				echo do_shortcode('[content_block id=71 ]'); 
		?>
	</div>
</div>

<div class="clearfix"></div>

<div id="home_block4" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=45 ]');
			else 
				echo do_shortcode('[content_block id=73 ]'); 
		?>
	</div>
</div>

<div class="clearfix"></div>

<div id="home_block5" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=94 ]');
			else 
				echo do_shortcode('[content_block id=75 ]'); 
		?>
	</div>
</div>

<div class="clearfix"></div>

<?php get_footer(); ?>
<?php	
	get_header();	
	while(have_posts()):the_post();
?>
<div class="about_heading">
	<h2><?php the_title(); ?></h2>	
</div>
<div class="about_us">
	<div class="container">
		<div class="about_right">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php
			the_content();
		?>
	</div>
</div>
<div class="services about_Services">
	<div class="container">		
		<h2><?php echo get_option('sd_service_heading_text');?></h2>
		<ul>
			<?php
				$args = array(
					'post_type'			=> array('best_services'),
					'posts_per_page'	=> -1,
					'post_status'		=> 'publish',
					'order' 			=> 'ASC'			
				); 									
				$services = new wp_query( $args);
				if( $services->have_posts() ):
					while ( $services->have_posts() ) : $services->the_post();
			?>
						<li>
							<div class="services_img">
								<?php the_post_thumbnail(); ?>
							</div>
							<div class="services_details">
								<h6><?php the_title(); ?></h6>
								<?php the_content(); ?>
							</div>
						</li>
			<?php
					endwhile;
				endif;
			?>		
		</ul>
	</div>
</div>
<?php
	endwhile;
	get_footer();
?>
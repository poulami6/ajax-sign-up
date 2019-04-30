<?php
	get_header();

	include( get_template_directory().'/template-parts/home-banner.php');
?>
 <!-- content -->
            <div id="content" class="site-content">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <div class="section text-center no-padding">
                            <div class="peach-bg" style="background-image: url('<?php bloginfo('template_url'); ?>/images/curve.jpg');">
                                <div class="container">
                                    <h3>Our Services</h3>
                                    <ul class="service-block">
                                        <?php
                                            $args =array( 
                                                'post_type' => 'service',
                                                'posts_per_page' => '8',
                                                'order_by' => 'date',
                                                'order'  => 'ASC'
                                            );
                                            $query = new wp_query($args);
                                            if($query->have_posts()){
                                                while($query->have_posts()):$query->the_post();
                                        ?>
                                                    <li>
                                                        <div class="service-image">
                                                            <div class="service-image-inner">
                                                                <?php the_post_thumbnail('loop_service'); ?>
                                                            </div>
                                                        </div>
                                                        <h3><?php the_title(); ?></h3>
                                                        <?php the_content();  ?>
                                                    </li>
                                        <?php
                                                endwhile;
                                            }
                                            wp_reset_query();
                                        ?>
                                    </ul>
                                    <a href="javascript:void(0)" class="btn green-btn"><?php echo get_field('service_custom_text',get_the_ID()); ?></a>
                                </div>
                            </div>
                        </div><!-- section -->
                        <div class="section text-center how-it-section">
                            <div class="container">
                                <h3>how it works</h3>
                                <div class="how-work">
                                    <ul class="how-work-block">
                                        <li>                                            
                                            <div class="how-work-image">
                                                <span class="num-icon">1</span>
                                                <div class="how-work-image-inner">
                                                    <img src="<?php bloginfo('template_url'); ?>/images/how-work-1.png" alt="">
                                                </div><!-- how-work-image-inner -->
                                            </div>                                      
                                            <h5>Send Us a Message</h5>
                                            <p>Sed lorem diam, pulvinar et convallis necpretium </p>
                                        </li>
                                        <li>                                            
                                            <div class="how-work-image">
                                                <span class="num-icon">2</span>
                                                <div class="how-work-image-inner">
                                                    <img src="<?php bloginfo('template_url'); ?>/images/how-work-2.png" alt="">
                                                </div><!-- how-work-image-inner -->
                                            </div>                                       
                                            <h5>Schedule Cleaning</h5>
                                            <p>Sed lorem diam, pulvinar et convallis necpretium </p>
                                        </li>
                                        <li>                                            
                                            <div class="how-work-image">
                                                <span class="num-icon">3</span>
                                                <div class="how-work-image-inner">
                                                    <img src="<?php bloginfo('template_url'); ?>/images/how-work-3.png" alt="">
                                                </div><!-- how-work-image-inner -->
                                            </div>                                      
                                            <h5>Schedule Cleaning</h5>
                                            <p>Sed lorem diam, pulvinar et convallis necpretium </p>
                                        </li>
                                        <li>                                           
                                            <div class="how-work-image">
                                                <span class="num-icon">4</span>
                                                <div class="how-work-image-inner">
                                                    <img src="<?php bloginfo('template_url'); ?>/images/how-work-4.png" alt="">
                                                </div><!-- how-work-image-inner -->
                                            </div>                                       
                                            <h5>Finish the Job</h5>
                                            <p>Sed lorem diam, pulvinar et convallis necpretium </p>
                                        </li>
                                    </ul>
                                </div><!-- how-work -->
                            </div>
                        </div><!-- section -->
                        <div class="section no-padding">
                            <div class="peach-bg" style="background-image: url('<?php bloginfo('template_url'); ?>/images/curve.jpg');">
                                <div class="container">
                                    <h3 class="text-center"><span>What our</span> Clients Says</h3>
                                    <div id="testimonial-slider" class="owl-carousel">
                                        <?php
                                            $args =array(
                                                'post_type' => 'testimonials',
                                                'posts_per_page' => '-1',
                                                'order_by' => 'date',
                                                'order' => 'ASC'
                                            );
                                            $query = new wp_query($args);
                                            if($query->have_posts()){
                                                while($query->have_posts()):$query->the_post();
                                        ?>
                                            <div class="items">
                                                <div class="testimonial-block">
                                                    <div class="author-detial">
                                                        <div class="author-pic">
                                                           <?php the_post_thumbnail('testimonial_image'); ?>
                                                        </div>
                                                        <div class="author-name">
                                                            <p class="author-name"><?php the_title(); ?></p>
                                                            <p class="author-designation">
                                                                <?php echo get_field('profession', get_the_id()); ?>
                                                            </p>
                                                        </div>                                                    
                                                    </div>
                                                    <div class="author-des">
                                                        <?php the_content(); ?>
                                                    </div>
                                                </div><!-- testimonial-block -->
                                            </div><!-- items -->
                                        <?php
                                                endwhile;
                                            }
                                            wp_reset_query();
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- section -->
                        <div class="section text-center no-padding-bottom">
                            <div class="container">
                                <h3><span>let us give you</span> an instant quote</h3>
                                <form>
                                    <ul class="insta-quote-form">
                                        <li><input type="text" placeholder="Enter Your Zip Code" required=""></li>
                                        <li><input type="submit" value="Book a Cleaning Now" class="btn"></li>
                                    </ul>
                                </form>
                            </div>
                        </div><!-- section -->
                    </main><!-- main -->
                </div><!-- primary -->
            </div><!-- content -->


<?php
	get_footer();
?>
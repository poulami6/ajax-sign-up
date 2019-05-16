widget-title<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header( 'shop' );
do_action( 'woocommerce_before_main_content' );
?>
<div class="main-col">
	<?php if( is_shop() ): ?>
		<div class="best-selling">
			<h2>Best Sellers</h2>
			<?php
				$limit   = get_option('edel_products_sort_order_limit');
				$orderby = get_option('edel_products_sort_order_orderby');
				$order   = get_option('edel_products_sort_order_order');
				$mode    = get_option('edel_products_sort_order_mode');

				if( $mode === 'basic' ) {
					echo do_shortcode('[products limit="' . $limit . '" orderby="' . $orderby . '" order="' . $order . '"]');
				} elseif( $mode === 'on_sale' ) {
					echo do_shortcode('[sale_products]');
				} elseif( $mode === 'best_selling' ) {
					echo do_shortcode('[best_selling_products]');
				} elseif( $mode === 'top_rated' ) {
					echo do_shortcode('[top_rated_products]');
				} elseif( $mode === 'featured' ) {
					echo do_shortcode('[featured_products]');
				} elseif( $mode === 'recent' ) {
					echo do_shortcode('[recent_products]');
				}
			?>
		</div>
		<div class="side-bar">
			<?php dynamic_sidebar( 'shop-side-bar' ); ?>
		</div>
	<?php else: ?>
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>
		<div class="filter-bar edel-product-filter">
			<h3 class="widget-title">
				<?php esc_html_e( 'Filter', 'woocommerce' ) ?>
				<a href="javascript:void(0)" class="sidebar-nav-toggle">
					<img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/toggle.png" alt="">
				</a>
			</h3>
			<div class="widget-container">
				<h3 class="widget-title"><?php esc_html_e( 'Category Name', 'woocommerce' ) ?></h3>
				<?php 
					$current = get_queried_object();
					$show_accessories = isset( $_GET['show_accessories'] ) ? $_GET['show_accessories'] : null;
					$all_accessories = isset( $_GET['all_accessories'] ) ? $_GET['all_accessories'] : null;
					$product_ids = isset( $_GET['product_ids'] ) ? explode( ',', $_GET['product_ids'] ) : array();
					$top_level = get_terms( 'product_cat', array( 'hide_empty' => false, 'parent' => 0 ) ); 
				?>
				<?php if( sizeof( $top_level ) ) : ?>
					<ul class="product-categories">
						<?php foreach( $top_level as $top_cat ) : ?>
							<?php 
								$sub_level = get_terms('product_cat', array('hide_empty' => false, 'parent' => $top_cat->term_id));
								if( sizeof( $sub_level ) ) :
									$classes = "cat-item cat-item-" . $top_cat->term_id . " cat-parent";
								else:
									$classes = "cat-item cat-item-" . $top_cat->term_id;
								endif;

								if( ( $top_cat->term_id == 28 ) && ( ( $show_accessories == 1 ) || ( $all_accessories == 1 ) ) ) :
									 $classes .= ' current-cat';
								endif;
							?>
							<li class="<?php echo edel_prepare_filter( $current, $top_cat->term_id, $classes ); ?>">
								<?php if( $top_cat->term_id == 28 ) : ?>
									<?php if( $all_accessories == 1 ) : ?>
										<a href="javascript:void(0);" class="show-all-accessorie all-accessorie-picked" data-category-id="<?php echo $top_cat->term_id; ?>"><?php echo $top_cat->name; ?> for ...</a>
									<?php else: ?>
										<a href="javascript:void(0);" class="show-all-accessorie" data-category-id="<?php echo $top_cat->term_id; ?>"><?php echo $top_cat->name; ?> for ...</a>
									<?php endif; ?>
									<?php 
										$_products = new WP_Query( array(
											'post_type'      => 'product',
											'post_status'    => 'publish',
											'posts_per_page' => -1,
											'orderby'        => 'date',
											'tax_query' => array(
												'relation' => 'AND',
												array(
													'taxonomy' => 'product_cat',
													'field'    => 'slug',
													'terms'    => $top_cat->slug,
													'operator' => 'NOT IN'
												)
											),
											'meta_query'     => array(
        										array(
										            'key' 	  => '_stock_status',
										            'value'   => 'instock',
										            'compare' => '=',
        										)
    										)    
										));

										if ( $_products->have_posts() ) {
											echo '<ul class="children product-list">';
											while ( $_products->have_posts() ) {
												$_products->the_post();

												if( in_array( get_the_ID(), $product_ids ) ) {
													echo '<li class="product-item product-item-' . get_the_ID() . ' product-picked">';
													echo '<a href="javascript:void(0);" class="show-compatible-accessorie product-accessorie-picked" data-product-id="' . get_the_ID() . '">' . get_the_title() . '</a>';
													echo '</li>';
												} else {
													echo '<li class="product-item product-item-' . get_the_ID() . '">';
													echo '<a href="javascript:void(0);" class="show-compatible-accessorie" data-product-id="' . get_the_ID() . '">' . get_the_title() . '</a>';
													echo '</li>';
												}
											}
											echo '</ul>';
										}
									?>
								<?php elseif( sizeof( $sub_level ) ) : ?>
									<a class="has-url" href="<?php echo get_term_link( $top_cat ); ?>"><?php echo $top_cat->name; ?></a>
									<ul class="children children-first-level">
										<?php foreach( $sub_level as $sub_cat ) : ?>
											<?php 
												$children = get_terms('product_cat', array(
													'hide_empty' => false, 
													'parent' => $sub_cat->term_id
												));

												if( sizeof( $children ) ) :
													$sub_classes = "cat-item cat-item-" . $sub_cat->term_id . " cat-parent";
												else:
													$sub_classes = "cat-item cat-item-" . $sub_cat->term_id;
												endif; 
											?>
											<li class="<?php echo edel_prepare_filter( $current, $sub_cat->term_id, $sub_classes ); ?>">
												<a class="has-url" href="<?php echo get_term_link( $sub_cat ); ?>"><?php echo $sub_cat->name; ?></a>
												<?php if( sizeof( $children ) ) : ?>
													<ul class="children children-second-level">
														<?php foreach( $children as $child ) : ?>
															<?php $child_classes = "cat-item cat-item-" . $child->term_id; ?>
															<li class="<?php echo edel_prepare_filter( $current, $child->term_id, $child_classes ); ?>">
																<a class="has-url" href="<?php echo get_term_link( $child ); ?>">
																	<?php echo $child->name; ?>
																</a>
															</li>
														<?php endforeach; ?>
													</ul>
												<?php endif; ?>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
		<div class="product-container edel-filter-product-list">
			<div class="grid-view">
				<?php
					if ( have_posts() ) {
						do_action( 'woocommerce_before_shop_loop' );
						woocommerce_product_loop_start();
						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();
								do_action( 'woocommerce_shop_loop' );
								wc_get_template_part( 'content', 'product' );
							}
						}

						if( ( $show_accessories == 1 ) && ( sizeof( $product_ids ) > 0 ) ) {
							echo edel_get_compatible_accessories( 'compatible_accessories', $product_ids );
						}

						if( ( $all_accessories == 1 ) && ( $current->term_id != 28 ) ) {
							echo edel_get_compatible_accessories( 'all_accessories' );
						}
						
						woocommerce_product_loop_end();
						do_action( 'woocommerce_after_shop_loop' );
					} else {
						do_action( 'woocommerce_no_products_found' );
					}
				?>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php 
do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' );

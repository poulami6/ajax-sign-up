<?php

//////////////////////////////////////////////////////////////////

// Options Framework Functions

//////////////////////////////////////////////////////////////////

/* Set the file path based on whether the Options Framework is in a parent theme or child theme */



if ( STYLESHEETPATH == TEMPLATEPATH ) {

	define('OF_FILEPATH', TEMPLATEPATH);

	define('OF_DIRECTORY', get_bloginfo('template_directory'));

} else {

	define('OF_FILEPATH', STYLESHEETPATH);

	define('OF_DIRECTORY', get_bloginfo('stylesheet_directory'));

}

require_once (OF_FILEPATH . '/lib/index.php'); 



define('PREFIX','sd_');



add_action( 'init', 'register_my_menus' );

function register_my_menus() {

	register_nav_menus(

		array(

			'main-menu' => __( 'Main Menu' ),
			
			'useful-links' => __( 'Useful Links' ),

		)

	);

}



//////////////////////////////////////////////////////////////////

// Register widgetized areas, including two sidebars and four widget-ready columns in the footer.

//////////////////////////////////////////////////////////////////



function sdthemes_widgets_init() {

	// Area 1, located at the top of the sidebar.

	register_sidebar( array(

		'name' => __( 'Main Sidebar', 'sdthemes' ),

		'id' => 'home-widget-area',

		'description' => __( 'The primary widget area', 'sdthemes' ),

		'before_widget' => '<div class="add-place">',

		'after_widget' => '</div>',

		'before_title' => '<h3>',

		'after_title' => '</h3>',

	) );

	

	register_sidebar( array(

		'name' => __( 'Primary Widget Area', 'sdthemes' ),

		'id' => 'primary-widget-area',

		'description' => __( 'The primary widget area', 'sdthemes' ),

		'before_widget' => '<div class="widget %2$s">',

		'after_widget' => '</div>',

		'before_title' => '<h2>',

		'after_title' => '</h2>',

	) );	

}



add_action( 'widgets_init', 'sdthemes_widgets_init' );



//////////////////////////////////////////////////////////////////

// Post thumbnails

//////////////////////////////////////////////////////////////////

if ( function_exists( 'add_theme_support' ) ) {

	add_theme_support( 'post-thumbnails' );	
	add_image_size( 'loop_service', 180, 180, true);
	add_image_size( 'testimonial_image', 120, 120, true);

}


function remove_admin_bar() {

	if (!current_user_can('administrator')) {

	  show_admin_bar(false);

	}

}

add_action('after_setup_theme', 'remove_admin_bar');



/* Disable WP-Admin for untrusted users*/ 

function prevent_admin_access(){

	$file = basename($_SERVER['PHP_SELF']);

	if ($file == 'wp-login.php' || is_admin() && !current_user_can('edit_posts') && $file != 'admin-ajax.php'){

        wp_redirect(get_bloginfo('url').'/page-not-found');

    }	

   	if (false !==strpos( strtolower( $_SERVER['REQUEST_URI'] ),'/wp-admin' ) && !current_user_can('administrator') && false==strpos(strtolower($_SERVER['REQUEST_URI']),'admin-ajax.php' ) )

          wp_redirect(get_bloginfo('url').'/page-not-found');

}

//add_action( 'init', 'prevent_admin_access'); 



//////////////////////////////////////////////////////////////////

// Change excerpt from [...] to ...

//////////////////////////////////////////////////////////////////

function new_excerpt_more($more) {

     global $post;

	//return '... <a href="'. get_permalink($post->ID) . '">Read More &raquo;</a>';

	return '...';

}

add_filter('excerpt_more', 'new_excerpt_more');



remove_filter( 'the_excerpt', 'wpautop' );

//////////////////////////////////////////////////////////////////

// Change length of excerpt

//////////////////////////////////////////////////////////////////

function new_excerpt_length($length) {

	global $post;

	if ($post->post_type == 'news')

		return 12;

	else

		return $length;

}

add_filter('excerpt_length', 'new_excerpt_length');



//////////////////////////////////////////////////////////////////

// How comments are displayed

//////////////////////////////////////////////////////////////////

function site_comment($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment; ?>

    <div class="auther_comment_box_div" id="comment-<?php comment_ID() ?>">

  		<div class="default_pic_small"><?php echo get_avatar($comment,$size='60'); ?></div>

  		<div class="author_comment_box_content">

  			<div class="arrow"></div>

  			<div class="author_comment_text"><a ><?php echo get_comment_author_link() ?></a> <span><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>-</span><?php edit_comment_link(__('Edit'),'  ','') ?> - <?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply', 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?><br/><br/>

            <?php if ($comment->comment_approved == '0') : ?>

					<em><?php _e('Your comment is awaiting moderation.') ?></em>

					<br />

					<?php endif; ?>

				<?php comment_text() ?>

			</div>

  		</div>

  	</div>

	

<?php }



//////////////////////////////////////////////////////////////////

// function to get favicon

//////////////////////////////////////////////////////////////////

function get_sd_favicon(){

	if(get_option('sd_custom_favicon')){		

		return '<link rel="shortcut icon" href="'.get_option('sd_custom_favicon').'" />';

	}

	else{		

		return '<link rel="shortcut icon" href="'.get_bloginfo('template_url').'/images/favicon.png" />';

	}

}

function sd_favicon(){

	echo get_sd_favicon();

}

add_action('admin_head', 'sd_favicon');





//////////////////////////////////////////////////////////////////

// functions social icons

//////////////////////////////////////////////////////////////////

function get_social_url($socialkey){		

	if($socialkey=="twitter"){

		$key='sd_twitter';

		$url='http://www.twitter.com/[val]';

	}elseif($socialkey=="facebook"){

		$key='sd_facebook';

		$url='http://www.facebook.com/[val]';

	}elseif($socialkey=="flickr"){

		$key='sd_flickr_userid';

		$url='http://www.flickr.com/photos/[val]';

	}elseif($socialkey=="gplus"){

		$key='sd_googleplus';

		$url='https://plus.google.com/[val]';

	}elseif($socialkey=="skype"){

		$key='sd_skype';

		$url='skype:[val]?chat';

	}elseif($socialkey=="email"){

		$key='sd_email';

		$url='mailto:[val]';

	}

	$val = stripslashes(get_option($key));

	if($val)

		return str_replace("[val]",$val,$url);

	else

		return 'javascript:void(0);';

}



function social_url($socialkey){

	echo get_social_url($socialkey);

}



function contact_number(){

	$val =stripslashes( get_option('sd_contact_number'));

	echo $val;	

}



//////////////////////////////////////////////////////////////////

// functions logo and tag

//////////////////////////////////////////////////////////////////



function get_the_logo(){

	$imgs=array("png","PNG","jpg","JPG","gif","GIF","jpeg","JPEG","bmp","BMP");

	if(get_option('sd_logo') && in_array(end(explode(".",stripslashes(get_option('sd_logo')))),$imgs)){

		$logo_url=stripslashes(get_option('sd_logo'));

	}else{

		$logo_url=get_bloginfo('template_url').'/images/logo.png';	

	}

	$blogname=get_bloginfo('name');

	return '<a href="'.get_bloginfo('url').'" title="'.$blogname.'"><img src="'.$logo_url.'"  alt="'.$blogname.'" /></a>';

}

function the_logo(){

	echo get_the_logo();

}



////////////////////////////////////

// Pagination

////////////////////////////////////

function show_pagination(){

	global $wp_query;

	if ($wp_query->max_num_pages> 1 ) :

	global $wp_rewrite;

		 $pagination_args = array(

		'base' => @add_query_arg('paged','%#%'),

		'format' => '',

		'current' => max( 1, get_query_var('paged') ),

		'total' => $wp_query->max_num_pages,

		'prev_next'    => true,

    	'prev_text'    => __('&laquo; '),

    	'next_text'    => __('&raquo;'),);	

	if( $wp_rewrite->using_permalinks() ){

	 	$pagination_args['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');

		if( !empty($wp_query->query_vars['s']) )

	 		$pagination_args['add_fragment'] = '?s='.get_query_var('s');

		$lnk=paginate_links($pagination_args);

		echo '<div class="pagination"><span class="pages">Pages</span>'.$lnk.'</div>';

	}else{

		if( !empty($wp_query->query_vars['s']) )

	 	$pagination_args['add_args'] = array('s'=>get_query_var('s'));

		echo '<div class="pagination"><span class="pages">Pages</span>'.paginate_links( $pagination_args ).'</div>';

	}

	  

	endif;	

}





////////////////////////////////////

// Validations

////////////////////////////////////

function valid_url($url){

	if(!filter_var($url, FILTER_VALIDATE_URL)){ 

  		return false;

 	}else{

		return true;

	}

}



////////////////////////////////////

// URL functions

////////////////////////////////////

function get_url($url , $params=array()){

	$sp=(strpos($url,'?')>0)?'&':'?';

	if(count($params)>0){

		$vars=array();

		foreach($params as $k=>$param){

			$vars[]=$k.'='.$param;

		}

		$string=implode("&",$vars);

		return $url.=$sp.$string;

	}

	else return $url;

}





function get_page_url($page , $params=array()){

	$p=get_page_by_path($page);

	$url=get_permalink($p->ID);	

	$url=get_url($url,$params);

	return $url;

}

function page_url($page_slug, $params=array()){

	echo get_page_url($page_slug,$params);

}



function redirect_to($page , $params=array()){

	wp_redirect(get_url(get_page_url($page),$params));

}





function sd_show_message($message='',$type="success",$align='left',$show_type=true){

	if(!empty($message)){

		$str='<div class="alert-box '.$type.'">';

		if($show_type)

			$str.='<span>'.strtoupper($type).': </span>';

		$str.=$message.'</div>';

		echo $str;

	}

}



function page_only_visible($when){

	if($when=="before-login"){

		if(is_user_logged_in())

			wp_redirect(get_page_url('dashboard'));

	}elseif($when=="after-login"){

		if(!is_user_logged_in()){

			$rurl=end(explode("?",$_SERVER['REQUEST_URI']));

			$rurl=urlencode(get_permalink());

			wp_redirect(home_url());

		}

	}

}

function random_string($length) {

    $key = '';

    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {

        $key .= $keys[array_rand($keys)];

    }

    return $key;

}



function head_script(){

	if(is_front_page()){		

	}

}

add_action('wp_footer','head_script',20);



function footer_script(){

	$google_analytics = get_option('sd_google_analytics'); 

	if ($google_analytics)echo stripslashes($google_analytics);

}

add_action('wp_footer','footer_script');



function formatWithSuffix($input){

    $suffixes = array('', 'K', 'M', 'G', 'T');

    $suffixIndex = 0;

    while(abs($input) >= 1000 && $suffixIndex < sizeof($suffixes))    {

        $suffixIndex++;

        $input /= 1000;

	}

    return (($input > 0)? floor($input * 10) / 10: ceil($input * 10) / 10). $suffixes[$suffixIndex];

}

function frontend_pagination( $total_record, $page_name ){
	$current_page = (get_query_var('paged'))?get_query_var('paged'):'1';
	$per_page = 30;
	$j2c_tv = (int) $total_record; 
	$total_rows = ceil( $j2c_tv/$per_page ); 
	$search = ($_REQUEST['search']) ?'?search='.$_REQUEST['search']:'';
	
	if( $_REQUEST['from_date'] && $_REQUEST['to_date']){
		if($_REQUEST['search']){
			$search .='&from_date='.$_REQUEST['from_date'].'&to_date='.$_REQUEST['to_date'];
		}else{
			$search .='?from_date='.$_REQUEST['from_date'].'&to_date='.$_REQUEST['to_date'];
		}
	}
	if( $_REQUEST['client_id'] ){
		if($search)
			$search .= '&client_id='.$_REQUEST['client_id'];
		else
			$search = '?client_id='.$_REQUEST['client_id'];	
	}
	if( $_REQUEST['vehicle_id'] ){
		if($search)
			$search .= '&vehicle_id='.$_REQUEST['vehicle_id'];
		else	
			$search .= '?vehicle_id='.$_REQUEST['vehicle_id'];
	}
	if( $_REQUEST['transaction_type'] ){
		if($search)
			$search .= '&transaction_type='.$_REQUEST['transaction_type'];
		else
			$search = '?transaction_type='.$_REQUEST['transaction_type'];
	}
	
	if( $total_rows > 0  ){
		$page_url =  get_bloginfo('url')."/".$page_name."/";
		$last = $total_rows;
		$links = 2;
		$start = ( ( $current_page - $links ) > 0 ) ? ( $current_page - $links ) : 1;
		$end = ( ( $current_page + $links ) < $last ) ? ( $current_page + $links ) : $last;
		
		$html = '<ul>';
		$class = ( $current_page == 1 ) ? "disabled" : "";
		$html.= '<li class="' . $class . '"><a href="'.$page_url.'page/' . ( $current_page - 1 ) .$search. '">Prev</a></li>';
		if ( $start > 1 ) {
			$html.= '<li><a href="'.$page_url.'page/1'.$search.'">1</a></li>';
			$html.= '<li><a href="javascript:void(0);">...</a></li>';
		}
		for ( $i = $start ; $i <= $end; $i++ ) {
			$class  = ( $current_page == $i ) ? "active" : "";
			$html.= '<li><a class="'.$class.'" href="'.$page_url.'page/'.$i.$search.'">'.$i.'</a></li>';
		}
		if ( $end < $last ) {
			$html.= '<li><a href="javascript:void(0);">...</a></li>';
			$html.= '<li><a href="'.$page_url.'page/' . $last.$search. '">' . $last . '</a></li>';
		}
		$class = ( $current_page == $last ) ? "disabled" : "";
		$html.= '<li class="' . $class . '"><a href="'.$page_url.'page/' . ( $current_page + 1 ).$search.'">Next</a></li>';
		$html.= '</ul>';
		return $html;
	}else{
		return '';
	}
}
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page('Theme Settings');
}
/*booking form*/


add_action('wp_ajax_makeBooking', 'makeBooking');
add_action('wp_ajax_nopriv_makeBooking', 'makeBooking'); 


function makeBooking(){
	print_r($_POST);
	///exit;
	echo "hello123";
    global $wpdb;

    $bedrooms   = $_POST["bedrooms"];
    $bathrooms     = $_POST["bathrooms"];
    $services   = $_POST["services"];
    $weeks   = $_POST["weeks"];
      
    $sql = "INSERT INTO `pc_instant_quote`
          (`bedrooms`,`bathrooms`,`services`,`weeks`) 
   values ($bedrooms, $bathrooms, $services, $weeks)";

   $wpdb->query($sql);
    die();
}

/*booking form*/



/*
* Creating a function to create our CPT
*/
 
function custom_post_type_products() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Products', 'Post Type General Name', 'twentythirteen' ),
        'singular_name'       => _x( 'Product', 'Post Type Singular Name', 'twentythirteen' ),
        'menu_name'           => __( 'Products', 'twentythirteen' ),
        'parent_item_colon'   => __( 'Parent Product', 'twentythirteen' ),
        'all_items'           => __( 'All Products', 'twentythirteen' ),
        'view_item'           => __( 'View Product', 'twentythirteen' ),
        'add_new_item'        => __( 'Add New Product', 'twentythirteen' ),
        'add_new'             => __( 'Add New', 'twentythirteen' ),
        'edit_item'           => __( 'Edit Product', 'twentythirteen' ),
        'update_item'         => __( 'Update Product', 'twentythirteen' ),
        'search_items'        => __( 'Search Product', 'twentythirteen' ),
        'not_found'           => __( 'Not Found', 'twentythirteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Products', 'twentythirteen' ),
        'description'         => __( 'Product news and reviews', 'twentythirteen' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'products', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type_products', 0 );



?>
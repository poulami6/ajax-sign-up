<?php
/**
 * VMS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * 
 */

/**
 * VMS only works in WordPress 4.7 or later.
 */

// Include required files
require get_parent_theme_file_path( '/functions/common-functions.php' );
add_action( 'init', 'enqcustomscript' );
function enqcustomscript(){
$home_url = home_url();    
wp_enqueue_script('script-js', get_template_directory_uri().'/js/jquery-2.2.4.js', array('jquery'), true);
wp_enqueue_script('custom-js', get_template_directory_uri().'/js/customjs.js', array('jquery'), true);
wp_enqueue_script('custom-js-ui', get_template_directory_uri().'/js/jquery-ui.js', array('jquery'), true);
wp_enqueue_script('validate-js', get_template_directory_uri().'/js/jquery.validate.js', array('jquery'), true);
wp_localize_script( 'custom-js', 'my_ajax', array( 'home_url' => $home_url, 'ajax_url'=> admin_url('admin-ajax.php')) );

}

require get_parent_theme_file_path() . '/functions/email_template.php';
require get_parent_theme_file_path() . '/classes/class-users.php';

if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

/**
 * MyFirstTheme's functions and definitions
 *
 * @package MyFirstTheme
 * @since MyFirstTheme 1.0
 */
 
/**
 * First, let's set the maximum content width based on the theme's design and stylesheet.
 * This will limit the width of all uploaded images and embeds.
 */
if ( ! isset( $content_width ) )
    $content_width = 800; /* pixels */
 
if ( ! function_exists( 'vmstheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function vmstheme_setup() {
 
    /**
     * Make theme available for translation.
     * Translations can be placed in the /languages/ directory.
     */
    load_theme_textdomain( 'vmstheme', get_template_directory() . '/languages' );
 
    /**
     * Add default posts and comments RSS feed links to <head>.
     */
    add_theme_support( 'automatic-feed-links' );
 
    /**
     * Enable support for post thumbnails and featured images.
     */
    add_theme_support( 'post-thumbnails' );
 
    /**
     * Add support for two custom navigation menus.
     */
    register_nav_menus( array(
        'primary'   => __( 'Primary Menu', 'vmstheme' ),
        'secondary' => __('Secondary Menu', 'vmstheme' )
    ) );
 
    /**
     * Enable support for the following post formats:
     * aside, gallery, quote, image, and video
     */
    add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
}
endif; // vmstheme_setup
add_action( 'after_setup_theme', 'vmstheme_setup' );
/*Add Option TO Custom Field*/
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page();
    
}

/**
*Custom Post Testimonial
**/
add_action( 'init', 'vms_testimonial_init' );
function vms_testimonial_init() {
    $labels = array(
        'name'               => _x( 'Testimonial', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Testimonial', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New Testimonial', 'bottomgallery', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Testimonial', 'your-plugin-textdomain' ),
        'new_item'           => __( 'Testimonial', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Testimonial', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Testimonial', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Testimonial', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Testimonial', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Testimonial:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No Testimonial found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No Testimonial found in Trash.', 'your-plugin-textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonial','taxonomy'=>'testimonial' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        
        
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','custom-fields','page-attributes')
    );

register_post_type( 'testimonial', $args );  
}
/**
*Custom Post Brand
**/
add_action( 'init', 'vms_brand_init' );
function vms_brand_init() {
    $labels = array(
        'name'               => _x( 'Brand', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Brand', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Brand', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Brand', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New Brand', 'bottomgallery', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Brand', 'your-plugin-textdomain' ),
        'new_item'           => __( 'Brand', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Brand', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Brand', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Brand', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Brand', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Brand:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No Brand found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No Brand found in Trash.', 'your-plugin-textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'brand','taxonomy'=>'brand' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        
        
        'supports'           => array( 'title', 'author', 'thumbnail','custom-fields','page-attributes')
    );

register_post_type( 'brand', $args );  
}


//Add Registration Form //
add_action( 'wp_ajax_partner_submit_data', 'partner_submit_data' );
add_action('wp_ajax_nopriv_partner_submit_data', 'partner_submit_data');
function partner_submit_data(){

        $business_name = $_REQUEST['business_name'];
        $first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $displayname = $first_name.' '.$last_name;
        $apt_no = $_REQUEST['apt_no'];
        $street_name = $_REQUEST['street_name'];
        $city_name = $_REQUEST['city_name'];
        $country_name = $_REQUEST['country_name'];
        $phone_number = $_REQUEST['phone_number'];
        $user_password = $_REQUEST['user_password'];
        $email_address = $_REQUEST['email_address'];
        $user_type = $_REQUEST['user_type'];
        $created_date = date('Y-m-d H:i:s');
       
        global $wpdb;
        $tab1 = $wpdb->prefix.'users';
        $datum = $wpdb->get_results("SELECT * FROM $tab1 WHERE user_email = '".$email_address."'");
        if($wpdb->num_rows > 0) { 
            echo "<p style='color:red;'>Email Already Exist</p>";    
            exit;
        } 
        else 
        {        
            //$user_id = wp_create_user( $email_address, $user_password, $email_address );
            $partnerdata = array(
                'user_login'  =>  $email_address,
                'user_pass' =>   $user_password,
                'display_name'=> $displayname ,
                'user_nicename'=> $displayname,
                'user_email'=>  $email_address,
                'role' => $user_type
            );            
            $user_id = wp_insert_user( $partnerdata ) ;
            $user = new WP_User($user_id);
            $auser = get_user_by( 'ID', $user_id );
            $auser->set_role( '' );
            $auser->add_role( $user_type );

            echo '<p style="color:green;">Registration successful! Click <a style="color:#922B5F" href='.home_url('sign-in').'>here</a> to continue</p>';

            add_user_meta( $user_id, '_businessname', $business_name);
            add_user_meta( $user_id, '_aptno', $apt_no);
            add_user_meta( $user_id, '_streetname', $street_name);
            add_user_meta( $user_id, '_cityname', $city_name);
            add_user_meta( $user_id, '_countryname', $country_name);
            add_user_meta( $user_id, '_phonenumber', $phone_number);
            add_user_meta( $user_id, '_usertype', $user_type );
            update_user_meta( $user_id, '_userpassword', $user_password );

            update_user_meta( $user_id, 'first_name', $first_name );
            update_user_meta( $user_id, 'last_name', $last_name );

            $partner_detail = get_userdata( $user_id );
            $partneremail = $partner_detail->data->user_email;
            $partnername = $partner_detail->data->display_name;

            $html_partner_user = _partner_result_template_user($user_id);
            $subject = 'Registration Details';
            _do_mail( $partneremail , $subject , $html_partner_user );
            //echo $html_partner_user;

            $html_partner_admin = _partner_result_template_admin($user_id);
            $subject1 = 'Registration Details of '.$partnername;
            $admin_email = get_option('admin_email');
            _do_mail( $admin_email , $subject1 , $html_partner_admin );
            //echo $html_partner_admin;
            exit;
        }   
}

function _do_mail($to,$sub,$body,$attachment=false){
    $admin_email = get_option('admin_email');
    $admin = 'Virtual Post Jamaica';
        $headers = 'From: '.$admin.' '.' <'.$admin_email.'>' . "\r\n" .
        'Content-Type: text/html' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        if($attachment){
            wp_mail($to , $sub , $body , $headers , $attachment);
        }else{
            wp_mail($to , $sub , $body , $headers );
        }
        
}

//Customer Sign UP//
add_action( 'wp_ajax_customer_submit_data', 'customer_submit_data' );
add_action('wp_ajax_nopriv_customer_submit_data', 'customer_submit_data');
function customer_submit_data(){

        $cust_first_name = $_REQUEST['cust_first_name'];
        $cust_last_name = $_REQUEST['cust_last_name'];
        $cust_password = $_REQUEST['cust_password'];
        $displayname1 = $cust_first_name.' '.$cust_last_name;
        $cust_email_address = $_REQUEST['cust_email_address'];        
        $cust_company_name = $_REQUEST['cust_company_name'];
        $cust_phone_number = $_REQUEST['cust_phone_number'];
        $cust_apt_no = $_REQUEST['cust_apt_no'];
        $cust_street_address = $_REQUEST['cust_street_address'];
        $cust_town = $_REQUEST['cust_town'];
        $cust_country = $_REQUEST['cust_country'];
        $user_type = $_REQUEST['user_type'];
        $created_date = date('Y-m-d H:i:s');
       
        global $wpdb;
        $tab2 = $wpdb->prefix.'users';
        $datum = $wpdb->get_results("SELECT * FROM $tab2 WHERE user_email = '".$cust_email_address."'");
        if($wpdb->num_rows > 0) { 
            echo "<p style='color:red;'>Email Already Exist</p>";    
            exit;
        } 
        else 
        {
        
            //$cust_id = wp_create_user( $cust_email_address, $cust_password, $cust_email_address );
            $customerdata = array(
                'user_login'  =>  $cust_email_address,
                'user_pass' =>   $cust_password,
                'display_name'=> $displayname1 ,
                'user_nicename'=> $displayname1,
                'user_email'=>  $cust_email_address,
                'role' => $user_type
            ); 
            $cust_id = wp_insert_user( $customerdata ) ;
            $user = new WP_User($cust_id);
            $customer_role = get_user_by( 'ID', $cust_id );
            $customer_role->set_role( '' );
            $customer_role->add_role( $user_type );

             echo '<p style="color:green;">Registration successful! Click <a style="color:#922B5F" href='.home_url('sign-in').'>here</a> to continue</p>';

            add_user_meta( $cust_id, '_companyname', $cust_company_name);
            add_user_meta( $cust_id, '_phonenumber', $cust_phone_number);
            add_user_meta( $cust_id, '_aptno', $cust_apt_no);
            add_user_meta( $cust_id, '_streetname', $cust_street_address);
            add_user_meta( $cust_id, '_cityname', $cust_town);
            add_user_meta( $cust_id, '_countryname', $cust_country);
            add_user_meta( $cust_id, '_usertype', $user_type );
            update_user_meta( $cust_id, '_userpassword', $cust_password );
            update_user_meta( $cust_id, 'first_name', $cust_first_name );
            update_user_meta( $cust_id, 'last_name', $cust_last_name );

            $customer_detail = get_userdata( $cust_id );
            $customeremail = $customer_detail->data->user_email;
            $customername = $customer_detail->data->display_name;

            $html_customer_user = _customer_result_template_user($cust_id);
            $subject2 = 'Registration Details';
            _do_mail_customer( $customeremail , $subject2 , $html_customer_user );

            $html_customer_admin = _customer_result_template_admin($cust_id);
            $subject3 = 'Registration Details of '.$customername;
            $admin_email = get_option('admin_email');
            _do_mail_customer( $admin_email , $subject3 , $html_customer_admin );
            exit;
        }   
}

function _do_mail_customer($to,$sub,$body,$attachment=false){
    $admin_email = get_option('admin_email');
    $admin = 'Virtual Post Jamaica';
        $headers = 'From: '.$admin.' '.' <'.$admin_email.'>' . "\r\n" .
        'Content-Type: text/html' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        if($attachment){
            wp_mail($to , $sub , $body , $headers , $attachment);
        }else{
            wp_mail($to , $sub , $body , $headers );
        }
        
}

add_action("pmpro_checkout_before_submit_button", 'add_bank_tarnsfer_btn');
function add_bank_tarnsfer_btn(){
    $memberid = $_REQUEST['level'];
    global $current_user; 
    $currentuserid = $current_user->ID;
?>
<style type="text/css">
    .pmpro_submit{display: none;}
</style>
<link href="<?php echo get_template_directory_uri(); ?>/css/card-js.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo get_template_directory_uri(); ?>/js/card-js.min.js"></script>
<div id="payment_list">
    <select id="types_of_payment" class="make_payment">
        <option value="">Make Payment</option>
        <option value="Paypal">Pay By Paypal</option>
        <option value="Bank">Bank Transfer</option>
    </select>
</div>
<div class="bank_payment" style="display: none;">
    <select class="pmpro_btn_select" name="bank_type" id="bank_type" class="required">
        <option value="">Direct Deposit</option>
        <option value="Sagicor">Sagicor Bank</option>
        <!--<option value="Manor Park">Manor Park Branch</option>-->
    </select>
    <input type="hidden" name="memberid" id="memberid" value="<?php echo $memberid; ?>">
    <input type="hidden" name="currentuserid" id="currentuserid" value="<?php echo $currentuserid; ?>">
    <input type="submit" id="submitbutton" value="Submit">

    <?php 
    global $wpdb;   
    $tab56 = $wpdb->prefix.'direct_transfer';
    $single_result12 = $wpdb->get_row("SELECT * FROM $tab56 WHERE id=1");
    $sagicor_content = $single_result12->sagicor_bank;
    $manor_content = $single_result12->manor_bank;
    ?>
    <div class="sagicor" style="display: none;"><?php echo $sagicor_content; ?></div>
    <div class="manor" style="display: none;"><?php echo $manor_content; ?></div>    
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("select.make_payment").change(function(){
            var selectedevent1 = jQuery(this).children("option:selected").val();
            
            if( selectedevent1 == 'Paypal' )
            {
                jQuery('div.bank_payment').hide();
                jQuery('div.pmpro_submit').show();
            }
            if( selectedevent1 == 'Bank' )
            {
                jQuery('div.bank_payment').show();
                jQuery('div.pmpro_submit').hide();
            }
            if( selectedevent1 == '' )
            {
                jQuery('div.bank_payment').hide();
                jQuery('div.pmpro_submit').hide();
            }
        });

        jQuery("select.pmpro_btn_select").change(function(){
            var selectedevent = jQuery(this).children("option:selected").val();
            if( selectedevent == 'Sagicor' )
            {
                jQuery('div.manor').hide();
                jQuery('div.sagicor').show();
            }
            if( selectedevent == 'Manor Park' )
            {
                jQuery('div.manor').show();
                jQuery('div.sagicor').hide();
            }
            if( selectedevent == '' )
            {
                jQuery('div.manor').hide();
                jQuery('div.sagicor').hide();
            }
        });

        jQuery("#submitbutton").on('click', function(e) {
            var bank_type = jQuery('#bank_type').val();
            if (bank_type == "") {
                alert("Please select an option!");
                return false;
            }
            //return true;

            if (confirm('Are you sure to bank deposite?')) {
                var memberid = jQuery('#memberid').val();
                var currentuserid = jQuery('#currentuserid').val();
                var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                e.preventDefault();

                var data = {'memberid':memberid,
                    'currentuserid':currentuserid,
                    'bank_type':bank_type,
                    'action':'direct_bank_tranfer'};

                jQuery.ajax({
                    url: ajaxurl,     
                    data: data,
                    type : 'POST',
                    success:function(response) {                     
                        
                    if(response == 0) 
                        {
                        //alert("You will now be redirected.");
                        window.location = "<?php echo home_url('/thank-you/'); ?>";
                        }                        
                    console.log(response);
                    }
                }); 
            } else {
                return false;
            }
        });        
    });
    
</script>
<?php }

//Direct Bank Transfer//
add_action( 'wp_ajax_direct_bank_tranfer', 'direct_bank_tranfer' );
add_action('wp_ajax_nopriv_direct_bank_tranfer', 'direct_bank_tranfer');
function direct_bank_tranfer(){
    $memberid = $_REQUEST['memberid'];
    $currentuserid = $_REQUEST['currentuserid'];
    $bank_type = $_REQUEST['bank_type'];
    $randomcode = genarate_code(10);
    
    global $wpdb;
    $level_tab = $wpdb->prefix.'pmpro_membership_levels';
    $level_result = $wpdb->get_row("SELECT * FROM $level_tab WHERE id = '".$memberid."'");
    $initialpayment = $level_result->initial_payment;

    $tab_trans = $wpdb->prefix.'bank_transfer';
    $wpdb->insert( $tab_trans, array( 'membershipid' => $memberid, 'userid' => $currentuserid, 'total_amount' => $initialpayment, 'bank_type' => $bank_type, 'status' => 'Pending', 'user_registered' => date('Y-m-d H:i:s')  ) );
    //print_r($wpdb->last_query);    

    $order_tab = $wpdb->prefix.'pmpro_membership_orders';
    $chkoutrow = $wpdb->get_row( "SELECT checkout_id FROM $order_tab ORDER BY checkout_id DESC limit 1");
    $last_checkoutid = $chkoutrow->checkout_id;
    $checkoutid = ($last_checkoutid + 1);
    $wpdb->insert( $order_tab, array( 'code' => $randomcode, 'user_id' => $currentuserid, 'membership_id' => $memberid, 'subtotal' => $initialpayment, 'status' => 'pending', 'checkout_id' => $checkoutid, 'gateway' => 'banktransfer', 'total' => $initialpayment, 'payment_type' => $bank_type, 'timestamp' => date('Y-m-d H:i:s')  ) );

    return true;
    exit;
}

//Random number generate
function genarate_code($length_of_string)
{
    $str_result = '0123456789ABCDEF'; 
    return substr(str_shuffle($str_result), 0, $length_of_string);
}

//admin menu for Employee
add_action( 'admin_menu', 'emp_admin_menu');    
function emp_admin_menu() {
    
    if ( current_user_can( 'administrator' ) ) {
        add_submenu_page( 'pmpro-dashboard', 'Bank Details', 'Bank Details', 'manage_options' , 'bank-details',  'fn_bank_details' );
    }
}
function fn_bank_details(){
    include('bank_details.php');
}


add_action( 'edit_page_form', 'my_first_editor' );
function my_first_editor() {
    // $args= array( 
    // 'textarea_rows' => 10
    // );
    global $wpdb;   
    $tab2 = $wpdb->prefix.'direct_transfer';
    $single_result = $wpdb->get_row("SELECT * FROM $tab2 WHERE id=1");
    $sagicor_content = $single_result->sagicor_bank;
    wp_editor( $sagicor_content, 'sagicorbank_details' );
}
add_action( 'edit_page_form', 'my_second_editor' );
function my_second_editor() {
    global $wpdb;   
    $tab2 = $wpdb->prefix.'direct_transfer';
    $single_result1 = $wpdb->get_row("SELECT * FROM $tab2 WHERE id=1");
    $manor_content = $single_result1->manor_bank;
    wp_editor( $manor_content, 'manorbank_details' );
}

add_action( 'wp_ajax_bank_details', 'bank_details' );
add_action('wp_ajax_nopriv_bank_details', 'bank_details');
function bank_details(){
    $sagicorbank_details = $_REQUEST['sagicorbank_details'];
    $manorbank_details = $_REQUEST['manorbank_details'];

    global $wpdb;
    $bank_trans = $wpdb->prefix.'direct_transfer';
    $wpdb->update( $bank_trans, array( 'sagicor_bank' => $sagicorbank_details, 'manor_bank' => $manorbank_details ), array( 'id' => 1 ) );
    
    echo '<p style="color:green;">Data Updated</p>';
    exit();
}
/*disable plugin updates*/
function my_filter_plugin_updates( $value ) {
   if( isset( $value->response['paid-memberships-pro/paid-memberships-pro.php'] ) ) {        
      unset( $value->response['paid-memberships-pro/paid-memberships-pro.php'] );
    }
    return $value;
 }
 add_filter( 'site_transient_update_plugins', 'my_filter_plugin_updates' );
 
 /*disable plugin updates*/
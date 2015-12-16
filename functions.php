<?php
add_action( 'genesis_setup','genesischild_theme_setup' );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
add_action ('wp_enqueue_scripts', 'responsive_menu_enqueue_scripts');

function genesischild_theme_setup() {
//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add theme support for custom header
add_theme_support( 'custom-header', array(
	'flex-height'     => true,
	'width'           => 1200,
	'height'          => 237,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );
}

/* Enqueue styles*/
function theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}


// *Facebook Javascript SDK 
add_filter ('genesis_before_header','tw_facebook_javascript_sdk');
 function tw_facebook_javascript_sdk() {
	echo '
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
  		var js, fjs = d.getElementsByTagName(s)[0];
  		if (d.getElementById(id)) return;
  		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
  		fjs.parentNode.insertBefore(js, fjs);
		}',
		"(document, 'script', 'facebook-jssdk'));</script>";
}

//* Display a custom favicon
add_filter( 'genesis_pre_load_favicon', 'tw_favicon_filter' );
function tw_favicon_filter( $favicon_url ) {
	return get_stylesheet_directory_uri() . '/favicon.ico';
}

/**Responsive Menu**/
/* @author Ozzy Rodriguez : http://ozzyrodriguez.com/tutorials/genesis/genesis-responsive-menu-2-0/ */
function responsive_menu_enqueue_scripts() {
	wp_enqueue_script( 'responsive-menu', get_stylesheet_directory_uri() . '/lib/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
}

// * Customize the credits
add_filter( 'genesis_footer_creds_text', 'tw_footer_creds_text' );
function tw_footer_creds_text() {
	$home = get_bloginfo(url);
	$legal_owner = "Friends of Free Wildlife";
	echo '<div class="creds"><p>';
	echo '&nbsp; &middot; Copyright &copy; ';
	echo date('Y');
	echo ' &middot; <a href=' , $home , '/>' , $legal_owner , ' </a> &middot; ';
	echo '<div class="marketing"> &nbsp; &middot; Logo designed by Sybil Schneider Graphic Design. Tel: 021 785 2018 Cell: 083 270 0088 &middot; <br />
	&nbsp; &middot; Built on the <a href="http://www.shareasale.com/r.cfm?b=346198&u=723591&m=28169&urllink=&afftrack=" title="Genesis Framework">Genesis Framework for WordPress</a> lovingly customized by <a href="http://trishacornelius.com/wp/design-portfolio">Trisha Cornelius </a> &middot; </div> <!--end marketing-->';
	echo '</p></div><!--end .creds-->';
}

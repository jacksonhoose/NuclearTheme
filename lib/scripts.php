<?php

/*!
 * Scripts
 */

function nuclear_scripts()
{

	/*!
	 * site styles
	 */
	wp_enqueue_style('app', THEME_URL . '/assets/css/app.css');

  /*!
   * remove default jquery
   */
  wp_deregister_script('jquery');

  /*!
   * site scripts
   */
  wp_register_script('jquery', THEME_URL . '/assets/bower_components/jquery/dist/jquery.min.js', array(), '2.1.1', false);
  wp_register_script('app', THEME_URL . '/assets/js/app.min.js', array('jquery'), '1.0', true);

  /*!
   * site variables
   */
  wp_localize_script('app', 'Nuclear', array(
    'ajaxUri'   => admin_url('admin-ajax.php'),
    'siteUri'   => home_url(),
    'themeUri'  => get_template_directory_uri()
  ));

  /*!
   * site wide
   */
  wp_enqueue_script('jquery');
  wp_enqueue_script('app');

}
add_action('wp_enqueue_scripts', 'nuclear_scripts');

/*!
 * Load Google Fonts into header
 */
function nuclear_add_google_fonts() { ?>

<?php }
add_action('wp_head', 'nuclear_add_google_fonts', 100);

/*!
 * Google Analytics into footer
 */
function nuclear_add_google_analytics() { ?>

<?php }
add_action('wp_footer', 'nuclear_add_google_analytics', 0);

/*!
 * Add Facebook to footer
 */
function nuclear_facebook_init() { ?>

<?php }
add_action('wp_footer', 'nuclear_facebook_init', 0);

/*!
 * Twitter init in footer
 */
function nuclear_twitter_init() { ?>

<?php }
add_action('wp_footer', 'nuclear_twitter_init', 50);

/*!
 * Shim responsive for old browser
 */
function nuclear_ie_scripts() { ?>

	<?php
	/*!
	 * 	These are some good polyfills/shims for IE8 and lower
	 */
	?>

  <!--[if lt IE 9]>
    <script src="//s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.5-min.js"></script>
    <script src="//html5base.googlecode.com/svn-history/r38/trunk/js/selectivizr-1.0.3b.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

<?php }
add_action('wp_head', 'nuclear_ie_scripts', 100);

/*!
 * An IE Only stylesheet
 */
function nuclear_ie_only_styles() { ?>

	<!--<![if IE]-->
		<link rel="stylesheet" type="text/css" href="<?php echo THEME_URL . '/assets/css/ie.css'; ?>">
	<!--<![endif]-->

<?php }
add_action('wp_head', 'nuclear_ie_only_styles', 999);

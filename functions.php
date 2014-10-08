<?php

/*!
 * classes
 */
include_once('lib/classes/util.class.php');
include_once('lib/classes/nuclear.class.php');
include_once('lib/classes/breadcrumbs.class.php');
include_once('lib/classes/pagination.class.php');
include_once('lib/classes/post_type.class.php');

/*!
 * wordpress hooks
 */
include_once('lib/definitions.php');
include_once('lib/before_init.php');
include_once('lib/init.php');
include_once('lib/admin.php');
include_once('lib/ajax.php');
include_once('lib/shortcodes.php');
include_once('lib/quicktags.php');
include_once('lib/scripts.php');
include_once('lib/widgets.php');

/*!
 * wordpress global for max image size
 */

if(!isset($content_width))
{
	$content_width = 1140;
}

if(!isset($header_templates))
{
	$header_templates = ['templates/shared/head', 'templates/shared/header'];
}

if(!isset($footer_templates))
{
	$footer_templates = ['templates/shared/footer'];
}
<?php

/*!
 * Any ajax handlers go here
 */


/*!
 * The idea here is that this is an endpoint that can easily be queried from the frontend for ajax tasks.
 * The goal is to be able to basically run WP_Queries from the front end of the website.
 */
function nuclear_micro_api()
{
	/*!
	 * Exit because the request isn't coming from the correct page / they have a bad nonce
	 */
	if (!wp_verify_nonce($_REQUEST['nonce'], 'nuclear-nonce'))
	{
		exit('There was an error.');
	}

	/*!
	 * Make sure they got here via ajax
	 */
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		if(!$_REQUEST['wp_query']) {
			exit('There was an error.');
		}

		$posts = Nuclear::get_posts($_REQUEST['wp_query']);
		echo json_encode($posts);

	}
	else
	{
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	/*!
	 * Die after doing our ajax-y thang
	 */
	die();

}
/*!
 * register ajax end point
 */
add_action('wp_ajax_nopriv_nuclear_micro_api', 'nuclear_micro_api');
add_action('wp_ajax_nuclear_micro_api', 'nuclear_micro_api');

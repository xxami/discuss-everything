<?php

namespace de {

	require_once('db.php');
	require_once('lib/html.php');

	/**
	 * check for cookie to see if this user has a temp account
	 */

	// todo

	/**
	 * create new post
	 */
	$button = html('button')
		->attr(['name' => 'create_post'])
		->val('create new post');
	$form = html('form')
		->attr(['action' => '', 'method' => 'post'])
		->add_child($button);

	/**
	 * create the post
	 */
	if (isset($_POST[$button->attr('name')])) {

		/**
		 * todo: redirect user to created post
		 */
		echo 'todo: redirect';
	}

	/**
	 * display the post button
	 */
	echo $form->render();

	/**
	 * display posts
	 */

	// todo

}

?>

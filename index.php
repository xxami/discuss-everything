<?php

namespace de {

	require_once('db.php');
	require_once('lib/html.php');

	/**
	 * display user name if logged in temp account
	 */
	if (isset($_COOKIE['user_cookie_id'])) {
		$r = query("select user.name from user where user.cookie_id = '?'",
			$_COOKIE['user_cookie_id']);
		if ($user = $r->get_first()) {
			echo 'hello ' . $user['name'] . '!';
		}
		else {
			setcookie('user_cookie_id', '', time() - 3600); // -1 hour
			echo 'sorry - something went wrong!';
		}
	}

	// todo

	/**
	 * create new post
	 */
	?>
	<a href="post.php">create new post</a>
	<?php

	/**
	 * display posts
	 */

	// todo

}

?>

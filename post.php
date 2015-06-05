<?php

namespace de {

	require_once('db.php');
	require_once('lib/html.php');

	/**
	 * create new post
	 */

	/**
	 * handle login for temp users - todo: g+/email login support
	 */
	if (isset($_POST['temp_login']) && isset($_POST['temp_user'])) {

		if (strlen($_POST['temp_user']) < 3) {
			/**
			 * redirect or error?
			 * should not happen - js should ensure this
			 */
			echo 'sorry - username is less than 3 characters';

			/**
			 * end of page
			 */
			exit(0);
		}

		/**
		 * handle login for temp users
		 */
		$cid = uniqid(substr($_POST['temp_user'], 0, 8), true);
		$user = $_POST['temp_user'];
		$r = query("insert into user values (null, '?', '?');", $user, $cid);

		if ($r->get_last_affected_rows() > 0) {
			setcookie('user_cookie_id', $cid, time() + 2592000, '/'); // 30 days
			header('location: post.php');

			/**
			 * end of page
			 */
			exit(0);
		}
		else {
			/**
			 * display error
			 */
			echo 'sorry - something went wrong!';

			/**
			 * end of page
			 */
			exit(0);
		}
	}

	elseif (!isset($_COOKIE['user_cookie_id'])) {
		?>
		<h4>this website requires registration</h4>
		<p>you may use the form below to login or register</p>
		<form action="" method="post">
			<label>todo: login/register with g+</label><br>
			<label>todo: login/register with email</label><br>
			<label>login with a temporary account with username only 
			(note: can be upgraded later)</label><br>
			<input name="temp_user" maxlength="64" placeholder="Anonymous">
			<button name="temp_login" type="submit">login</button>
		</form>
		<?php

		/**
		 * end of page
		 */
		exit(0);
	}
	
	/**
	 * display create new post if user logged in - todo: g+/email login support
	 */
	if (isset($_COOKIE['user_cookie_id'])) {
		$r = query("select user.name from user where user.cookie_id = '?'",
			$_COOKIE['user_cookie_id']);
		if ($user = $r->get_first()) {
			echo 'hello ' . $user['name'] . '!';
		}
		else {
			/**
			 * redirect or error?
			 */
			setcookie('user_cookie_id', '', time() - 3600); // -1 hour
			echo 'sorry - something went wrong!';
		}
	}

}

?>
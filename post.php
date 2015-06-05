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
			<input name="temp_user" maxlength="64" placeholder="your user name">
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

		$r = query("select user.id, user.name from user where user.cookie_id = '?'",
			$_COOKIE['user_cookie_id']);
		if ($user = $r->get_first()) {

			if (isset($_POST['post_url']) && isset($_POST['post_title']) &&
				isset($_POST['post_type']) && isset($_POST['post_content']) &&
				isset($_POST['post_category']) && isset($_POST['post_tags'])) {

				/**
				 * form posted - put to db
				 */

				$tags = explode(' ', $_POST['post_tags']);
				$invalid_tags = false;

				foreach ($tags as $tag) {
					$len = strlen($tag);
					if ($len == 0 || $len > 32) $invalid_tags = true;
				}

				if (count($tags) > 6 || $invalid_Tags) {
					/**
					 * should never happen - js should prevent this
					 */
					echo 'sorry - invalid tags!';
				}
				elseif (!['ask' => 1, 'debate' => 1, 'casual' => 1][$_POST['post_type']]) {
					/**
					 * should never happen - js should prevent this
					 */
					echo 'sorry - invalid type!';
				}
				elseif (!['news' => 1, 'media' => 1,
					'tech' => 1, 'gaming' => 1, 'fun' => 1][$_POST['post_category']]) {
					/**
					 * should never happen - js should prevent this
					 */
					echo 'sorry - invalid category!';
				}
				else if (strlen($_POST['post_url']) < 10 ||
					strlen($_POST['post_title']) < 3 || strlen($_POST['post_content']) < 10) {
					/**
					 * should never happen - js should prevent this
					 */
					echo 'sorry - missing or not enough text in url, title or content!';
				}
				else {
					/**
					 * ok to post
					 */

					/**
					 * get type ids from given type name
					 */
					$r = query("select * from post_type where post_type.name = '?';",
						$_POST['post_type']);

					/**
					 * get category ids from given category name
					 */
					$r = query("select * from post_channel where post_channel.name = '?';",
						$_POST['post_category']);

					echo 'yay';
				}

				/**
				 * end of page
				 */
				exit(0);
			}

			echo 'hello ' . $user['name'] . '!';

			/**
			 * post form
			 */
			?>

			<form action="" method="post">
				<label>url</label>
				<input name="post_url" maxlength="256" placeholder="topic url"><br>
				<label>title</label>
				<input name="post_title" maxlength="128" placeholder="title"><br>
				<label>type of post</label>
				<input name="post_type" type="radio" value="ask">ask
				<input name="post_type" type="radio" value="debate">discuss
				<input name="post_type" type="radio" value="casual">casual<br>
				<label>content</label>
				<textarea name="post_content" cols="81" rows="15" placeholder="content"></textarea>
				<br>
				<label>category of post</label>
				<select name="post_category">
					<option value="news">news</option>
					<option value="media">media</option>
					<option value="tech">tech</option>
					<option value="gaming">gaming</option>
					<option value="fun">fun</option>
				</select><br>
				<label>post tags</label>
				<input name="post_tags" maxlength="256" placeholder="tags seperated by space">
				<br>
				<br>
				<button type="submit">create post!</button>
			</form>

		<?php
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
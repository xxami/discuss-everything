<?php

namespace de {

	/**
	 * require only this (after configuring) for
	 * accessing lib/db.php members
	 */

	require_once('lib/db.php');

	/**
	 * local db settings go in the untracked file
	 * local/db.php
	 *
	 * use the following template:
	 */

	Database::$domain = 'localhost';
	Database::$user = 'root';
	Database::$password = '';
	Database::$name = 'default';

	/**
	 * untracked
	 */
	require_once('local/db.php');

}

?>

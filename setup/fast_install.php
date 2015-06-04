<?php

namespace de {

	require_once('../db.php');
	require_once('../lib/html.php');

	$button = html('button')
		->attr([
			'name' => 'do_install',
			'type' => 'submit'
		])->val('create new post');

	$form = html('form')
		->attr(['action' => '', 'method' => 'post'])
		->add_child($button);

	if (isset($_POST[$button->attr('name')])) {

		echo 'install ./core.sql... ';
		$r = mquery_r(file_get_contents('./core.sql'));
		echo 'ok (' . $r->get_last_affected_rows() . ')<br>';

		if (file_exists('../local/data.sql')) {
			echo 'install ../local/data.sql... ';
			$r = mquery_r(file_get_contents('../local/data.sql'));
			echo 'ok (' . $r->get_last_affected_rows() . ')<br>';
		}

		echo 'done: please delete /setup/ now!';

	}

	else {

		$r = query_r("show tables");
		if ($r->get_num_rows() > 0) {
			echo '** warning: this will wipe the entire database **';
			$button->val('i understand: wipe + reinstall');
		}

		else {
			$button->val('install');
		}

		echo $form->render();

	}

}

?>
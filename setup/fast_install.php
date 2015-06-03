<?php

namespace de {

	require_once('../db.php');
	require_once('../lib/html.php');

	$form = new Form('post');
	$button = new Button('');
	$button->type = 'submit';
	$button->name = 'do_install';
	$form->add_child($button);

	if (isset($_POST[$button->name])) {

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
			$button->text = 'i understand: wipe + reinstall';
		}

		else {
			$button->text = 'install';
		}

		echo $form->render();

	}

}

?>
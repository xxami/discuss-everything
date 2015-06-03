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
		echo 'button pressed';
	}

	else {

		$r = query_r("show tables");
		if ($r->get_num_rows() > 0) {
			$button->text = 'wipe + reinstall?';
		}
		else {
			$button->text = 'install';
		}

		echo $form->render();

	}

}

?>
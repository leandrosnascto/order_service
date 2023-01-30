<?php

	require_once('Class/UpdateRegisterClass.php');
	require_once('Class/DeleteRegisterClass.php');
	require_once('Class/RegisterDataClass.php');

	//deletar o registro
	if(isset($_GET['delete'])) {
		$delete = new DeleteRegisterClass();
		$result = $delete->deleteProduct($_POST['key_product']);
		echo json_encode(array('Result' => $result));
		exit(0);
	}

	// atualizar ou inserir
	$code               = $_POST['code'];
	$description        = $_POST['description'];
	$status             = $_POST['status'];
	$warranty           = $_POST['warranty'];
	$key_product        = $_POST['key_product'];

	if($key_product == 0 ) {
		$register = new RegisterDataClass();
		$result = $register->product($code, $description, $status, $warranty);
	} else {
		$update = new UpdateRegisterClass();
		$result = $update->updateProduct($code, $description, $status, $warranty, $key_product);
		
	}

	echo json_encode(array('Result' => $result));

?>

		
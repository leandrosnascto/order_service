<?php

	require_once('Class/UpdateRegisterClass.php');
	require_once('Class/DeleteRegisterClass.php');
	require_once('Class/RegisterDataClass.php');

	//deletar o registro
	if(isset($_GET['delete'])) {
		$delete = new DeleteRegisterClass();
		$result = $delete->deleteClient($_POST['key_client']);
		echo json_encode(array('Result' => $result));
		exit(0);
	}

	// atualizar ou inserir
	$name       = $_POST['name'];
	$cpf        = $_POST['cpf'];
	$address    = $_POST['address'];
	$keyClient  = $_POST['key_client'];

	if($keyClient == 0 ) {
		$register = new RegisterDataClass();
		$result = $register->client($name, $cpf, $address);
	} else {
		$update = new UpdateRegisterClass();
		$result = $update->updateClient($name, $cpf, $address, $keyClient);
		
	}

	echo json_encode(array('Result' => $result));

?>

		
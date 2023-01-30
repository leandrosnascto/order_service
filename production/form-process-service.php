<?php

	require_once('Class/UpdateRegisterClass.php');
	require_once('Class/DeleteRegisterClass.php');
	require_once('Class/RegisterDataClass.php');

	//deletar o registro
	if(isset($_GET['delete'])) {
		$delete = new DeleteRegisterClass();
		$result = $delete->deleteServiceOrdem($_POST['key_serice']);
		echo json_encode(array('Result' => $result));
		exit(0);
	}

	// atualizar ou inserir

	$numberOrder   = $_POST['numberOrder'];
	$dateOpening   = $_POST['dateOpening'];
	$nameConsumer  = $_POST['nameConsumer'];
	$cpf           = $_POST['cpf'];
	$keyProduct    = $_POST['product'];

	$keyService    = $_POST['key_service'];

	

	if($keyService == 0 ) {
		$register = new RegisterDataClass();
		$result = $register->serviceOrdem($numberOrder,$dateOpening,$nameConsumer,$cpf,$keyProduct);
	} else {
		$update = new UpdateRegisterClass();
		$result = $update->updateServiceOrdem($numberOrder,$keyProduct,$keyService);
		
	}

	echo json_encode(array('Result' => $result));

?>

		
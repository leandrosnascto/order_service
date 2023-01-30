<?php
	include('index-header.php');
	require_once('Class/ListDataClass.php');

	$row['NAME']       = '';
	$row['CPF']        = '';
	$row['ADDRESS']    = '';
	$row['KEY_CLIENT'] = 0;

	$isEdit = isset($_GET['keyClient']);

	if(isset($_GET['keyClient'])) {
		$getClient = new ListDataClass();
		$resultClient = $getClient->getClient(preg_replace( '/[^0-9]/', '', $_GET['keyClient'] ));
		$row = $resultClient->fetch_assoc();
	} 
?>

			<!-- page content -->
			

			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Clientes</h3>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>

								<div class="alert alert-warning">
									<strong>Atenção!</strong> Este CPF já existe cadastrado.
								</div>

								<div class="x_content">
									<br />
									<form action="#" id="demo-form2" method="POST">

									<input type="hidden" id="key-client" name="key_client" value="<?=$row['KEY_CLIENT'] ?>">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="name-client">Nome Cliente
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="name-client" name="name" required class="form-control" maxlength="80" value="<?=$row['NAME'] ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="cpf">CPF
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="cpf" name="cpf" required class="form-control" data-inputmask="'mask': '999-999-999-99'" value="<?=$row['CPF'] ?>" <?= $isEdit ? 'readonly' : ''?> >
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Endereço</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="address" class="form-control" type="text" name="address" required maxlength="100" value="<?=$row['ADDRESS'] ?>">
											</div>
										</div>
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-3 col-sm-3 offset-md-8">
												<button type="button" class="btn btn-success save-client">Salvar</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->

<?php
	include('index-footer.php');
?>


<script>
    $('.alert-warning').hide();
	$('.save-client').on('click', function() {
		const nameClient = $('#name-client').val();
		const cpf        = $('#cpf').val();
		const address    = $('#address').val();
		const keyClient  = $('#key-client').val();

		$.ajax({
			url: 'form-process-client.php',
			method: 'POST',
			data:   {name: nameClient, cpf: cpf, address: address, key_client: keyClient},
			dataType: 'json',
			success: function(a) {
				if(a.Result === false) {
					$('.alert-warning').show();
					setTimeout(function() { 
						$('.alert-warning').hide();
					}, 5000);
			
				} else {
					window.location.href="list-client.php";
				}
			}
		});
	});
</script>			
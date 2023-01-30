<?php
	include('index-header.php');
	require_once('Class/ListDataClass.php');

	
	$row['NUMBER_ORDER']       = '';
	$row['DATE_OPENING']       = '';
	$row['CPF']                = '';
	$row['KEY_CLIENT']         = '';
	$row['NAME']               = ''; 
	$row['KEY_PRODUCT']        = ''; 
	$row['KEY_ORDEM']          = 0;

	$isEdit = isset($_GET['keyOrdem']);

	if(isset($_GET['keyOrdem'])) {
		$getService = new ListDataClass();
		$resultSevice = $getService->getService(preg_replace( '/[^0-9]/', '', $_GET['keyOrdem'] ));
		$row = $resultSevice->fetch_assoc();
	} 

	//LISTA DE PRODUTOS ATIVOS
	$getProductActive = new ListDataClass();
	$resultProductActive = $getProductActive->listProductActive();


?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Ordem de Serviço</h3>
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
								<div class="x_content">
									<br />
									<form id="demo-form2" action="#" method="post" class="form-horizontal form-label-left">
	
									
									<input type="hidden" id="key-service" name="key_service" value="<?=$row['KEY_ORDEM'] ?>">
									<input type="hidden" id="key-client" name="key_client" value="<?=$row['KEY_CLIENT'] ?>">
									
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="number-order">Número Ordem
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="number_order" id="number-order" required="required" class="form-control " value="<?=$row['NUMBER_ORDER'] ?>">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Data Abertura</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="date-opening" class="form-control" name="date_opening" data-inputmask="'mask': '99/99/9999'" value="<?= !empty($row['DATE_OPENING']) ? date('d-m-Y', strtotime($row['DATE_OPENING'])) : null ?>" <?= $isEdit ? 'readonly' : ''?> >
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="name-consumer">Nome Consumidor
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="name_consumer" id="name-consumer" required="required" class="form-control " value="<?=$row['NAME'] ?>"  <?= $isEdit ? 'readonly' : ''?> >
												
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="cpf">Produto
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select name="product" id="product">
													<option value=""></option>
													<?php
													   if ($resultProductActive) {
														while($rowProduct = $resultProductActive->fetch_assoc()) {
															$selected = $row['KEY_PRODUCT'] == $rowProduct['KEY_PRODUCT'] ? 'selected' : '';
															
															echo "<option value='". $rowProduct['KEY_PRODUCT'] ."'  $selected >".$rowProduct['CODE']."</option>";

														}
													   }
													?>
												
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="cpf">CPF Consumidor
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="cpf" name="cpf" required="required" class="form-control" data-inputmask="'mask': '999-999-999-99'" value="<?= $row['CPF'] ?>" <?= $isEdit ? 'readonly' : ''?> >
											</div>
										</div>
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-3 col-sm-3 offset-md-8">

												<button type="button" class="btn btn-success save-service">Salvar</button>
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

	$('.save-service').on('click', function() {
		const numberOrder  = $('#number-order').val();
		const dateOpening  = $('#date-opening').val();
		const nameConsumer = $('#name-consumer').val();
		const cpf          = $('#cpf').val(); 
		const product      = $('#product').val();

		const keyService   = $('#key-service').val();
		
		

		$.ajax({
			url: 'form-process-service.php',
			method: 'POST',
			data:   {numberOrder: numberOrder, dateOpening: dateOpening, nameConsumer: nameConsumer, cpf:cpf, product:product, key_service: keyService},
			dataType: 'json',
			success: function(result) {
				if(result) {
					window.location.href="list-service.php";
				}
			}
		});
	});
</script>				
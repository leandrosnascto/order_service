<?php
	include('index-header.php');
	require_once('Class/ListDataClass.php');

	$row['CODE']          = '';
	$row['DESCRIPTION']   = '';
	$row['STATUS']        = '';
	$row['TIME_WARRANTY'] = '';
	$row['KEY_PRODUCT']   = 0;

	$isEdit = isset($_GET['keyProduct']);

	if(isset($_GET['keyProduct'])) {
		$getProduct = new ListDataClass();
		$resultProduct = $getProduct->getProduct(preg_replace( '/[^0-9]/', '', $_GET['keyProduct'] ));
		$row = $resultProduct->fetch_assoc();
	} 
?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Produtos</h3>
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
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										
									<input type="hidden" id="key-product" name="key_product" value="<?=$row['KEY_PRODUCT'] ?>">
									
									<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="code">Código
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="code" name="code" required="required" class="form-control" value="<?=$row['CODE'] ?>" <?= $isEdit ? 'readonly' : ''?>>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Descrição
											</label>
											<div class="col-md-8 col-sm-8 ">

												<textarea required="required" name='description' id="description" rows="4" cols="100" maxlength="200"><?=$row['DESCRIPTION'] ?></textarea>
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Status</label>
											<div class="col-md-6 col-sm-6 ">
												<div class="btn-group form-check" data-toggle="buttons">
													<label class="btn btn-secondary label-check1">
														<input type="radio" class="join-btn statusAI" name="active" id="option1" value="<?php echo $row['STATUS'] == 1 ? 1 : null ?>"> Ativo
													</label>
													<label class="btn btn-secondary label-check2">
														<input type="radio" name="inactive" class="join-btn statusAI" id="option2" value="<?php echo $row['STATUS'] == 0 ? 0 : null ?>"> Inativo
													</label>
												</div>
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tempo de garantia</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="time-warranty" class="form-control" name="time_warranty" data-inputmask="'mask': '99/99/9999'" value="<?= !empty($row['TIME_WARRANTY']) ? date('d-m-Y', strtotime($row['TIME_WARRANTY'])) : null ?>"  <?= $isEdit ? 'readonly' : ''?> >
											</div>
										</div>
										
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-3 col-sm-3 offset-md-8">
												<button type="button" class="btn btn-success save-product">Salvar</button>
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

	$(document).ready(function() {

		if ($('#option1').val().length == 1) {

			$("#option1").parent().addClass("active focus");
			$(".label-check2").removeClass("active focus");

		} else if ($('#option2').val().length == 1) {

			$("#option2").parent().addClass("active focus");
			$(".label-check1").removeClass("active focus");
		} else {

			$(".label-check1, .label-check2").removeClass("active focus");
		}
	});

	$('#option1').on('change', function() {
		$('#option1').val(1);
		$('#option2').val(' ');
	});

	$('#option2').on('change', function() {
		$('#option2').val(0);
		$('#option1').val('');
	});

	$('.save-product').on('click', function() {

		const code         = $('#code').val();
		const description  = $('#description').val();
		var optionStatus = null;
		if ($('#option1').val().length == 1) {
			optionStatus   = 1; 
		} else {
			optionStatus   = 0; 
		}
		const timeWarranty = $('#time-warranty').val(); 
		const keyProduct  = $('#key-product').val();
		

		$.ajax({
			url: 'form-process-product.php',
			method: 'POST',
			data:   {code: code, description: description, status: optionStatus, warranty:timeWarranty, key_product: keyProduct},
			dataType: 'json',
			success: function(result) {
				if(result) {
					window.location.href="list-product.php";
				}
			}
		});
	});
</script>				
<?php

	include('index-header.php');
  require_once('CLass/ListDataClass.php');
  $list = new ListDataClass();
  $result = $list->listProduct();

?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                  <div class="x_title">
                    <h2>Produtos</h2>
                    <div class="clearfix"></div>
                  </div>
                    <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                   
                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Tempo Garantia</th>
                            <th>Editar</th>
                            <th>Deletar</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php
                            if ($result) {
                              while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                  echo "<td>".$row['CODE']."</td>";
                                  echo "<td>".$row['DESCRIPTION']."</td>";
                                  if ($row['STATUS'] == 1) {
                                    echo "<td>ATIVO</td>";
                                  } else {
                                    echo "<td>INATIVO</td>";
                                  }
                                    
                                  echo "<td>". date('d-m-Y', strtotime($row['TIME_WARRANTY'])) ."</td>";
                                  echo "<td><a href='form-product.php?keyProduct=".$row['KEY_PRODUCT']."' class='btn btn-primary'>Editar</a></td>";
                                  echo "<td><a href='javascript:void(0)' onclick='functionDelete(".$row['KEY_PRODUCT'].")' class='btn btn-danger'>Deletar</a></td>";
                                echo "</tr>";
                              }
                            }
                          ?>
                          
                        </tbody>
                      </table>
                    </div>
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
  function functionDelete(keyProduct) {
    let text = "Realmente, deseja deletar o registro ?";
    if (confirm(text) == true) {

      $.ajax({
        url: 'form-process-product.php?delete=1',
        method: 'POST',
        data:   {key_product: keyProduct},
        dataType: 'json',
        success: function(result) {
          if(result) {
            window.location.href="list-product.php";
          }
        }
      });
    }   
  }
</script>
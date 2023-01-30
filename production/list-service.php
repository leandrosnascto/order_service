<?php

	include('index-header.php');
  include('CLass/ListDataClass.php');
  $list = new ListDataClass();
  $result = $list->listServiceOrdem();

?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                  <div class="x_title">
                    <h2>Ordem de serviço</h2>
                    <div class="clearfix"></div>
                  </div>
                    <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                   
                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Número Ordem</th>
                            <th>Data Abertura</th>
                            <th>Nome do Consumidor</th>
                            <th>CPF Consumidor</th>
                            <th>Produto</th>
                            <th>Editar</th>
                            <th>Deletar</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php
                            if ($result) {
                              while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row['NUMBER_ORDER']."</td>";
                                echo "<td>".date('d-m-Y', strtotime($row['DATE_OPENING']))."</td>";
                                echo "<td>".$row['NAME']."</td>";
                                echo "<td>".$row['CPF']."</td>";
                                echo "<td>".$row['CODE']."</td>";
                                echo "<td><a href='form-service.php?keyOrdem=".$row['KEY_ORDEM']."' class='btn btn-primary'>Editar</a></td>";
                                echo "<td><a href='javascript:void(0)' onclick='functionDelete(".$row['KEY_ORDEM'].")' class='btn btn-danger'>Deletar</a></td>";
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
  function functionDelete(KeyOrdem) {
    let text = "Realmente, deseja deletar o registro ?";
    if (confirm(text) == true) {

      $.ajax({
        url: 'form-process-service.php?delete=1',
        method: 'POST',
        data:   {key_serice: KeyOrdem},
        dataType: 'json',
        success: function(result) {
          if(result) {
            window.location.href="list-service.php";
          }
        }
      });
    }   
  }
</script>
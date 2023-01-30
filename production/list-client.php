<?php
  include('index-header.php');
  include('CLass/ListDataClass.php');
  $list = new ListDataClass();
  $result = $list->listClient();
?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                  <div class="x_title">
                    <h2>Clientes</h2>
                    <div class="clearfix"></div>
                  </div>
                    <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                   
                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Nome Cliente</th>
                            <th>CPF</th>
                            <th>Endereço</th>
                            <th>Editar</th>
                            <th>Deletar</th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php
                          if ($result) {
                            while($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>".$row['NAME']."</td>";
                              echo "<td>".$row['CPF']."</td>";
                              echo "<td>".$row['ADDRESS']."</td>";
                              echo "<td><a href='form-client.php?keyClient=".$row['KEY_CLIENT']."' class='btn btn-primary'>Editar</a></td>";
                              echo "<td><a href='javascript:void(0)' onclick='functionDelete(".$row['KEY_CLIENT'].")' class='btn btn-danger'>Deletar</a></td>";
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
  function functionDelete(keyClient) {
    let text = "Realmente, deseja deletar o registro ?";
    if (confirm(text) == true) {

      $.ajax({
        url: 'form-process-client.php?delete=1',
        method: 'POST',
        data:   {key_client: keyClient},
        dataType: 'json',
        success: function(result) {
          if(result) {
            window.location.href="list-client.php";
          }
        }
      });
    }   
  }
</script>
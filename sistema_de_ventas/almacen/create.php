<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');


?>
<!--content wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Registro de un Nuevo Producto</h1>
          <?php
          if (isset($_SESSION['mensaje'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['mensaje'] . '</div>';
            unset($_SESSION['mensaje']);
          }
          ?>
        </div><!--/.col-->
      </div><!--/.row-->
    </div><!-- /.container-fluid -->
  </div>


  <!-- /.content-header -->
  <!--Main content-->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Llene los datos con cuidado</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="../app/controllers/roles/create.php" method="post">
                <div class="row">
                  <!-- COLUMNA IZQUIERDA (8 de 12 columnas) -->
                  <div class="col-md-8">
                    <!-- FILA 1 -->
                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label>Código:</label>
                        <input type="text" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label>Categoria:</label>
                        <input type="text" class="form-control">
                      </div>

                      <div class="col-md-4">
                        <label>Nombre del Producto:</label>
                        <input type="text" class="form-control">
                      </div>
                      
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label>Usuario:</label>
                        <input type="text" class="form-control">
                      </div>
                      <div class="col-md-8">
                        <label>Descripción del Producto:</label>
                        <textarea name="" id="" cols="30" rows="2" class="form-control"></textarea>
                      </div>
                    </div>



                    <!-- FILA 2 -->
                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label>Stock:</label>
                        <input type="number" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label>Stock Mínimo:</label>
                        <input type="number" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label>Stock Máximo:</label>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- FILA 3 -->
                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label>Precio Compra:</label>
                        <input type="number" id="precio_compra" class="form-control" oninput="calcularPrecioVenta()" step="0.01">
                      </div>
                      <div class="col-md-4">
                        <label>Utilidad estimada (%):</label>
                        <input type="number" id="porcentaje_ganancia" class="form-control" oninput="calcularPrecioVenta()" step="0.01">
                      </div>
                      <div class="col-md-4">
                        <label>Precio Sugerido:</label>
                        <input type="text" id="precio_venta" class="form-control" readonly>
                      </div>
                    </div>

                    <!-- FILA 4 -->
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label>Precio de Venta 1:</label>
                        <input type="number" id="precio_venta_real" class="form-control" oninput="calcularGanancia()" step="0.01">
                      </div>
                      <div class="col-md-6">
                        <label>Utilidad Estimada (%):</label>
                        <input type="text" id="ganancia_obtenida" class="form-control" readonly>
                      </div>
                    </div>

                   
                  </div>

                  <!-- COLUMNA DERECHA: imagen grande + fechas -->
                  <div class="col-md-4">
                    <div class="form-group mb-4">
                      <label>Imagen del producto:</label>
                      <div style="width: 100%; height: 250px; border: 2px dashed #ccc; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <span style="color: #aaa;">(Vista previa de imagen)</span>
                      </div>
                      <input type="file" class="form-control mt-2">
                    </div>

                    <div class="form-group mb-3">
                      <label>Fecha Ingreso:</label>
                      <input type="date" class="form-control">
                    </div>

                    <!--<div class="form-group">
                      <label>Fecha Actualización:</label>
                      <input type="date" class="form-control">
                    </div>-->
                  </div>
                </div>
              </form>
            </div>


            <hr>
            <div class="form-group">
              <a href="index.php" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </div>
          </form>
        </div>
      </div>

    </div>
    <!-- /.card-body -->
  </div>
</div>
</div>
</div>

<!-- /.row-->
</div><!-- /.container-fluid-->
</div>
<!-- /.content -->

</div>
<!-- /.content-wrapper-->

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>

<script>
  function calcularPrecioVenta() {
    let compra = parseFloat(document.getElementById('precio_compra').value);
    let ganancia = parseFloat(document.getElementById('porcentaje_ganancia').value);

    if (!isNaN(compra) && !isNaN(ganancia)) {
      let venta = compra + (compra * ganancia / 100);
      document.getElementById('precio_venta').value = venta.toFixed(2);
    } else {
      document.getElementById('precio_venta').value = '';
    }
  }
</script>


<!--Este script es para calcular la utilidad estimada automaticamente-->
<script>
  function calcularPrecioVenta() {
    let compra = parseFloat(document.getElementById('precio_compra').value);
    let ganancia = parseFloat(document.getElementById('porcentaje_ganancia').value);

    if (!isNaN(compra) && !isNaN(ganancia)) {
      let venta = compra + (compra * ganancia / 100);
      document.getElementById('precio_venta').value = Math.round(venta);

    } else {
      document.getElementById('precio_venta').value = '';
    }
  }

  function calcularGanancia() {
    let compra = parseFloat(document.getElementById('precio_compra').value);
    let venta_real = parseFloat(document.getElementById('precio_venta_real').value);

    if (!isNaN(compra) && compra > 0 && !isNaN(venta_real)) {
      let ganancia = ((venta_real - compra) / compra) * 100;
      document.getElementById('ganancia_obtenida').value = Math.round(ganancia) + "%";
    } else {
      document.getElementById('ganancia_obtenida').value = '';
    }
  }
</script>
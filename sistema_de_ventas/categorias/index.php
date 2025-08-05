<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

include('../app/controllers/categorias/listado_de_categorias.php');

?>


<!--content wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Categorias
                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i>
                            Agregar Nuevo
                        </button>
                    </h1>

                </div><!--/.col-->
            </div><!--/.row-->
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->


    <!--Main content-->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Categorias Registradas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">

                            <table id="table_usuarios" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th>
                                            <center>Nombre de la categoria</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    include('../app/controllers/usuarios/listado_de_usuarios.php');
                                    foreach ($categorias_datos as $categorias_dato) {
                                        $id_categoria = $categorias_dato['id_categoria'];
                                        $nombre_categoria = $categorias_dato['nombre_categoria'];

                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador = $contador + 1 ?></center>
                                            </td>
                                            <td><?php echo $categorias_dato['nombre_categoria']; ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update<?php echo $id_categoria; ?>">
                                                            <i class="fa fa-pencil-alt"></i>
                                                            Editar
                                                        </button>

                                                        <!--Modal para editar/actualizar categorias-->
                                                        <div class="modal fade" id="modal-update<?php echo $id_categoria; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background:#116f4a; color:white;">
                                                                        <h4 class="modal-title">Actualizacion de categoria</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="co l-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="">Nuevo nombre de la categoria</label>
                                                                                    <input type="text" id="nombre_categoria<?php echo $id_categoria; ?>" value="<?php echo $nombre_categoria; ?>"
                                                                                        class="form-control">
                                                                                    <small style="color:red; display:none;" id="lbl_update<?php echo $id_categoria; ?>">* El campo es obligatorio </small>
                                                                                    <small style="color:red; display:none;" id="lbbl_update<?php echo $id_categoria; ?>">* El campo debe tener minimo 3 caracteres </small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                        <button type="button" class="btn btn-success" id="btn_update<?php echo $id_categoria; ?>">actualizar</button>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.modal -->
                                                        <script>
                                                            $('#btn_update<?php echo $id_categoria; ?>').click(function() {
                                                                var nombre_categoria = $('#nombre_categoria<?php echo $id_categoria; ?>').val();
                                                                var id_categoria = '<?php echo $id_categoria; ?>';

                                                                $('#lbl_update<?php echo $id_categoria; ?>').hide();
                                                                $('#lbbl_update<?php echo $id_categoria; ?>').hide();

                                                                if (nombre_categoria == "") {
                                                                    $('#nombre_categoria<?php echo $id_categoria; ?>').focus(); // Enfoca el campo
                                                                    $('#lbl_update<?php echo $id_categoria; ?>').show();
                                                                    return false;
                                                                } 

                                                                if (nombre_categoria.length < 3) {
                                                                $('#nombre_categoria<?php echo $id_categoria; ?>').focus(); //Lo mismo de arriba 
                                                                $('#lbbl_update<?php echo $id_categoria; ?>').show();
                                                                return false;
                                                                }
                                                                var url = "../app/controllers/categorias/update_de_categorias.php";
                                                                $.get(url, {
                                                                    nombre_categoria: nombre_categoria,
                                                                    id_categoria: id_categoria
                                                                }, function(datos) {
                                                                    $('#respuesta_update<?php echo $id_categoria; ?>').html(datos);
                                                                });
                                                                

                                                            });
                                                        </script>
                                                        <div id="respuesta_update<?php echo $id_categoria; ?>"></div>

                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th>
                                            <center>Nombre de la categoria</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>

                                    </tr>
                                </tfoot>
                            </table>

                            <!-- <table id="table_usuarios" class="table table-bordered table-striped">-->

                        </div>
                        <!-- /.card-body -->
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


<!-- Page specific script-->
<script>
    $(function() {
        $("#table_usuarios").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorias",
                "infoEmpty": "Mostrando 0 a 0 de 0 Categorias",
                "infoFiltered": "(Filtrado de _MAX_ total Categorias)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Categorias",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [{
                    extend: 'collection',
                    text: 'Reportes',
                    orientation: 'landscape',
                    buttons: [{
                            text: 'Copiar',
                            extend: 'copy',
                        },
                        {
                            extend: 'pdf'
                        },
                        {
                            extend: 'csv'
                        },
                        {
                            extend: 'excel'
                        },
                        {
                            text: 'Imprimir',
                            extend: 'print'
                        },
                    ]
                },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                },
            ]
        }).buttons().container().appendTo('#table_usuarios_wrapper .col-md-6:eq(0)');
    });
</script>


<!--Modal para registrar categorias-->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#1d36b6; color:white;">
                <h4 class="modal-title">Creacion de una nueva categoria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de la categoria <b>*</b></label>
                            <input type="text" id="nombre_categoria" class="form-control">
                            <small style="color:red; display:none;" id="lbl_create">Este campo es obligatorio</small>
                            <small style="color:red; display:none;" id="lbbl_create">El campo debe contener minimo 3 caracteres</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Registrar Categoria</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<script>
    $('#btn_create').click(function() {
        // alert("Guardar");
        var nombre_categoria = $('#nombre_categoria').val();

        $('#lbl_create').hide();
        $('#lbbl_create').hide();



        //Para no enviar información basura
        if (nombre_categoria === "") {
            $('#nombre_categoria').focus(); // Enfoca el campo
            $('#lbl_create').css('display', 'block');

            return false; //El envio se cancela
        }
        //Minimo de caracteres
        if (nombre_categoria.length < 3) {
            $('#nombre_categoria').focus(); //Lo mismo de arriba 
            $('#lbbl_create').show();
            return false;
        }

        var url = "../app/controllers/categorias/registro_de_categorias.php";
        $.get(url, {
            nombre_categoria: nombre_categoria
        }, function(datos) {
            $('#respuesta').html(datos);
        });

    })
</script>

<div id="respuesta"></div>
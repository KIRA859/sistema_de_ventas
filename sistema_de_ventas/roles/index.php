<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

include('../app/controllers/roles/listado_de_roles.php');


?>


<!--content wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de roles</h1>
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
                            <h3 class="card-title">Roles Registrados</h3>

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
                                            <center>Nombre del rol</center>
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
                                    foreach ($roles_datos as $roles_dato) {
                                        $id_rol = $roles_dato['id_rol'];  ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador = $contador + 1 ?></center>
                                            </td>
                                            <td><?php echo $roles_dato['rol']; ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <a href="update.php?id=<?php echo $id_rol; ?>" type="button" class="btn btn-success">
                                                            <i class="fa fa-pencil-alt"></i>Editar</a>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete<?php echo $id_rol; ?>">
                                                            <i class="fa fa-trash"></i> Borrar
                                                        </button>

                                                        <div class="btn-group">
                                                            <!-- Botón eliminar que abre el modal -->
                                                        </div>
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>

                                        <!-- Modal de confirmación -->
                                        <div class="modal fade" id="confirmDelete<?php echo $id_rol; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel<?php echo $id_rol; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmar eliminación</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Seguro que quieres eliminar el rol <b><?php echo $roles_dato['rol']; ?></b>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <a href="../app/controllers/roles/delete.php?id=<?php echo $id_rol; ?>" class="btn btn-danger">Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                            <center>Nombre del rol</center>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
                "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
                "infoFiltered": "(Filtrado de _MAX_ total Roles)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
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
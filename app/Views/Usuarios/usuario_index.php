Views/usuarios/usuario_index.php

<?= $this->extend('layout/dashboard' ); ?>



<?= $this->section('content') ?>

<section class="col-12">
    <div class="card">
        <h4 class="fw-bold mb-3">
            
        LISTA DE USUARIOS</h4>

<?php if(session()->getFlashdata("msg")){ ?>
      <div class="alert alert-success">
        <?= session()->getFlashdata("msg") ?>   
    </div>
<?php } ?>
<?php if(session()->getFlashdata("error")){ ?>
     <div class="alert alert-danger">
        <?= session()->getFlashdata("error") ?>   
    </div>
<?php } ?>

        <a href="/usuarios/create" class="btn btn-sm btn-primary mb-3"><i class="bi bi-plus-circle"></i> Nuevo Usuario</a>




        <table class="table table-responsive">
        
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Status</th>
            </tr>

        </thead>


    

        <tbody>
        <?php foreach ($usuarios as $usuario){ ?>
            <tr> <!-- renglon -->
                <th><?= $usuario['id'] ?></th>
                <td><?= $usuario['nombre'] ?></td>
                <td><?= $usuario['email'] ?></td>
                <td><?= $usuario['status'] ?></td>
                <td>


                    <a href="/usuarios/<?= $usuario['id']; ?>" class=" btn btn-sm btn-success"><i class="bi bi-eye"></i></a>


                <!-- solo admin y trabajador pueden editar -->
                <?php if(
                    session()->get('usuario.rol') == 'admin'
                    OR session()->get('usuario.rol') == 'trabajador'){ ?>
                    
                <?php } ?>

                    <a href="/usuarios/edit/<?= $usuario['id']; ?>"class=" btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>


                <!-- solo admin puede eliminar -->
                <?php if(
                    session()->get('usuario.rol') == 'admin'){ ?>
                    <form id="delete-user-<?= $usuario['id']; ?>" action="/usuarios/delete/<?= $usuario['id']; ?>" method="POST" class="d-inline">
                        <button type="submit" class=" btn btn-sm btn-danger"><i class="bi bi-trash3"></i></button>
                    </form>
                <?php } ?>


                </td>
            </tr> <!-- Fin renglon -->
        <?php    }   ?>
 
        </tbody>
    </table>
<script>
    document.querySelectorAll('form[id^="delete-user-"]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, elimínalo!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
    });
</script>


<?= $this->endSection() ?>
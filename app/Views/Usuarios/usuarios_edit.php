<?= $this->extend('layout/dashboard' ); ?>

<?= $this->section('content') ?>


<div class="col-md-8">
<div class="card p-4">
    <h5 class="fw-bold mb-3">EDITAR USUARIO</h5>

    <?php if( session()->getFlashdata('errors') ){
        foreach(session()->getFlashdata('errors') as $error){ ?>

 
    <div class="alert alert-danger">
        <?= ($error) ?>   

    </div>

    <?php } } ?>



    
     <form id="usuario-edit-form" action ="/usuarios/update/<?= $usuario['id'] ?>" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" 
            value="<?= $usuario['nombre'] ?>"
            required="true">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email"
            maxlength="100"
            required="true"
            class="form-control"
            value="<?= $usuario["email"] ?>"
            class="form-control">
        </div>
        
        <div class="mb-3">
            <label>contraseña</label>
            <input type="password" name="contrasena"
            maxlength="25"
            minlength="8"
            
             class="form-control">
        </div>


        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>



</div>
</div> 

<?= $this->endSection() ?>
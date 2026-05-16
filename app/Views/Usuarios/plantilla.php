<?= $this->extend('layout/dashboard' ); ?>

<?= $this->section('content') ?>


<div class="col-md-8">
<div class="card p-4">
    <h5 class="fw-bold mb-3">CREAR USUARIO</h5>
    
    <form action ="/usuarios/store" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email"
            maxlength="100"
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
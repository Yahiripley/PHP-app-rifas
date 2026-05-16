<?= $this->extend('layout/dashboard' ); ?>

<?= $this->section('content') ?>


<div class="col-md-8">
<div class="card p-4">
    <h5 class="fw-bold mb-3">CREAR USUARIO</h5>

    <?php if( session()->getFlashdata('errors') ){
        foreach(session()->getFlashdata('errors') as $error){ ?>

 
    <div class="alert alert-danger">
        <?= ($error) ?>   

    </div>

    <?php } } ?>



    
    <form id="usuario-create-form" action ="/usuarios/store" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required="true">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email"
            maxlength="100"
            required="true"
            class="form-control">
        </div>
        
        <div class="mb-3">
            <label>contraseña</label>
            <input type="password" name="contrasena"
            maxlength="25"
            minlength="8"
            required="true"
             class="form-control">
        </div>


        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>



</div>
<script>
    document.getElementById('usuario-create-form')?.addEventListener('submit', function (event) {
        if (!this.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            alert('Completa todos los campos obligatorios.');
        }
    });
</script>
</div> 

<?= $this->endSection() ?>
<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content') ?>
<section class="col-12 col-lg-8">
    <div class="card p-4">
        <h4 class="fw-bold mb-3"><?= $rifa ? 'EDITAR RIFA' : 'CREAR RIFA' ?></h4>

        <?php if (session()->getFlashdata('errors')) {
            foreach (session()->getFlashdata('errors') as $error) { ?>
                <div class="alert alert-danger"><?= esc($error) ?></div>
        <?php }
        } ?>

         <form id="rifa-form" action="<?= esc($action) ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre" required
                    value="<?= old('nombre', $rifa['nombre'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion"><?= old('descripcion', $rifa['descripcion'] ?? '') ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Costo por boleto</label>
                <input class="form-control" type="number" step="0.01" min="0.01" name="costo_boleto" required
                    value="<?= old('costo_boleto', $rifa['costo_boleto'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha del sorteo</label>
                <input class="form-control" type="date" name="fecha_sorteo" required
                    value="<?= old('fecha_sorteo', $rifa['fecha_sorteo'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Premio</label>
                <input class="form-control" type="text" name="premio" required
                    value="<?= old('premio', $rifa['premio'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen promocional (URL)</label>
                <input class="form-control" type="url" name="imagen_promocional"
                    value="<?= old('imagen_promocional', $rifa['imagen_promocional'] ?? '') ?>">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="/rifas" class="btn btn-secondary">Cancelar</a>
        </form>
        <script>
            document.getElementById('rifa-form')?.addEventListener('submit', function (event) {
                if (!this.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    alert('Completa todos los campos obligatorios.');
                }
            });
        </script>
    </div>
</section>
<?= $this->endSection() ?>


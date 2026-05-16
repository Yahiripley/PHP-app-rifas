<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content') ?>
<section class="col-12">
    <div class="card p-4 mb-4">
        <h4 class="fw-bold mb-2"><?= esc($rifa['nombre']) ?></h4>
        <?php if (!empty($rifa['imagen_promocional'])) { ?>
            <img src="<?= esc($rifa['imagen_promocional']) ?>" alt="Imagen promocional de <?= esc($rifa['nombre']) ?>" class="img-fluid rounded my-3" style="max-height: 320px; object-fit: cover;">
        <?php } ?>
        <p class="mb-1"><strong>Premio:</strong> <?= esc($rifa['premio']) ?></p>
        <p class="mb-1"><strong>Costo boleto:</strong> $<?= esc($rifa['costo_boleto']) ?></p>
        <p class="mb-1"><strong>Fecha sorteo:</strong> <?= esc($rifa['fecha_sorteo']) ?></p>
        <p class="mb-0"><strong>Descripción:</strong> <?= esc($rifa['descripcion']) ?></p>

        <?php if (session()->getFlashdata('msg')) { ?>
            <div class="alert alert-success mt-3 mb-0"><?= session()->getFlashdata('msg') ?></div>
        <?php } ?>
        <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger mt-3 mb-0"><?= session()->getFlashdata('error') ?></div>
        <?php } ?>
    </div>

    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Mapa de boletos</h5>
            <form action="/rifas/simular/<?= esc($rifa['id']) ?>" method="POST">
                <button class="btn btn-sm btn-warning" type="submit">Simular rifa</button>
            </form>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <?php foreach ($boletos as $boleto) {
                $estado = $boleto['estado'];
                $clase = 'secondary';
                $textoEstado = 'Libre';
                if ($estado === 'disponible') {
                    $clase = 'success';
                    $textoEstado = 'Libre';
                } elseif ($estado === 'apartado') {
                    $clase = 'warning';
                    $textoEstado = 'Apartado';
                } elseif ($estado === 'pagado') {
                    $clase = 'danger';
                    $textoEstado = 'Pagado';
                } ?>
                <span class="badge bg-<?= $clase ?> p-2">
                    <?= esc($boleto['numero_boleto']) ?> - <?= esc($textoEstado) ?>
                    <?php if ($boleto['resultado'] !== 'ninguno') { ?>
                        - <?= esc($boleto['resultado']) ?>
                    <?php } ?>
                </span>
            <?php } ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

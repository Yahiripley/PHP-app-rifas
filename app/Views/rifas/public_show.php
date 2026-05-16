<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($rifa['nombre']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="/rifas/catalogo" class="btn btn-outline-secondary btn-sm">Volver</a>
            <a href="/usuarios/logout" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
        </div>

        <div class="card p-4 mb-4">
            <h3 class="fw-bold"><?= esc($rifa['nombre']) ?></h3>
            <?php if (!empty($rifa['imagen_promocional'])) { ?>
                <img src="<?= esc($rifa['imagen_promocional']) ?>" alt="Imagen promocional de <?= esc($rifa['nombre']) ?>" class="img-fluid rounded my-3" style="max-height: 320px; object-fit: cover;">
            <?php } ?>
            <p class="mb-1"><strong>Premio:</strong> <?= esc($rifa['premio']) ?></p>
            <p class="mb-1"><strong>Costo por boleto:</strong> $<?= esc($rifa['costo_boleto']) ?></p>
            <p class="mb-0"><strong>Descripción:</strong> <?= esc($rifa['descripcion']) ?></p>
        </div>

        <?php if (session()->getFlashdata('msg')) { ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php } ?>
        <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php } ?>

        <div class="card p-4">
            <h5 class="fw-bold mb-3">Boletos</h5>
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
                    <div class="border rounded p-2" style="min-width: 140px;">
                        <div class="fw-bold">#<?= esc($boleto['numero_boleto']) ?></div>
                        <span class="badge bg-<?= $clase ?>"><?= esc($textoEstado) ?></span>
                        <?php if ($boleto['resultado'] !== 'ninguno') { ?>
                            <div class="small mt-1">Resultado: <?= esc($boleto['resultado']) ?></div>
                        <?php } ?>
                        <?php if ($estado === 'disponible') { ?>
                            <form action="/rifas/comprar/<?= esc($rifa['id']) ?>/<?= esc($boleto['id']) ?>" method="POST" class="mt-2">
                                <button type="submit" class="btn btn-primary btn-sm w-100">Comprar</button>
                            </form>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>

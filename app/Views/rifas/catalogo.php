<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Rifas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Rifas disponibles</h2>
            <a href="/usuarios/logout" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
        </div>

        <?php if (session()->getFlashdata('msg')) { ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php } ?>
        <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php } ?>

        <div class="row g-3">
            <?php foreach ($rifas as $rifa) { ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <?php if (!empty($rifa['imagen_promocional'])) { ?>
                            <img src="<?= esc($rifa['imagen_promocional']) ?>" class="card-img-top" alt="Imagen promocional de <?= esc($rifa['nombre']) ?>" style="height: 220px; object-fit: cover;">
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($rifa['nombre']) ?></h5>
                            <p class="card-text mb-1"><strong>Premio:</strong> <?= esc($rifa['premio']) ?></p>
                            <p class="card-text mb-1"><strong>Costo:</strong> $<?= esc($rifa['costo_boleto']) ?></p>
                            <p class="card-text"><strong>Sorteo:</strong> <?= esc($rifa['fecha_sorteo']) ?></p>
                            <a href="/rifas/<?= esc($rifa['id']) ?>" class="btn btn-primary btn-sm">Ver detalle</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

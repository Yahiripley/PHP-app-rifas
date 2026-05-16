<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content') ?>
<section class="col-12">
    <div class="card p-4">
        <h4 class="fw-bold mb-3">LISTA DE RIFAS</h4>

        <?php if (session()->getFlashdata('msg')) { ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php } ?>
        <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php } ?>

        <div class="mb-3">
            <a href="/rifas/create" class="btn btn-sm btn-primary">Nueva Rifa</a>
        </div>

        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Costo boleto</th>
                    <th>Fecha sorteo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rifas as $rifa) { ?>
                    <tr>
                        <td><?= esc($rifa['id']) ?></td>
                        <td><?= esc($rifa['nombre']) ?></td>
                        <td>$<?= esc($rifa['costo_boleto']) ?></td>
                        <td><?= esc($rifa['fecha_sorteo']) ?></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="/rifas/<?= esc($rifa['id']) ?>">Ver</a>
                            <a class="btn btn-sm btn-primary" href="/rifas/edit/<?= esc($rifa['id']) ?>">Editar</a>
                            <?php if (session()->get('usuario.rol') === 'admin') { ?>
                                 <form action="/rifas/delete/<?= esc($rifa['id']) ?>" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar esta rifa?');">
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
<?= $this->endSection() ?>


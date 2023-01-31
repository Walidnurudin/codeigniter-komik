<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orang as $o) : ?>
            <tr>
                <th scope="row"><?= $o['id']; ?></th>
                <td><?= $o['name']; ?></td>
                <td><?= $o['address']; ?></td>
                <td>
                    <a href="#" class="btn btn-primary">Detail</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= $pager->links('orang', 'orang_pagination') ?>

<?= $this->endSection(""); ?>
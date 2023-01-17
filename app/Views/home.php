<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php endif; ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">slug</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($komik as $k) : ?>
            <tr>
                <th scope="row"><?= $k['id']; ?></th>
                <td><?= $k['name']; ?></td>
                <td><?= $k['slug']; ?></td>
                <td>

                    <a href="/detail/<?= $k['slug'] ?>" class="btn btn-link">Detail</a>

                    <form action="/<?= $k['id']; ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                    </form>

                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= $this->endSection(""); ?>
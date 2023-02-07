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

                    <a href="/detail/<?= $k['slug'] ?>" class="btn btn-primary">Detail</a>

                    <a href="/edit/<?= $k['slug'] ?>" class="btn btn-warning">Edit</a>

                    <!-- <form action="/<?= $k['id']; ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                    </form> -->

                    <a href="#" type="button" class="btn btn-danger" data-btn="delete-modal" data-id="<?= $k['id']; ?>" data-name="<?= $k['name']; ?>">
                        <i class="far fa-trash-alt fa-xs"></i>
                    </a>

                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete <span id="modal-komik-name"></span> ?</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" id="delete-komik-id" name="id">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(""); ?>

<?= $this->Section('scripts'); ?>
<script>
    $(document).ready(function() {
        $('a[data-btn="delete-modal"]').click(function() {
            const dataId = $(this).attr('data-id');
            const dataName = $(this).attr('data-name');

            $('#modal-komik-name').html(dataName);
            $('#delete-komik-id').val(dataId);
            $('#deleteModal').modal('show');
        })

    });
</script>
<?= $this->endSection(""); ?>
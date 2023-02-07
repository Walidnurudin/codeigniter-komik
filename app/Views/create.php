<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<form action="/create" method="post" class="needs-validation" novalidate>
    <?= csrf_field(); ?>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" id="name" autofocus name="name" value="<?= old('name'); ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('name'); ?>
        </div>
    </div>
    <!-- <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug">
    </div> -->
    <div class="mb-3">
        <label class="form-label" for="content">Content</label>
        <textarea type="text" class="form-control" id="content" name="content"><?= old('content'); ?></textarea>
    </div>

    <!-- <div class="mb-3">
        <input type="text" class="form-control" id="writer" name="writer" value="<?= old('writer'); ?>">
    </div> -->

    <label class="form-label" for="writer">Writer</label>
    <div class="d-flex w-100 mb-3">
        <select class="js-example-basic-single w-100" name="writer">
            <?php foreach ($orang as $o) : ?>
                <option value="<?= $o['id']; ?>"><?= $o['name']; ?> </option>
            <?php endforeach ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?= $this->endSection(""); ?>

<?= $this->Section('scripts'); ?>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<?= $this->endSection(""); ?>
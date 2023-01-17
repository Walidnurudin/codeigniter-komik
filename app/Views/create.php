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
    <div class="mb-3">
        <label class="form-label" for="writer">Writer</label>
        <input type="text" class="form-control" id="writer" name="writer" value="<?= old('writer'); ?>">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    // (() => {
    //     'use strict'

    //     // Fetch all the forms we want to apply custom Bootstrap validation styles to
    //     const forms = document.querySelectorAll('.needs-validation')


    //     // Loop over them and prevent submission
    //     Array.from(forms).forEach(form => {
    //         form.addEventListener('submit', event => {
    //             if (!form.checkValidity()) {
    //                 event.preventDefault()
    //                 event.stopPropagation()
    //             }

    //             form.classList.add('was-validated')
    //         }, false)
    //     })
    // })()
</script>

<?= $this->endSection(""); ?>
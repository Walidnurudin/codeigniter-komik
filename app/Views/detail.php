<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<a href="<?= base_url() ?>" class="btn btn-primary mb-5">Back</a>

<div class="card" style="width: 18rem;">
    <!-- <img src="..." class="card-img-top" alt="..."> -->
    <div class="card-body">
        <h5 class="card-title"><?= $komik['name']; ?></h5>
        <p class="card-text"><?= $komik['content']; ?></p>
    </div>
</div>

<?= $this->endSection(""); ?>
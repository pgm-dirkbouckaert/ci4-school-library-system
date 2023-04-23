<?= $this->extend('/layout/template') ?>

<?= $this->section('content') ?>

<div class="row mb-5">
  <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

    <h2 class="my-3"><?= lang("bib.newCollection") ?></h2>

    <form action="<?= base_url("/collections/add") ?>" method="POST" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="my-3">
        <label for="name" class="form-label"><?= lang("bib.name") ?></label>
        <input type="text" id="name" value="<?= isset($input) ? $input['name'] : '' ?>" class="form-control <?= ($validation->hasError('name')) ? "is-invalid" : "" ?>" name="name" autofocus required>
        <div class="invalid-feedback">
          <?= $validation->getError('name') ?>
        </div>
      </div>
      <div class="my-3">
        <label for="location" class="form-label"><?= lang("bib.location") ?></label>
        <input type="text" id="location" value="<?= isset($input) ? $input['location'] : '' ?>" class="form-control <?= ($validation->hasError('location')) ? "is-invalid" : "" ?>" name="location" autofocus required>
        <div class="invalid-feedback">
          <?= $validation->getError('location') ?>
        </div>
      </div>
      <button type="submit" class="btn btn-dark mt-2"><?= lang("bib.addCollection") ?></button>
      <a href="<?= base_url("/collections") ?>" class="btn btn-outline-secondary mt-2"><?= lang("bib.cancel") ?></a>
    </form>
  </div>

  <?= $this->endSection() ?>
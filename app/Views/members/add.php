<?= $this->extend('/layout/template') ?>

<?= $this->section('content') ?>

<div class="row mb-5">
  <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

    <h2 class="my-3"><?= lang("bib.newMember") ?></h2>

    <form action="<?= base_url("/members/add") ?>" method="POST" enctype="multipart/form-data">

      <?= csrf_field() ?>

      <!-- NAME -->
      <div class="my-3">
        <label for="name" class="form-label"><?= lang("bib.name") ?> <span class="text-danger">*</span></label>
        <input type="text" id="name" value="<?= isset($input) ? $input['name'] : '' ?>" class="form-control <?= ($validation->hasError('name')) ? "is-invalid" : "" ?>" name="name" autofocus required>
        <div class="invalid-feedback">
          <?= $validation->getError('name') ?>
        </div>
      </div>
      <!-- EMAIL -->
      <div class="my-3">
        <label for="email" class="form-label"><?= lang("bib.email") ?> <span class="text-danger">*</span></label>
        <input type="email" id="email" value="<?= isset($input)  ? $input['email'] : ''  ?>" class="form-control <?= ($validation->hasError('email')) ? "is-invalid" : "" ?>" name="email" required>
        <div class="invalid-feedback">
          <?= $validation->getError('email') ?>
        </div>
      </div>
      <!-- PHONE -->
      <div class="my-3">
        <label for="phone" class="form-label"><?= lang("bib.phone") ?></label>
        <input type="text" id="phone" value="<?= isset($input)  ? $input['phone'] : ''  ?>" class="form-control <?= ($validation->hasError('phone')) ? "is-invalid" : "" ?>" name="phone">
        <div class="invalid-feedback">
          <?= $validation->getError('phone') ?>
        </div>
      </div>
      <!-- ADDRESS -->
      <div class="my-3">
        <label for="address" class="form-label"><?= lang("bib.address") ?></label>
        <input type="text" id="address" value="<?= isset($input)  ? $input['address'] : ''  ?>" class="form-control <?= ($validation->hasError('address')) ? "is-invalid" : "" ?>" name="address">
        <div class="invalid-feedback">
          <?= $validation->getError('address') ?>
        </div>
      </div>
      <!-- AVATAR -->
      <div class="my-3">
        <label for="img" class="form-label"><?= lang("bib.avatar") ?></label>
        <input class="form-control <?= ($validation->hasError('img')) ? "is-invalid" : "" ?>" type="file" id="img" name="img">
        <div class="invalid-feedback">
          <?= $validation->getError('img') ?>
        </div>
      </div>
      <!-- SUBMIT -->
      <button type="submit" class="btn btn-dark mt-2"><?= lang("bib.addMember") ?></button>
      <a href="<?= base_url("/members") ?>" class="btn btn-outline-secondary mt-2"><?= lang("bib.cancel") ?></a>
    </form>

  </div>
</div>

<?= $this->endSection() ?>
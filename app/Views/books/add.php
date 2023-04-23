<?= $this->extend('/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row mb-5">
  <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

    <h2 class="my-3"><?= lang("bib.newBook") ?></h2>

    <form action="<?= base_url("/books/add") ?>" method="POST" enctype="multipart/form-data">

      <?= csrf_field() ?>

      <div class="my-3">
        <label for="title" class="form-label"><?= lang("bib.title") ?> <span class="text-danger">*</span></label>
        <input type="text" id="title" value="<?= isset($input) ? $input['title'] : '' ?>" class="form-control <?= ($validation->hasError('title')) ? "is-invalid" : "" ?>" name="title" autofocus required>
        <div class="invalid-feedback">
          <?= $validation->getError('title') ?>
        </div>
      </div>
      <div class="my-3">
        <label for="authors" class="form-label"><?= lang("bib.author(s)") ?> <span class="text-danger">*</span></label>
        <input type="text" id="authors" value="<?= isset($input) ? $input['authors'] : '' ?>" class="form-control <?= ($validation->hasError('authors')) ? "is-invalid" : "" ?>" name="authors" required>
        <div class="invalid-feedback">
          <?= $validation->getError('authors') ?>
        </div>
      </div>
      <div class="my-3">
        <label for="isbn" class="form-label">ISBN <span class="text-danger">*</span></label>
        <div class="text-muted small"><?= lang("bib.ISBNFormat") ?></div>
        <div class="text-muted small"><?= lang("bib.noISBN") ?></div>
        <input type="text" id="isbn" value="<?= isset($input) ? $input['isbn'] : '' ?>" class="form-control <?= ($validation->hasError('isbn')) ? "is-invalid" : "" ?>" name="isbn" required>
        <div class="invalid-feedback">
          <?= $validation->getError('isbn') ?>
        </div>
      </div>
      <div class="my-3">
        <label for="language-code" class="form-label"><?= lang("bib.language_code") ?> <span class="text-danger">*</span></label>
        <input type="text" id="language-code" value="<?= isset($input) ? $input['language-code'] : '' ?>" class="form-control <?= ($validation->hasError('language-code')) ? "is-invalid" : "" ?>" name="language-code" placeholder="<?= lang("bib.forExample") ?>: nl, en, fr" required>
        <div class="invalid-feedback">
          <?= $validation->getError('language-code') ?>
        </div>
      </div>
      <div class="my-3">
        <label for="difficulty-level" class="form-label"><?= lang("bib.difficulty_level") ?></label>
        <input type="text" id="difficulty-level" value="<?= isset($input) ? $input['difficulty-level'] : '' ?>" class="form-control <?= ($validation->hasError('difficulty-level')) ? "is-invalid" : "" ?>" name="difficulty-level">
        <div class="invalid-feedback">
          <?= $validation->getError('difficulty-level') ?>
        </div>
      </div>
      <div class="my-3">
        <label for="publication-year" class="form-label"><?= lang("bib.publication_year") ?></label>
        <input type="text" id="publication-year" value="<?= isset($input) ? $input['publication-year'] : '' ?>" class="form-control <?= ($validation->hasError('publication-year')) ? "is-invalid" : "" ?>" name="publication-year" placeholder="Syntax: yyyy">
        <div class="invalid-feedback">
          <?= $validation->getError('publication-year') ?>
        </div>
      </div>
      <div class="my-3">
        <label for="publisher" class="form-label"><?= lang("bib.publisher") ?></label>
        <input type="text" id="publisher" value="<?= isset($input) ? $input['publisher'] : '' ?>" class="form-control <?= ($validation->hasError('publisher')) ? "is-invalid" : "" ?>" name="publisher">
        <div class="invalid-feedback">
          <?= $validation->getError('publisher') ?>
        </div>
      </div>
      <div class="my-3">
        <label for="img" class="form-label"><?= lang("bib.image") ?></label>
        <input class="form-control <?= ($validation->hasError('img')) ? "is-invalid" : "" ?>" type="file" id="img" name="img">
        <div class="invalid-feedback">
          <?= $validation->getError('img') ?>
        </div>
      </div>
      <button type="submit" class="btn btn-dark mt-2"><?= lang("bib.addBook") ?></button>
      <a href="<?= base_url("/books") ?>" class="btn btn-outline-secondary mt-2"><?= lang("bib.cancel") ?></a>
    </form>
  </div>
</div>

<?= $this->endSection(); ?>
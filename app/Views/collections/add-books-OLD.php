<?= $this->extend('/layout/template') ?>

<?= $this->section('content') ?>

<div class="row mb-5">
  <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

    <h2 class="my-3"><?= lang("bib.addBooksToCollection") ?></h2>

    <form action="<?= base_url("/collections/add-books/" . $collection["collection_id"]) ?>" method="POST" enctype="multipart/form-data">

      <?= csrf_field() ?>

      <div class="my-3">
        <label for="name" class="form-label"><?= lang("bib.nameOfCollection") ?></label>
        <input type="text" id="name" value="<?= $collection["name"] ?>" class="form-control <?= ($validation->hasError('name')) ? "is-invalid" : "" ?>" name="name" disabled required>
        <div class="invalid-feedback">
          <?= $validation->getError('name') ?>
        </div>
      </div>

      <div class="my-3">
        <label for="books" class="form-label"><?= lang("bib.books") ?></label>
        <div class="text-muted small mb-1">
          <?= lang("bib.multipleSelectionsPossible") ?><br>
          <?= lang("bib.currentBooksActive") ?><br>
          <?= lang("bib.useCtrlClick") ?><br>
          <?= lang("bib.useShiftClick") ?>
        </div>
        <select name="books[]" id="books" class="form-select" multiple size="15">
          <?php foreach ($books as $b) : ?>
            <option value="<?= $b["book_id"] ?>" <?= in_array($b["book_id"], $currentBookIds) ? "selected" : "" ?>><?= $b["title"] ?> (<?= $b["authors"] ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type=" submit" class="btn btn-dark mt-2"><?= lang("bib.save") ?></button>
      <a href="<?= base_url("/collections/detail/" . $collection["collection_id"]) ?>" class="btn btn-outline-secondary mt-2"><?= lang("bib.cancel") ?></a>
    </form>
  </div>

  <?= $this->endSection() ?>
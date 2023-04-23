<?= $this->extend('/layout/template') ?>

<?= $this->section('content') ?>

<div class="row mb-5">
  <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

    <h2 class="my-3"><?= lang("bib.addBookToCollections") ?></h2>

    <form action="<?= base_url("/books/add-to-collections/" . $book["book_id"]) ?>" method="POST" enctype="multipart/form-data">

      <?= csrf_field() ?>

      <div class="my-3">
        <label for="title" class="form-label"><?= lang("bib.titleOfBook") ?></label>
        <input type="text" id="title" value="<?= $book["title"] ?>" class="form-control <?= ($validation->hasError('title')) ? "is-invalid" : "" ?>" name="title" disabled required>
        <div class="invalid-feedback">
          <?= $validation->getError('title') ?>
        </div>
      </div>

      <div class="my-3">
        <label for="collections" class="form-label"><?= lang("bib.collections") ?></label>
        <div class="text-muted small mb-1"><?= lang("bib.multipleSelectionsPossible") ?><br><?= lang("bib.currentCollectionsActive") ?></div>
        <select name="collections[]" id="collections" class="form-select" multiple size="15">
          <?php foreach ($collections as $c) : ?>
            <option value="<?= $c["collection_id"] ?>" <?= in_array($c["collection_id"], $currentCollectionIds) ? "selected" : "" ?>><?= $c["name"] ?> (<?= $c["location"] ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type=" submit" class="btn btn-dark mt-2"><?= lang("bib.add") ?></button>
      <a href="<?= base_url("/books/detail/" . $book["book_id"]) ?>" class="btn btn-outline-secondary mt-2"><?= lang("bib.cancel") ?></a>
    </form>
  </div>

  <?= $this->endSection() ?>
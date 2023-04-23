<?= $this->extend('/layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Flash -->
<?= $this->include("partials/flash") ?>

<!-- Modal Confirm Delete -->
<?= $this->include("collections/partials/confirm-delete-modal") ?>

<!-- Details -->
<div class="container mb-5">
  <div class="row mb-3">

    <div class="col mb-3">
      <a href="<?= base_url("/collections") ?>" class="btn btn-sm btn-outline-secondary"><?= lang("bib.goBacktoCollections") ?></a>
      <?php if (logged_in()) : ?>
        <a href="<?= base_url("/collections/add-books/" . $collection['collection_id']) ?>" title="<?= lang("bib.addBooks") ?>"><i class="fa-solid fa-layer-group text-success ms-2 me-1 fs-4 align-middle"></i></a>
        <a href="<?= base_url("/collections/edit/" . $collection['collection_id']) ?>" title="<?= lang("bib.edit") ?>"><i class="fa-regular fa-pen-to-square ms-2 me-1 text-warning fs-4 align-middle"></i></a>
        <i class="fa-regular fa-trash-can text-danger ms-2 me-1 fs-4 align-middle btn-delete" title="<?= lang("bib.delete") ?>" role="button" data-collection-id="<?= $collection['collection_id'] ?>" data-collection-name="<?= $collection['name'] ?>"></i>
      <?php endif; ?>
    </div>
  </div>
  <div class="row mb-3">

    <div class="col mb-3">

      <!-- TITLE -->
      <h3><?= $collection['name'] ?></h3>
      <!-- ID -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.id") ?></div>
        <div class="col-md-6"><?= $collection['collection_id'] ?></div>
      </div>

      <!-- LOCATION -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.location") ?></div>
        <div class="col-md-6"><?= $collection['location'] ?></div>
      </div>

      <!-- NUMBER OF BOOKS -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.numberOfBooks") ?></div>
        <div class="col-md-6"><?= $collection['number_of_books'] ?></div>
      </div>

      <!-- BOOKS -->
      <div class="row border border-1 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.books") ?></div>
        <div class="col-md-8">
          <?php
          if (count($books) === 0) echo "&#x2205;";
          else { ?>
            <ul class="ps-3">
              <?php foreach ($books as $b) : ?>
                <li> <a href="<?= base_url("/books/detail/" . $b["book_id"]) ?>"><?= $b["title"] ?></a> <?= $b["authors"] !== "" ? '<span class="small">(' . $b["authors"] . ')</span>' : "" ?></li>
              <?php endforeach; ?>
            </ul>
          <?php } ?>
        </div>
      </div>

    </div>

  </div>
</div>
</div>

<?= $this->include("collections/partials/confirm-delete-script") ?>

<?= $this->endSection(); ?>
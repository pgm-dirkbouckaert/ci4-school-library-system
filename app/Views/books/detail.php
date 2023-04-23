<?= $this->extend('/layout/template'); ?>


<?= $this->section('content'); ?>

<?= $this->include("partials/flash") ?>

<div class="container mb-5">
  <div class="row">
    <div class="col mb-3">
      <a href="<?= base_url("/books") ?>" class="btn btn-sm btn-outline-secondary"><?= lang("bib.goBacktoBooks") ?></a>
      <?php if (logged_in()) : ?>
        <a href="<?= base_url("/books/add-to-collections/" . $book['book_id']) ?>" title="<?= lang("bib.addToCollections") ?>"><i class="fa-solid fa-layer-group text-success ms-2 me-1 fs-4 align-middle"></i></a>
        <a href="<?= base_url("/books/edit/" . $book['book_id']) ?>" title="<?= lang("bib.edit") ?>"><i class="fa-regular fa-pen-to-square ms-2 me-1 text-warning fs-4 align-middle"></i></a>
        <a href="<?= base_url("/books/delete/" . $book['book_id']) ?>" title="<?= lang("bib.delete") ?>"><i class="fa-regular fa-trash-can ms-2 me-1 text-danger fs-4 align-middle"></i></a>
      <?php endif; ?>
    </div>
    <?= $this->include("books/detail_book_data") ?>
  </div>
</div>

<?= $this->endSection(); ?>
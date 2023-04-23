<?= $this->extend('/layout/template'); ?>


<?= $this->section('content'); ?>

<div class="container">

  <!-- Confirm delete -->
  <div class="alert alert-danger mb-4" role="alert">
    <p><?= lang("bib.confirmDeleteBook") ?></p>
    <form action="<?= base_url("/books/delete/" . $book["book_id"]) ?>" method="post">
      <?= csrf_field() ?>
      <button type="submit" class="btn btn-danger"><?= lang("bib.delete") ?></button>
      <a href="<?= base_url("/books") ?>" class="btn btn-success"><?= lang("bib.cancel") ?></a>
    </form>
  </div>

  <!-- Book data -->
  <?= $this->include("books/detail_book_data") ?>
</div>

<?= $this->endSection(); ?>
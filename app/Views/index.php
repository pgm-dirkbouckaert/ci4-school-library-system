<?= $this->extend('/layout/template') ?>

<?= $this->section('content') ?>


<div class="container-fluid">

  <?= $this->include("partials/flash") ?>

  <!-- Title -->
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="mt-3"><?= lang("bib.dashboard") ?></h1>
    </div>
  </div>

  <!-- Counts -->
  <div class="row">
    <div class="col-lg-3 col-6 mb-3">
      <div class="p-2 bg-info-subtle rounded-1 shadow-sm">
        <div class="inner">
          <h2><?= $counts['books'] ?></h2>
          <p><?= lang("bib.numberOfBooks") ?></p>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-6 mb-3">
      <div class="p-2 bg-success-subtle rounded-1 shadow-sm">
        <div class="inner">
          <h2><?= $counts['members'] ?></h2>
          <p><?= lang("bib.numberOfMembers") ?></p>
        </div>
      </div>
    </div>

    <?php if (logged_in()) : ?>
      <div class="col-lg-3 col-6 mb-3">
        <div class="p-2 bg-warning-subtle rounded-1 shadow-sm">
          <div class="inner">
            <h2><?= $counts['checkouts'] ?></h2>
            <p><?= lang("bib.numberOfCurrentCheckouts") ?></p>
          </div>
        </div>
      </div>
    <?php endif; ?>

  </div>

  <!-- Pages -->
  <div class="row mb-2">
    <div class="col-sm-6">
      <h5 class="mt-3"><?= lang("bib.goToPage") ?></h5>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-6 mb-3">
      <a href="<?= base_url("/books") ?>" class="goToLink">
        <div class="p-2 rounded-1 border shadow-sm h-100 d-flex justify-content-center align-items-center">
          <?= lang("bib.book_list") ?>
        </div>
      </a>
    </div>

    <div class="col-lg-3 col-6 mb-3">
      <a href="<?= base_url("/collections") ?>" class="goToLink">
        <div class="p-2 bg-rounded-1 border shadow-sm h-100 d-flex justify-content-center align-items-center">
          <?= lang("bib.collections") ?>
        </div>
      </a>
    </div>

    <?php if (logged_in()) : ?>
      <div class="col-lg-3 col-6 mb-3">
        <a href="<?= base_url("/members") ?>" class="goToLink">
          <div class="p-2 bg-rounded-1 border shadow-sm h-100 d-flex justify-content-center align-items-center">
            <?= lang("bib.members") ?>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-6 mb-3">
        <a href="<?= base_url("/checkouts") ?>" class="goToLink">
          <div class="p-2 bg-rounded-1 border shadow-sm h-100 d-flex justify-content-center align-items-center">
            <?= lang("bib.checkouts") ?>
          </div>
        </a>
      </div>
    <?php endif; ?>

  </div>
</div>

<?= $this->endSection() ?>
<?= $this->extend('/layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Flash -->
<?= $this->include("partials/flash") ?>

<!-- Modal Confirm Delete -->
<?= $this->include("members/partials/confirm-delete-modal") ?>

<!-- Details -->
<div class="container mb-5">

  <div class="row">
    <div class="col mb-3">
      <a href="<?= base_url("/members") ?>" class="btn btn-sm btn-outline-secondary"><?= lang("bib.goBacktoMemberList") ?></a>
      <a href="<?= base_url("/members/manage-checkouts/" . $member['member_id']) ?>" title="<?= lang("bib.manageCheckouts") ?>"><i class="fa-solid fa-layer-group text-success ms-2 me-1 fs-4 align-middle"></i></a>
      <a href="<?= base_url("/members/edit/" . $member['member_id']) ?>" title="<?= lang("bib.edit") ?>"><i class="fa-regular fa-pen-to-square text-warning ms-2 me-1 fs-4 align-middle"></i></a>
      <i class="fa-regular fa-trash-can text-danger ms-2 me-1 fs-4 align-middle btn-delete" title="<?= lang("bib.delete") ?>" role="button" data-member-id="<?= $member['member_id'] ?>" data-member-name="<?= $member['name'] ?>"></i>
    </div>
  </div>

  <div class="row mb-3">
    <!--  IMAGE -->
    <div class="col-md-3 mb-3 image-detail">
      <img src="<?= base_url("public/images/avatars/" . $member['img']) ?>" alt="avatar" class="img-fluid">
    </div>

    <!-- MEMBER DATA -->
    <div class="col-md-9">
      <!-- NAME -->
      <h3><?= $member['name'] ?></h3>
      <!-- ID -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.id") ?></div>
        <div class="col-md-8"><?= $member['member_id'] ?></div>
      </div>
      <!-- STATUS -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.status") ?></div>
        <div class="col-md-8"><?= $member['status'] ?></div>
      </div>
      <!-- EMAIL -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.email") ?></div>
        <div class="col-md-8"><?= $member['email'] ?></div>
      </div>
      <!-- PHONE -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.phone") ?></div>
        <div class="col-md-8"><?= $member['phone'] ? $member['phone'] : "&#x2205;" ?></div>
      </div>
      <!-- ADDRESS -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.address") ?></div>
        <div class="col-md-8"><?= $member['address'] ? $member['difficulty_level'] : "&#x2205;" ?></div>
      </div>
      <!-- CREATED AT -->
      <div class="row border border-1 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.createdMemberAt") ?></div>
        <div class="col-md-8"><?= $member['created_at'] ? date_format(date_create($member["created_at"]), "m/d/Y") : "&#x2205;" ?></div>
      </div>
      <!-- CURRENT CHECKOUTS -->
      <div class="row border border-1 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.currentCheckouts") ?></div>
        <div class="col-md-8">

          <?php
          if (count($checkouts) === 0) : ?>
            &#x2205;
          <?php else : ?>
            <ul class="ps-3">
              <?php foreach ($checkouts as $c) : ?>
                <li>
                  <a href="<?= base_url("/books/detail/" . $c["book_id"]) ?>"><?= $c["book_title"] ?></a>
                  <span class="small">(<?= lang("bib.checkoutAt") ?> <?= date_format(date_create($c["created_at"]), "m/d/Y") ?>)</span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </div>

</div>

<!-- Script -->
<?= $this->include("members/partials/confirm-delete-script") ?>

<?= $this->endSection(); ?>
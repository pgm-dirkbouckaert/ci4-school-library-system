<!-- Modal Confirm Delete -->
<div class="modal fade" id="modal-delete" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= lang("bib.deleteMember") ?></h5>
        <button type=" button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" id="form-delete">
        <?= csrf_field() ?>
        <div class="modal-body" id="modal-body"></div>
        <div class=" modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang("bib.cancel") ?></button>
          <button type="submit" class="btn btn-danger"><?= lang("bib.delete") ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
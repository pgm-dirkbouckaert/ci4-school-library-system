<?php if (session("msg")) : ?>
  <div class="alert alert-<?= session("type") ?> alert-dismissible fade show mb-4" role="alert">
    <?= session("msg") ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>
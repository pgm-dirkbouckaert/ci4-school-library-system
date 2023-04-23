<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
  <div class="row row d-flex justify-content-center">
    <div class="col-sm-8 col-md-6 col-xl-4">

      <div class="card">
        <h3 class="card-header"><?= lang('Auth.forgotPassword') ?></h3>
        <div class="card-body">

          <?= $this->include('Auth/partials/message_block') ?>

          <p><?= lang('Auth.enterEmailForInstructions') ?></p>

          <form action="<?= url_to('forgot') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
              <label for="email" class="form-label"><?= lang('Auth.emailAddress') ?></label>
              <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" autofocus>
              <div class="invalid-feedback">
                <?= session('errors.email') ?>
              </div>
            </div>

            <div class="d-grid gap-3 mt-4">
              <button type=" submit" class="btn btn-dark btn-block"><?= lang('Auth.sendInstructions') ?></button>
              <a href="<?= base_url("/") ?>" class="btn btn-outline-secondary"><?= lang('bib.cancel') ?></a>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
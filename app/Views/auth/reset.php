<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
  <div class="row row d-flex justify-content-center">
    <div class="col-sm-8 col-md-6 col-xl-4">

      <div class="card">
        <h3 class="card-header"><?= lang('Auth.resetYourPassword') ?></h3>
        <div class="card-body">

          <?= $this->include('Auth/partials/message_block') ?>

          <p><?= lang('Auth.enterCodeEmailPassword') ?></p>

          <form action="<?= url_to('reset-password') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
              <label for="token" class="form-label"><?= lang('Auth.token') ?></label>
              <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">
              <div class="invalid-feedback">
                <?= session('errors.token') ?>
              </div>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label"><?= lang('Auth.email') ?></label>
              <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
              <div class="invalid-feedback">
                <?= session('errors.email') ?>
              </div>
            </div>

            <br>

            <div class="mb-3">
              <label for="password" class="form-label"><?= lang('Auth.newPassword') ?></label>
              <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password">
              <div class="invalid-feedback">
                <?= session('errors.password') ?>
              </div>
            </div>

            <div class="mb-3">
              <label for="pass_confirm" class="form-label"><?= lang('Auth.newPasswordRepeat') ?></label>
              <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm">
              <div class="invalid-feedback">
                <?= session('errors.pass_confirm') ?>
              </div>
            </div>

            <div class="d-grid gap-3">
              <button type="submit" class="btn btn-dark"><?= lang('Auth.resetPassword') ?></button>
              <a href="<?= base_url("/") ?>" class="btn btn-outline-secondary"><?= lang('bib.cancel') ?></a>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
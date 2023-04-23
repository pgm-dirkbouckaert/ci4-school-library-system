<?= $this->extend($config->viewLayout) ?>

<?= $this->section('main') ?>

<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col-sm-8 col-md-6 col-xl-4">

      <div class="card">
        <h3 class="card-header"><?= lang('Auth.loginTitle') ?></h3>
        <div class="card-body">

          <?= $this->include('Auth/partials/message_block') ?>

          <form action="<?= url_to('login') ?>" method="post">
            <?= csrf_field() ?>

            <?php if ($config->validFields === ['email']) : ?>
              <div class="mb-3">
                <label for="login" class="form-label"><?= lang('Auth.email') ?></label>
                <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>" autofocus>
                <div class="invalid-feedback">
                  <?= session('errors.login') ?>
                </div>
              </div>
            <?php else : ?>
              <div class="mb-3">
                <label for="login" class="form-label"><?= lang('Auth.emailOrUsername') ?></label>
                <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>" autofocus>
                <div class="invalid-feedback">
                  <?= session('errors.login') ?>
                </div>
              </div>
            <?php endif; ?>

            <div class="mb-3">
              <label for="password" class="form-label"><?= lang('Auth.password') ?></label>
              <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
              <div class="invalid-feedback">
                <?= session('errors.password') ?>
              </div>
            </div>

            <?php if ($config->allowRemembering) : ?>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                  <?= lang('Auth.rememberMe') ?>
                </label>
              </div>
            <?php endif; ?>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-dark btn-block"><?= lang('Auth.loginAction') ?></button>
            </div>

          </form>

          <div class="mt-3">
            <?php if ($config->allowRegistration) : ?>
              <div class="small mb-2"><a href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></div>
            <?php endif; ?>
            <?php if ($config->activeResetter) : ?>
              <div class="small mb-2"><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></div>
            <?php endif; ?>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
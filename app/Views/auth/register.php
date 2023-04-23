<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
  <div class="row row d-flex justify-content-center">
    <div class="col-sm-8 col-md-6 col-xl-4">

      <div class="card">
        <h3 class="card-header"><?= lang('Auth.register') ?></h3>
        <div class="card-body">

          <?= $this->include('Auth/partials/message_block') ?>

          <form action="<?= url_to('register') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
              <label for="email" class="form-label"><?= lang('Auth.email') ?></label>
              <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" autofocus>
              <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
            </div>

            <div class="mb-3">
              <label for="username" class="form-label"><?= lang('Auth.username') ?></label>
              <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label"><?= lang('Auth.password') ?></label>
              <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
            </div>

            <div class="mb-3">
              <label for="pass_confirm" class="form-label"><?= lang('Auth.repeatPassword') ?></label>
              <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-dark btn-block"><?= lang('Auth.register') ?></button>
            </div>
          </form>


          <div class="small mt-2"><?= lang('Auth.alreadyRegistered') ?> <a href=" <?= url_to('login') ?>"><?= lang('Auth.signIn') ?></a></div>
        </div>
      </div>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
<?= $this->extend('/layout/template'); ?>


<?= $this->section('content'); ?>

<?= $this->include("partials/flash") ?>

<div class="row">
  <div class="col">

    <div class="row">
      <div class="col-md-6">
        <h3><?= lang("bib.listOfLanguageCodes") ?></h3>
      </div>

      <div class="col-md-6">
        <form action="<?= base_url("/language-codes") ?>" method="post">
          <?= csrf_field() ?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="<?= lang("bib.addKeywords") ?>" name="keyword">
            <button class="btn btn-outline-secondary" class="btn btn-primary" type="submit" id="submit" name="submit"><?= lang("bib.search") ?></button>
          </div>
        </form>
      </div>
    </div>

    <!-- TABLE -->
    <table class="table table-sm table-hover">
      <thead>
        <tr>
          <th scope="col"><?= lang("bib.language") ?></th>
          <th scope="col"><?= lang("bib.639_1") ?></th>
          <th scope="col"><?= lang("bib.639_3") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 0;
        foreach ($codes as $code) {
        ?>
          <tr>
            <td><?= $code['language'] ?></td>
            <td><?= $code['code_639_1'] ?></td>
            <td><?= $code['code_639_3'] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <?= $pager->links('codes', 'my_pagination') ?>
  </div>
</div>

<?= $this->endSection(); ?>
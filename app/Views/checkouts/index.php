<?= $this->extend('/layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Flash -->
<?= $this->include("partials/flash") ?>

<!-- List -->
<div class="row">
  <div class="col">

    <div class="row">
      <div class="col-md-6">
        <h3><?= lang("bib.listOfCheckouts") ?></h3>
      </div>
      <div class="col-md-6">
        <form action="<?= base_url("/checkouts") ?>" method="post">
          <?= csrf_field() ?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="<?= lang("bib.addKeywords") ?>" name="keyword">
            <button class="btn btn-outline-secondary" class="btn btn-primary" type="submit" id="submit" name="submit"><?= lang("bib.search") ?></button>
          </div>
        </form>
      </div>
    </div>

    <table class="table table-sm table-hover">
      <thead>
        <tr>
          <th scope="col"><?= lang("bib.title") ?></th>
          <th scope="col"><?= lang("bib.member") ?></th>
          <th scope="col"><?= lang("bib.checkoutAt") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($checkouts as $c) : ?>
          <tr>
            <td><a href="<?= base_url("/books/detail/" . $c["book_id"]) ?>"><?= $c['book_title'] ?></a></td>
            <td><a href="<?= base_url("/members/detail/" . $c["member_id"]) ?>"><?= $c['member_name'] ?></a></td>
            <td><?= date_format(date_create($c['created_at']), "d/m/Y") ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?= $pager->links('checkouts', 'my_pagination') ?>
  </div>
</div>

<?= $this->endSection(); ?>
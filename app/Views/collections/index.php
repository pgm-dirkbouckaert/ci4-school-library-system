<?= $this->extend('/layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Flash -->
<?= $this->include("partials/flash") ?>

<!-- Modal Confirm Delete -->
<?= $this->include("collections/partials/confirm-delete-modal") ?>

<!-- List -->
<div class="row">
  <div class="col">

    <div class="row">
      <div class="col-md-6">
        <?php if (logged_in()) : ?>
          <a href="<?= base_url("/collections/add") ?>" class="btn btn-sm btn-outline-success mb-3"><?= lang("bib.addCollection") ?></a>
        <?php endif; ?>
        <h3><?= lang("bib.listOfCollections") ?></h3>
      </div>

      <div class="col-md-6">
        <form action="<?= base_url("/collections") ?>" method="post">
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
          <th scope="col"><?= lang("bib.id") ?></th>
          <th scope="col"><?= lang("bib.name") ?></th>
          <th scope="col"><?= lang("bib.location") ?></th>
          <td><i class="fa-solid fa-book-open-reader" title="<?= lang("bib.numberOfBooks") ?>"></i></td>
          <th scope="col"><?= lang("bib.actions") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($collections as $c) {
        ?>
          <tr>
            <td><?= $c['collection_id'] ?></td>
            <td><?= $c['name'] ?></td>
            <td><?= $c['location'] ?></td>
            <td><?= $c['number_of_books'] ?></td>
            <td>
              <a href="<?= base_url("/collections/detail/" . $c['collection_id']) ?>" title="<?= lang("bib.view") ?>"><i class="fa-regular fa-eye me-1"></i></a>
              <?php if (logged_in()) : ?>
                <a href="<?= base_url("/collections/add-books/" . $c['collection_id']) ?>" title="<?= lang("bib.addBooks") ?>"><i class="fa-solid fa-layer-group text-success me-1"></i></a>
                <a href="<?= base_url("/collections/edit/" . $c['collection_id']) ?>" title="<?= lang("bib.edit") ?>"><i class="fa-regular fa-pen-to-square text-warning me-1"></i></a>
                <i class="fa-regular fa-trash-can text-danger me-1 btn-delete" title="<?= lang("bib.delete") ?>" role="button" data-collection-id="<?= $c['collection_id'] ?>" data-collection-name="<?= $c['name'] ?>"></i>
              <?php endif; ?>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <?= $pager->links('collections', 'my_pagination') ?>
  </div>
</div>

<!-- Script -->
<?= $this->include("collections/partials/confirm-delete-script") ?>

<?= $this->endSection(); ?>
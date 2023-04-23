<?= $this->extend('/layout/template'); ?>


<?= $this->section('content'); ?>

<?= $this->include("partials/flash") ?>

<div class="row">
  <div class="col">

    <div class="row">
      <div class="col-md-6">
        <?php if (logged_in()) : ?>
          <a href="<?= base_url("/books/add") ?>" class="btn btn-sm btn-outline-success mb-3"><?= lang("bib.addBook") ?></a>
        <?php endif; ?>
        <h3><?= lang("bib.listOfBooks") ?></h3>
      </div>

      <div class="col-md-6">
        <form action="<?= base_url("/books") ?>" method="post">
          <?= csrf_field() ?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="<?= lang("bib.addKeywords") ?>" name="keyword">
            <select name="showAvailable" id="showAvailable" class="form-select form-select-sm max-width-75">
              <option value="all"><?= lang("bib.all") ?></option>
              <option value="available-only"><?= lang("bib.availableOnly") ?></option>
            </select>
            <button class="btn btn-outline-secondary" class="btn btn-primary" type="submit" id="submit" name="submit"><?= lang("bib.search") ?></button>
          </div>
        </form>
      </div>
    </div>

    <!-- TABLE -->
    <table class="table table-sm table-hover">
      <thead>
        <tr>
          <th scope="col"><?= lang("bib.id") ?></th>
          <th scope="col"><?= lang("bib.title") ?></th>
          <th scope="col"><?= lang("bib.author(s)") ?></th>
          <!-- <th scope="col"><?= lang("bib.ISBN") ?></th> -->
          <th scope="col"><i title="<?= lang("bib.difficulty_level") ?>" class="fa-solid fa-graduation-cap"></i></th>
          <th scope="col"><?= lang("bib.language") ?></th>
          <th scope="col"><?= lang("bib.available") ?></th>
          <th scope="col" class="actions"><?= lang("bib.actions") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 0;
        foreach ($books as $b) {
        ?>
          <tr class="<?= $showAvailableOnly && !$b["available"] ? "d-none" : "" ?>">
            <td><?= $b['book_id'] ?></td>
            <td><?= $b['title'] ?></td>
            <td><?= $b['authors'] ?></td>
            <!-- <td><?= $b['isbn'] ?></td> -->
            <td><?= $b['difficulty_level'] ?></td>
            <td><?= $b['language_code'] ?></td>
            <td><?= $b['available'] ? lang("bib.yes")  : lang("bib.no") ?></td>
            <td>
              <a href="<?= base_url("/books/detail/" . $b['book_id']) ?>" title="<?= lang("bib.view") ?>"><i class="fa-regular fa-eye me-1"></i></a>
              <?php if (logged_in()) : ?>
                <a href="<?= base_url("/books/add-to-collections/" . $b['book_id']) ?>" title="<?= lang("bib.addToCollections") ?>"><i class="fa-solid fa-layer-group text-success me-1"></i></a>
                <a href="<?= base_url("/books/edit/" . $b['book_id']) ?>" title="<?= lang("bib.edit") ?>"><i class="fa-regular fa-pen-to-square text-warning me-1"></i></a>
                <a href="<?= base_url("/books/delete/" . $b['book_id']) ?>" title="<?= lang("bib.delete") ?>"><i class="fa-regular fa-trash-can text-danger me-1"></i></a>
              <?php endif; ?>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <?= $pager->links('books', 'my_pagination') ?>
  </div>
</div>

<?= $this->endSection(); ?>
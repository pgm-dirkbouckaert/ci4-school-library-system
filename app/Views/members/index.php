<?= $this->extend('/layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Flash -->
<?= $this->include("partials/flash") ?>

<!-- Modal Confirm Delete -->
<?= $this->include("members/partials/confirm-delete-modal") ?>

<!-- List -->
<div class="row">
  <div class="col">

    <div class="row">
      <div class="col-md-6">
        <a href="<?= base_url("/members/add") ?>" class="btn btn-sm btn-outline-success mb-3"><?= lang("bib.addMember") ?></a>
        <h3><?= lang("bib.listOfMembers") ?></h3>
      </div>

      <div class="col-md-6">
        <form action="<?= base_url("/members") ?>" method="post">
          <div class="input-group mb-3">
            <?= csrf_field() ?>
            <input type="text" class="form-control" placeholder="<?= lang("bib.addKeywords") ?>" name="keyword">
            <select name="showStatus" id="showStatus" class="form-select form-select-sm max-width-75">
              <option value="all"><?= lang("bib.all") ?></option>
              <option value="active"><?= lang("bib.active") ?></option>
              <option value="suspended"><?= lang("bib.suspended") ?></option>
            </select>
            <button class="btn btn-outline-secondary" class="btn btn-primary" type="submit" id="submit" name="submit"><?= lang("bib.search") ?></button>
          </div>

        </form>
      </div>

    </div>

    <table class="table table-sm table-hover">
      <thead>
        <tr>
          <th scope="col"><?= lang("bib.id") ?></th>
          <th scope="col"><?= lang("bib.status") ?></th>
          <th scope="col"><?= lang("bib.name") ?></th>
          <th scope="col"><?= lang("bib.email") ?></th>
          <td><i class="fa-solid fa-book-open-reader" title="<?= lang("bib.currentCheckouts") ?>"></i></td>
          <th scope="col"><?= lang("bib.actions") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($members as $m) {
          $visibility = "";
          if ($showStatus && $showStatus === "active" && $m["status"] === "suspended") $visibility = "d-none";
          elseif ($showStatus && $showStatus === "suspended" && $m["status"] === "active") $visibility = "d-none";
        ?>
          <tr class="<?= $visibility ?>">
            <td><?= $m['member_id'] ?></td>
            <td><?= $m['status'] === "active" ? lang("bib.active") : lang("bib.suspended") ?></td>
            <td><?= $m['name'] ?></td>
            <td><?= $m['email'] ?></td>
            <td><?= $m['current_checkouts'] ?></td>
            <td>
              <a href="<?= base_url("/members/detail/" . $m['member_id']) ?>" title="<?= lang("bib.view") ?>"><i class="fa-regular fa-eye me-1"></i></a>
              <a href="<?= base_url("/members/manage-checkouts/" . $m['member_id']) ?>" title="<?= lang("bib.manageCheckouts") ?>"><i class="fa-solid fa-layer-group text-success me-1"></i></a>
              <a href="<?= base_url("/members/edit/" . $m['member_id']) ?>" title="<?= lang("bib.edit") ?>"><i class="fa-regular fa-pen-to-square text-warning me-1"></i></a>
              <i class="fa-regular fa-trash-can text-danger me-1 btn-delete" title="<?= lang("bib.delete") ?>" role="button" data-member-id="<?= $m['member_id'] ?>" data-member-name="<?= $m['name'] ?>"></i>
            </td>
          </tr>

        <?php
        }

        ?>
      </tbody>
    </table>
    <?= $pager->links('members', 'my_pagination') ?>
  </div>
</div>

<!-- Script -->
<?= $this->include("members/partials/confirm-delete-script") ?>

<?= $this->endSection(); ?>
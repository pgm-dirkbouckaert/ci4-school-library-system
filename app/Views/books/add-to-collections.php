<?= $this->extend('/layout/template') ?>

<?= $this->section('content') ?>

<div class="row mb-5">
  <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

    <h2 class="my-3"><?= lang("bib.addBookToCollections") ?></h2>

    <div class="my-3">
      <label for="title" class="form-label"><?= lang("bib.titleOfBook") ?></label>
      <input type="text" id="title" value="<?= $book["title"] ?>" class="form-control <?= ($validation->hasError('title')) ? "is-invalid" : "" ?>" name="title" disabled required>
      <div class="invalid-feedback">
        <?= $validation->getError('title') ?>
      </div>
    </div>

    <!-- Available collections -->
    <div class="my-3">
      <label for="collections-available" class="form-label"><?= lang("bib.collections") ?></label>
      <div id="collections-available" class="form-control min-h-150 max-h-200">
        <div class="text-muted small mb-1"><?= lang("bib.collectionsAvailable") ?></div>
        <?php foreach ($collections as $c) : ?>
          <?php if (!in_array($c["collection_id"], $currentCollectionIds)) : ?>
            <div class="lh-sm wrapper-available d-flex align-items-start" data-id="<?= $c["collection_id"] ?>" data-name="<?= $c["name"] ?>" data-location="<?= $c["location"] ?>">
              <input type="checkbox" class="mt-1 me-1" value="<?= $c["collection_id"] ?>">
              <label class="form-label m-0"><?= $c["name"] ?> <span class="small">(<?= $c["location"] ?>)</span></label>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Buttons to handle selection -->
    <div class="my-3">
      <button class="btn btn-sm btn-outline-success btn-selection-add" id="btn-selection-add"><?= lang("bib.add") ?></button>
      <button class="btn btn-sm btn-outline-danger btn-selection-delete float-end" id="btn-selection-delete"><?= lang("bib.delete") ?></button>
    </div>

    <!-- Selected collections (the book will be added to these collections -->
    <div class="my-3">
      <div id="collections-selected" class="form-control min-h-150 max-h-200">
        <div class="text-muted small mb-1"><?= lang("bib.collectionsToAddBookTo") ?></div>
        <?php foreach ($collections as $c) : ?>
          <?php if (in_array($c["collection_id"], $currentCollectionIds)) : ?>
            <div class="lh-sm wrapper-selection d-flex align-items-start" data-id="<?= $c["collection_id"] ?>" data-name="<?= $c["name"] ?>" data-location="<?= $c["location"] ?>">
              <input type="checkbox" class="mt-1 me-1" value="<?= $c["collection_id"] ?>">
              <label class="form-label m-0"><?= $c["name"] ?> <span class="small">(<?= $c["location"] ?>)</span></label>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Form -->
    <form action="<?= base_url("/books/add-to-collections/" . $book["book_id"]) ?>" method="POST" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <input type="hidden" id="collectionIds" name=" collectionIds" value="<?= $currentCollectionIds ? join(",", $currentCollectionIds) : "" ?>">
      <button type=" submit" class="btn btn-dark mt-2"><?= lang("bib.save") ?></button>
      <a href="<?= base_url("/books/detail/" . $book["book_id"]) ?>" class="btn btn-outline-secondary mt-2"><?= lang("bib.cancel") ?></a>
    </form>
  </div>

  <script>
    (() => {
      const app = {
        init() {
          this.cacheElements();
          this.listenForAddSelection();
          this.listenForDeleteSelection();
        },
        cacheElements() {
          this.$containerAvailable = document.getElementById("collections-available");
          this.$containerSelected = document.getElementById("collections-selected");
          this.$btnAddSelection = document.getElementById("btn-selection-add");
          this.$btnDeleteSelection = document.getElementById("btn-selection-delete");
          this.$inputCollectionIds = document.getElementById("collectionIds");
        },
        listenForAddSelection() {
          this.$btnAddSelection.addEventListener("click", (e) => {
            e.preventDefault();
            const $wrappers = document.querySelectorAll(".wrapper-available");
            for (const $wrapper of $wrappers) {
              const $input = $wrapper.firstElementChild;
              if ($input.checked) {
                const id = $wrapper.dataset.id;
                const name = $wrapper.dataset.name;
                const location = $wrapper.dataset.location;
                // Add collection id to form value
                const inputVal = this.$inputCollectionIds.value;
                if (inputVal === "") this.$inputCollectionIds.value = id
                else {
                  const ids = inputVal.split(",");
                  ids.push(id);
                  this.$inputCollectionIds.value = ids.join(",");
                }
                // Move element from 'available' to 'selection' 
                $wrapper.remove();
                this.$containerSelected.innerHTML += this.renderWrapperSelection(id, name, location);
                this.listenForDeleteSelection();
              }
            }
          });
        },
        listenForDeleteSelection() {
          this.$btnDeleteSelection.addEventListener("click", (e) => {
            e.preventDefault();
            const $wrappers = document.querySelectorAll(".wrapper-selection");
            for (const $wrapper of $wrappers) {
              const $input = $wrapper.firstElementChild;
              if ($input.checked) {
                const id = $wrapper.dataset.id;
                const name = $wrapper.dataset.name;
                const location = $wrapper.dataset.location;
                // Remove collection id from form value
                const newIds = this.$inputCollectionIds.value.split(",").filter(cid => cid !== id).join(",");
                this.$inputCollectionIds.value = newIds;
                // Move element from 'selection' to 'available' 
                $wrapper.remove();
                this.$containerAvailable.innerHTML += this.renderWrapperAvailable(id, name, location);
                this.listenForAddSelection();
              }
            }
          });
        },
        renderWrapperSelection(id, name, location) {
          return `
            <div class="lh-sm wrapper-selection d-flex align-items-start" data-id="${id}" data-name="${name}" data-location="${location}">
              <input type="checkbox" class="mt-1 me-1" value="${id}">
              <label class="form-label m-0">${name} <span class="small">(${location})</span></label>
            </div>`;
        },
        renderWrapperAvailable(id, name, location) {
          return `
            <div class="lh-sm wrapper-available d-flex align-items-start" data-id="${id}" data-name="${name}" data-location="${location}">
              <input type="checkbox" class="mt-1 me-1" value="${id}">
              <label class="form-label m-0">${name} <span class="small">(${location})</span></label>
            </div>`;
        }
      };
      app.init();
    })();
  </script>

  <?= $this->endSection() ?>
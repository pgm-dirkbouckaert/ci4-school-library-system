<?= $this->extend('/layout/template') ?>

<?= $this->section('content') ?>

<div class="row mb-5">
  <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

    <h2 class="my-3"><?= lang("bib.addBooksToCollection") ?></h2>

    <div class="my-3">
      <label for="name" class="form-label"><?= lang("bib.nameOfCollection") ?></label>
      <input type="text" id="name" value="<?= $collection["name"] ?>" class="form-control <?= ($validation->hasError('name')) ? "is-invalid" : "" ?>" name="name" disabled required>
      <div class="invalid-feedback">
        <?= $validation->getError('name') ?>
      </div>
    </div>

    <!-- Available books -->
    <div class="my-3">
      <label for="books-available" class="form-label"><?= lang("bib.books") ?></label>
      <div id="books-available" class="form-control min-h-150 max-h-200">
        <div class="text-muted small mb-1"><?= lang("bib.booksAvailable") ?></div>
        <?php foreach ($books as $b) : ?>
          <?php if (!in_array($b["book_id"], $currentBookIds)) : ?>
            <div class="lh-sm wrapper-available d-flex align-items-start" data-id="<?= $b["book_id"] ?>" data-title="<?= $b["title"] ?>" data-authors="<?= $b["authors"] ?>">
              <input type="checkbox" class="mt-1 me-1" value="<?= $b["book_id"] ?>">
              <label class="form-label m-0"><?= $b["title"] ?> <?= $b["authors"] !== "" ? "<span class='small'>(" . $b["authors"] . ")</span>" : "" ?></label>
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

    <!-- Selected books (these books will be added to the collection -->
    <div class="my-3">
      <div id="books-selected" class="form-control min-h-150 max-h-200">
        <div class="text-muted small mb-1"><?= lang("bib.booksToAddtoCollection") ?></div>
        <?php foreach ($books as $b) : ?>
          <?php if (in_array($b["book_id"], $currentBookIds)) : ?>
            <div class="lh-sm wrapper-selection d-flex align-items-start" data-id="<?= $b["book_id"] ?>" data-title="<?= $b["title"] ?>" data-authors="<?= $b["authors"] ?>">
              <input type="checkbox" class="mt-1 me-1" value="<?= $b["book_id"] ?>">
              <label class="form-label m-0"><?= $b["title"] ?> <?= $b["authors"] !== "" ? "<span class='small'>(" . $b["authors"] . ")</span>" : "" ?></label>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Form -->
    <form action="<?= base_url("/collections/add-books/" . $collection["collection_id"]) ?>" method="POST" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <input type="hidden" id="bookIds" name="bookIds" value="<?= $currentBookIds ? join(",", $currentBookIds) : "" ?>">
      <button type=" submit" class="btn btn-dark mt-2"><?= lang("bib.save") ?></button>
      <a href="<?= base_url("/collections/detail/" . $collection["collection_id"]) ?>" class="btn btn-outline-secondary mt-2"><?= lang("bib.cancel") ?></a>
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
          this.$containerAvailable = document.getElementById("books-available");
          this.$containerSelected = document.getElementById("books-selected");
          this.$btnAddSelection = document.getElementById("btn-selection-add");
          this.$btnDeleteSelection = document.getElementById("btn-selection-delete");
          this.$inputBookIds = document.getElementById("bookIds");
        },
        listenForAddSelection() {
          this.$btnAddSelection.addEventListener("click", (e) => {
            e.preventDefault();
            const $wrappers = document.querySelectorAll(".wrapper-available");
            for (const $wrapper of $wrappers) {
              const $input = $wrapper.firstElementChild;
              if ($input.checked) {
                const id = $wrapper.dataset.id;
                const title = $wrapper.dataset.title;
                const authors = $wrapper.dataset.authors;
                // Add collection id to form value
                const inputVal = this.$inputBookIds.value;
                if (inputVal === "") this.$inputBookIds.value = id
                else {
                  const ids = inputVal.split(",");
                  ids.push(id);
                  this.$inputBookIds.value = ids.join(",");
                }
                // Move element from 'available' to 'selection' 
                $wrapper.remove();
                this.$containerSelected.innerHTML += this.renderWrapperSelection(id, title, authors);
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
                const title = $wrapper.dataset.title;
                const authors = $wrapper.dataset.authors;
                // Remove collection id from form value
                const newIds = this.$inputBookIds.value.split(",").filter(cid => cid !== id).join(",");
                this.$inputBookIds.value = newIds;
                // Move element from 'selection' to 'available' 
                $wrapper.remove();
                this.$containerAvailable.innerHTML += this.renderWrapperAvailable(id, title, authors);
                this.listenForAddSelection();
              }
            }
          });
        },
        renderWrapperSelection(id, title, authors) {
          return `
            <div class="lh-sm wrapper-selection d-flex align-items-start" data-id="${id}" data-title="${title}" data-authors="${authors}">
              <input type="checkbox" class="mt-1 me-1" value="${id}">
              <label class="form-label m-0">${title} ${authors !== "" ? `<span class='small'>(${authors})</span>` : ""}</label>
            </div>`;
        },
        renderWrapperAvailable(id, title, authors) {
          return `
            <div class="lh-sm wrapper-available d-flex align-items-start" data-id="${id}" data-title="${title}" data-authors="${authors}">
              <input type="checkbox" class="mt-1 me-1" value="${id}">
              <label class="form-label m-0">${title} ${authors !== "" ? `<span class='small'>(${authors})</span>` : ""}</label>
            </div>`;
        }
      };
      app.init();
    })();
  </script>

  <?= $this->endSection() ?>
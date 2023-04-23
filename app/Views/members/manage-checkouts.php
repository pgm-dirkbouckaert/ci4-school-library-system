<?= $this->extend('/layout/template') ?>

<?= $this->section('content') ?>

<div class="row mb-5">
  <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

    <h2 class="my-3"><?= lang("bib.manageCheckouts") ?></h2>

    <h5 class="my-3"><u><?= lang("bib.member") ?></u>: <?= $member["name"] ?></h5>

    <!-- CURRENT CHECKOUTS -->
    <h5 class="my-3"><u><?= lang("bib.currentCheckouts") ?></u>: </h5>
    <ul id="currentCheckouts" class="list-group">
      <?php if (count($checkouts) === 0) : ?>
        &#x2205;
      <?php else : ?>
        <?php foreach ($checkouts as $c) : ?>
          <li id="book-<?= $c["book_id"] ?>" class="list-group-item list-group-item-action">
            <?= $c["book_title"] ?> <small>(ID: <?= $c["book_id"] ?>)</small>
            <i class="fa-solid fa-trash-can text-danger float-end mt-1 btn-delete" role="button" data-book-id="<?= $c["book_id"] ?>"></i>
          </li>
        <?php endforeach; ?>
      <?php endif; ?>
    </ul>

    <!-- NEW CHECKOUTS -->
    <h5 class="mt-3 mb-1"><u><?= lang("bib.newCheckouts") ?></u>: </h5>
    <div class="text-muted small mb-3">
      <?= lang("bib.addNewCheckoutInstructions") ?>
    </div>

    <input class="form-control mb-3" list="datalistOptions" id="inputNewCheckout" placeholder="<?= lang("bib.searchByTitle") ?>">
    <datalist id="datalistOptions">
      <?php foreach ($books as $b) : ?>
        <?php if ($b["available"]) : ?>
          <option value="<?= $b["title"] ?> - ID: <?= $b["book_id"] ?>" id="option-<?= $b["book_id"] ?>"></option>
        <?php endif; ?>
      <?php endforeach; ?>
    </datalist>
    <ul id="newCheckouts" class="list-group">
    </ul>

    <!-- FORM -->
    <form action="<?= base_url("/members/manage-checkouts/" . $member["member_id"]) ?>" method="POST" class="mt-5" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <input type="hidden" name="bookIds" id="bookIds" value="<?= $checkedOutBookIds ? join(",", $checkedOutBookIds) : "" ?>">
      <button type=" submit" class="btn btn-dark"><?= lang("bib.save") ?></button>
      <a href="<?= base_url("/members/detail/" . $member["member_id"]) ?>" class="btn btn-outline-secondary"><?= lang("bib.cancel") ?></a>
    </form>

  </div>
</div>

<script>
  (() => {
    const app = {
      init() {
        this.cacheElements();
        this.listenForDeleteCheckout();
        this.listenForNewCheckout();
      },
      cacheElements() {
        this.$inputNewCheckout = document.getElementById("inputNewCheckout");
        this.$newCheckoutsList = document.getElementById("newCheckouts");
        this.$inputBookIds = document.getElementById("bookIds");
      },
      listenForDeleteCheckout() {
        const buttons = document.querySelectorAll(".btn-delete");
        for (const btn of buttons) {
          btn.addEventListener("click", (e) => {
            const bookId = e.currentTarget.dataset.bookId;
            const $listItem = document.getElementById(`book-${bookId}`);
            // Delete book id from form value
            const newBookIds = this.$inputBookIds.value.split(",").filter(id => id !== bookId).join(",");
            this.$inputBookIds.value = newBookIds;
            // Remove item from list
            $listItem.remove();
          })
        }
      },
      listenForNewCheckout() {
        this.$inputNewCheckout.addEventListener("change", (e) => {
          const title = this.$inputNewCheckout.value;
          const bookId = title.split(":")[1].trim();
          // Add book id to form value
          const inputVal = this.$inputBookIds.value;
          if (inputVal === "") this.$inputBookIds.value = bookId
          else {
            const bookIds = inputVal.split(",");
            bookIds.push(bookId);
            this.$inputBookIds.value = bookIds.join(",");
          }
          // Add item to list
          this.$newCheckoutsList.innerHTML += `
            <li id="book-${bookId}" class="list-group-item list-group-item-action">
              ${title}
              <i id="btn-delete-${bookId}" class="fa-solid fa-trash-can text-danger float-end mt-1 btn-delete" role="button" data-book-id="${bookId}"></i>
            </li>`;
          // Add listener for new list item
          this.listenForDeleteCheckout();
          // Remove option from datalist
          document.getElementById(`option-${bookId}`).remove();
          // Make input empty
          this.$inputNewCheckout.value = "";
        })
      },
    };
    app.init();
  })();
</script>
<?= $this->endSection() ?>
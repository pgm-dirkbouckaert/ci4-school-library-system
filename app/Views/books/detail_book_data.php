  <div class="row mb-3">

    <!--  IMAGE -->
    <div class="col-md-3 mb-3 image-detail">
      <?php if ($book["img"] !== "") : ?>
        <img src="<?= base_url("public/images/books/" . $book['img']) ?>" alt="cover" class="img-fluid">
      <?php else : ?>
        <img src="<?= base_url("public/images/books/default_book.png") ?>" alt="cover" class="img-fluid">
      <?php endif; ?>
    </div>

    <!-- BOOK DATA -->
    <div class="col-md-9">
      <!-- TITLE -->
      <h3><?= $book['title'] ?></h3>
      <!--  AVAILABLE -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.available") ?></div>
        <div class="col-md-8"><?= $book['available'] ? lang("bib.yes")  : lang("bib.no") ?></div>
      </div>
      <!-- ID -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.id") ?></div>
        <div class="col-md-8"><?= $book['book_id'] ?></div>
      </div>
      <!-- AUTHORS -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.author(s)") ?></div>
        <div class="col-md-8"><?= $book['authors'] ?></div>
      </div>
      <!-- ISBN -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.ISBN") ?></div>
        <div class="col-md-8"><?= $book['isbn'] ?></div>
      </div>
      <!-- LANGUAGE CODE -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.language_code") ?></div>
        <div class="col-md-8"><?= $book['language_code'] ?></div>
      </div>
      <!-- DIFFICULTY LEVEL -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.difficulty_level") ?></div>
        <div class="col-md-8"><?= $book['difficulty_level'] ? $book['difficulty_level'] : "&#x2205;" ?></div>
      </div>
      <!-- PUBLICATION YEAR -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.publication_year") ?></div>
        <div class="col-md-8"><?= $book['publication_year'] ? $book['publication_year'] : "&#x2205;" ?></div>
      </div>
      <!-- PUBLISHER -->
      <div class="row border border-1 border-bottom-0 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.publisher") ?></div>
        <div class="col-md-8"><?= $book['publisher'] ? $book['publisher'] : "&#x2205;" ?></div>
      </div>
      <!-- COLLECTIONS -->
      <div class="row border border-1 p-1">
        <div class="col-md-4 fw-bold"><?= lang("bib.collections") ?></div>
        <div class="col-md-8">
          <?php
          if (count($collections) === 0) echo "&#x2205;";
          else { ?>
            <ul class="ps-3">
              <?php foreach ($collections as $c) : ?>
                <li><a href="<?= base_url("/collections/detail/" . $c["collection_id"]) ?>"><?= $c["name"] ?></a> <span class="small">(<?= $c["location"] ?>)</span></li>
              <?php endforeach; ?>
            </ul>
          <?php } ?>
        </div>
      </div>
    </div>

  </div>
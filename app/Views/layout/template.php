<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CVO BIB</title>

  <?= $this->include('/layout/links.php') ?>

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container-fluid">
      <div class="navbar-brand"><a href="<?= base_url("/") ?>"><img src="<?= base_url("public/images/favicon-trp.png") ?>" alt="logo"></a></div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarMain">
        <div class="navbar-nav">
          <a class="nav-link <?= $tab == 'home' ? 'active' : '' ?>" href="<?= base_url() ?>"><?= lang("bib.home") ?></a>
          <a class="nav-link <?= $tab == 'books' ? 'active' : '' ?>" href="<?= base_url("/books/index") ?>"><?= lang("bib.books") ?></a>
          <a class="nav-link <?= $tab == 'collections' ? 'active' : '' ?>" href="<?= base_url("/collections/index") ?>"><?= lang("bib.collections") ?></a>
          <?php if (logged_in()) : ?>
            <a class="nav-link <?= $tab == 'members' ? 'active' : '' ?>" href="<?= base_url("/members/index") ?>"><?= lang("bib.members") ?></a>
            <a class="nav-link <?= $tab == 'checkouts' ? 'active' : '' ?>" href="<?= base_url("/checkouts/index") ?>"><?= lang("bib.checkouts") ?></a>
            <a class="nav-link <?= $tab == 'codes' ? 'active' : '' ?>" href="<?= base_url("/language-codes") ?>"><?= lang("bib.languageCodes") ?></a>
            <a class="nav-link" href="<?= base_url("/logout") ?>"><?= lang("bib.logout") ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    <?= $this->renderSection('content'); ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
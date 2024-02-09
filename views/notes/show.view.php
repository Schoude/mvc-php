<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<?php require('views/partials/banner.php') ?>

<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <a href="/notes" class="text-blue-800 hover:underline">Go Back</a>
    <p class="mt-8"><?= htmlspecialchars($note['body']) ?></p>
  </div>
</main>

<?php require('views/partials/footer.php') ?>

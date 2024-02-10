<?php require(base_path('views/partials/head.php')) ?>
<?php require(base_path('views/partials/nav.php')) ?>
<?php require(base_path('views/partials/banner.php')) ?>

<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <a href="/notes" class="text-blue-800 hover:underline">Go Back</a>
    <p class="mt-8"><?= htmlspecialchars($note['body']) ?></p>

    <p class="mt-4">
      <a class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" href="/note/edit?id=<?= $note['id'] ?>">Edit Note</a>
    </p>
  </div>
</main>

<?php require(base_path('views/partials/footer.php')) ?>

<?php require(base_path('views/partials/head.php')) ?>
<?php require(base_path('views/partials/nav.php')) ?>
<?php require(base_path('views/partials/banner.php')) ?>

<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <a href="/notes" class="text-blue-800 hover:underline">Go Back</a>
    <p class="mt-8"><?= htmlspecialchars($note['body']) ?></p>

    <form method="POST" class="mt-4">
      <input type="hidden" name="id" value="<?= $note['id'] ?>">
      <button class="text-sm text-red-300 bg-gray-700 rounded-md px-3 py-2">Delete</button>
    </form>
  </div>
</main>

<?php require(base_path('views/partials/footer.php')) ?>

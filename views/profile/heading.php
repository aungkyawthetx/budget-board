<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold text-gray-800">
    <?php if ($editMode): ?>
      Edit profile details
    <?php else: ?>
      Your Account
    <?php endif; ?>
  </h2>
  <?php if(!$editMode): ?>
    <a href="<?=  url('public/index.php') ?>" class="hover:underline">
      Go Back
    </a>
  <?php endif ?>
</div>
<?php
  include __DIR__ . '/../src/helpers/url.php';
  require_once __DIR__ . '/../src/helpers/isLoggedIn.php';
  require_once __DIR__ . '/../src/bootstrap.php';
  $title = "Account";

  // get login user
  $user_id = $_SESSION['user_id'] ?? null;
  $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
  $stmt->execute([':user_id' => $user_id]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  $editMode = isset($_GET['edit']);

  ob_start();
?>

<div class="flex-1">
  <?php include __DIR__ . '/../views/profile/heading.php'; ?>
  <div class="max-w-6xl mx-auto space-y-6">
    <?php 
      include __DIR__ . '/../views/profile/profile-card.php';
      include __DIR__ . '/../views/profile/account-settings.php';
      include __DIR__ . '/../views/profile/statistics.php';
    ?>
  </div>
</div>

<?php
  $content = ob_get_clean();
  include __DIR__ . '/../views/components/layout.php';
?>
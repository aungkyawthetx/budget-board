<?php

  include __DIR__ . '/../src/helpers/url.php';
  require_once __DIR__ . '/../src/helpers/isLoggedIn.php';
  require_once __DIR__ . '/../src/bootstrap.php';
  $title = "Categories - BudgetBoard";

  $sql = $pdo->prepare("SELECT * FROM categories");
  $sql->execute();
  $categories = $sql->fetchAll(PDO::FETCH_ASSOC);

  // expense counts per category
  $stmt = $pdo->prepare("SELECT category_id, COUNT(*) AS total FROM expenses WHERE user_id = :user_id GROUP BY category_id");
  $stmt->execute([':user_id' => $_SESSION['user_id']]);
  $expenseCounts = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

  ob_start();
  include __DIR__ . '/../views/categories/header.php';
  include __DIR__ . '/../views/categories/table.php';
  // include __DIR__ . '/../views/components/pagination.php';
  include __DIR__ . '/../views/components/modals/add-category-modal.php';
  include __DIR__ . '/../views/components/modals/delete-category-modal.php';
  $content = ob_get_clean();
  include __DIR__ . '/../views/components/layout.php';

?>
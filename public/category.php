<?php
  include __DIR__ . '/../src/helpers/url.php';
  require __DIR__ . '/../src/helpers/flash.php';
  require_once __DIR__ . '/../src/helpers/isLoggedIn.php';
  require_once __DIR__ . '/../src/bootstrap.php';
  $title = "Categories - MySpend";

  $sql = "SELECT
    c.id,
    c.name,
    COALESCE(ucb.monthly_budget, 0) AS monthly_budget
    FROM categories c
    LEFT JOIN user_category_budgets ucb
    ON ucb.category_id = c.id
    AND ucb.user_id = :user_id
    ORDER BY c.name;
  ";
  $params = [];
  $search = $_GET['search'] ?? '';
  if(!empty($search)) {
    $sql .= " WHERE name LIKE :search OR description LIKE :search";
    $params[':search'] = '%' . $search . '%';
  }
  $params[':user_id'] = $_SESSION['user_id'];

  $cat_stmt = $pdo->prepare($sql);
  $cat_stmt->execute($params);
  $categories = $cat_stmt->fetchAll(PDO::FETCH_ASSOC);

  // expense counts per category
  $stmt = $pdo->prepare("SELECT category_id, COUNT(*) AS total FROM expenses WHERE user_id = :user_id GROUP BY category_id");
  $stmt->execute([':user_id' => $_SESSION['user_id']]);
  $expenseCounts = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

  // update monthly budget
  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveCategory'])) {
    $categoryId = $_POST['edit_category_id'] ?? '';
    $monthlyBudget = $_POST['monthlyBudget'] ?? '';

    if ($monthlyBudget === '') {
      $monthlyBudget = 0;
    }

    if(!empty($categoryId) && is_numeric($categoryId)) {
      $updateStmt = $pdo->prepare("INSERT INTO user_category_budgets (user_id, category_id, monthly_budget)
        VALUES (:user_id, :category_id, :monthly_budget)
        ON DUPLICATE KEY UPDATE monthly_budget = VALUES(monthly_budget)");
      $updateStmt->execute([
        ':user_id' => $_SESSION['user_id'],
        ':category_id' => $categoryId,
        ':monthly_budget' => $monthlyBudget,
      ]);
      setFlash('success', 'Category has been updated!');
      header("Location: /public/category.php");
      exit();
    } else {
      setFlash('error', 'Something went wrong!');
    }
  }

  ob_start();
  include __DIR__ . '/../views/categories/category-view.php';
  $content = ob_get_clean();
  include __DIR__ . '/../views/components/layout.php';

 $flash = getFlash();
 if($flash):
?>
  <script>
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "<?= $flash['type'] ?>",
      title: <?= json_encode($flash['message']) ?>,
      showConfirmButton: false,
      timer: 1500,
      width: "500px",
      timerProgressBar: true
    });
  </script>
<?php endif; ?>
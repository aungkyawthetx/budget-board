<?php
  include __DIR__ . '/../src/helpers/url.php';
  require_once __DIR__ . '/../src/helpers/isLoggedIn.php';
  $title = "Reports - MySpend";

  ob_start();
  include __DIR__ . '/../views/reports/header.php';
  include __DIR__ . '/../views/reports/filter.php';
  include __DIR__ . '/../views/reports/summary-cards.php';

?>
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <?php include __DIR__ . '/../views/reports/charts.php'; ?>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <?php include __DIR__ . '/../views/reports/secondary-report.php'; ?>
    <?php include __DIR__ . '/../views/reports/recent-expenses.php'; ?>
  </div>

<?php
  $content = ob_get_clean();
  include __DIR__ . '/../views/components/layout.php';
?>

<script>
  const trendCtx = document.getElementById('expenseTrendChart').getContext('2d');
  const expenseTrendChart = new Chart(trendCtx, {
    type: 'line',
    data: {
      labels: ['Jun 1', 'Jun 5', 'Jun 10', 'Jun 15', 'Jun 20', 'Jun 25', 'Jun 30'],
      datasets: [{
        label: 'Daily Expenses',
        data: [85, 120, 95, 245, 180, 150, 90],
        backgroundColor: 'rgba(99, 102, 241, 0.1)',
        borderColor: '#6366F1',
        borderWidth: 2,
        tension: 0.3,
        fill: true
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          mode: 'index',
          intersect: false
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          grid: {
            drawBorder: false
          }
        },
        x: {
          grid: {
            display: false
          }
        }
      }
    }
  });

  // Category Distribution Chart
  const categoryCtx = document.getElementById('categoryDistributionChart').getContext('2d');
  const categoryDistributionChart = new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
      labels: ['Food & Dining', 'Shopping', 'Transportation', 'Utilities', 'Entertainment', 'Others'],
      datasets: [{
        data: [1245, 845, 520, 320, 215, 100],
        backgroundColor: [
          '#EF4444',
          '#10B981',
          '#3B82F6',
          '#F59E0B',
          '#8B5CF6',
          '#64748B'
        ],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'right',
          labels: {
            boxWidth: 12,
            padding: 20
          }
        }
      },
      cutout: '70%'
    }
  });
</script>
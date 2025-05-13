<?php
$page_title = "Reports";

// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include header file
include __DIR__ . '/../../includes/header.php'; 

// Define ROLE_ADMIN constant if not defined
if (!defined('ROLE_ADMIN')) {
    define('ROLE_ADMIN', 'admin');
}

// Check if user is admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != ROLE_ADMIN) {
    header("Location: /dashboard.php");
    exit;
}
?>

<div class="row">
    <div class="col-md-3">
        <?php include __DIR__ . '/sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Reports</h4>
            </div>
            <div class="card-body">
                <p>Here you can view and generate reports.</p>
                <!-- Add report generation or display logic here -->
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>

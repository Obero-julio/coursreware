<?php 
$page_title = "Admin Dashboard";

// Start the session
session_start();

// Define ROLE_ADMIN if not already defined
if (!defined('ROLE_ADMIN')) {
    define('ROLE_ADMIN', 'admin');
}

// Include the header file
include __DIR__ . '/../../includes/header.php';

// Check if user is admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != ROLE_ADMIN) {
    header("Location: /courseware/dashboard.php");
    exit;
}
?>

<div class="row">
    <div class="col-md-3">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="/assets/images/avatar.png" alt="Profile" class="rounded-circle mb-3" width="100">
                <h5><?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?></h5>
                <p class="text-muted">Administrator</p>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <h6>Admin Menu</h6>
            </div>
            <div class="card-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-9">
        <!-- ...existing code... -->
    </div>
</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
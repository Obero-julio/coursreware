<?php 
$page_title = "Course Materials";

// Start the session
session_start();

// Define ROLE_FACULTY if not already defined
if (!defined('ROLE_FACULTY')) {
    define('ROLE_FACULTY', 'faculty');
}

// Include the header file
include __DIR__ . '/../../includes/header.php';

// Check if user is faculty
if ($_SESSION['user_role'] != ROLE_FACULTY) {
    header("Location: ../dashboard.php"); // Updated relative path to dashboard.php
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
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Course Materials Management</h4>
                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
                        <i class="fas fa-plus me-1"></i> Upload Material
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h5>My Courses</h5>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">BSBA-101: Principles of Management</h6>
                                <small>3 materials</small>
                            </div>
                            <p class="mb-1">Mon/Wed 9:00-10:30</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">BSBA-102: Business Ethics</h6>
                                <small>2 materials</small>
                            </div>
                            <p class="mb-1">Tue/Thu 10:30-12:00</p>
                        </a>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Course</th>
                                <th>Type</th>
                                <th>Upload Date</th>
                                <th>Downloads</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Introduction to Management</td>
                                <td>BSBA-101</td>
                                <td>PDF</td>
                                <td>Oct 1, 2023</td>
                                <td>45</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Management Theories</td>
                                <td>BSBA-101</td>
                                <td>PPT</td>
                                <td>Oct 8, 2023</td>
                                <td>32</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Case Study Guidelines</td>
                                <td>BSBA-102</td>
                                <td>PDF</td>
                                <td>Oct 5, 2023</td>
                                <td>28</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="uploadModalLabel">Upload New Material</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm">
                    <div class="mb-3">
                        <label for="courseSelect" class="form-label">Course</label>
                        <select class="form-select" id="courseSelect" required>
                            <option value="">Select course</option>
                            <option value="1">BSBA-101: Principles of Management</option>
                            <option value="2">BSBA-102: Business Ethics</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="materialTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="materialTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="materialDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="materialDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="materialFile" class="form-label">File</label>
                        <input class="form-control" type="file" id="materialFile" required>
                    </div>
                    <div class="mb-3">
                        <label for="materialVersion" class="form-label">Version (optional)</label>
                        <input type="text" class="form-control" id="materialVersion">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="uploadForm" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Material uploaded successfully!');
    $('#uploadModal').modal('hide');
    this.reset();
});
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
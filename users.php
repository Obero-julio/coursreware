<?php 
$page_title = "User Management";

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
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">User Management</h4>
                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fas fa-plus me-1"></i> Add User
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs mb-4" id="userTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="students-tab" data-bs-toggle="tab" data-bs-target="#students" type="button">Students</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="faculty-tab" data-bs-toggle="tab" data-bs-target="#faculty" type="button">Faculty</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admins-tab" data-bs-toggle="tab" data-bs-target="#admins" type="button">Admins</button>
                    </li>
                </ul>
                
                <div class="tab-content" id="userTabsContent">
                    <div class="tab-pane fade show active" id="students" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Program</th>
                                        <th>Year Level</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>STU-001</td>
                                        <td>Maria Santos</td>
                                        <td>BSBA</td>
                                        <td>3</td>
                                        <td>maria@courseware.edu</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger">Deactivate</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>STU-002</td>
                                        <td>Juan Dela Cruz</td>
                                        <td>BSBA</td>
                                        <td>2</td>
                                        <td>juan@courseware.edu</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger">Deactivate</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>STU-003</td>
                                        <td>Pedro Penduko</td>
                                        <td>BPA</td>
                                        <td>1</td>
                                        <td>pedro@courseware.edu</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger">Deactivate</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="faculty" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Faculty ID</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Position</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>FAC-001</td>
                                        <td>Jeffrey De Asis</td>
                                        <td>BPA</td>
                                        <td>Department Chair</td>
                                        <td>jeffrey@courseware.edu</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger">Deactivate</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FAC-002</td>
                                        <td>Timothy Ventayen</td>
                                        <td>BSBA</td>
                                        <td>Department Chair</td>
                                        <td>timothy@courseware.edu</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger">Deactivate</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FAC-003</td>
                                        <td>Kurt Lucas</td>
                                        <td>BSBA</td>
                                        <td>Professor</td>
                                        <td>kurt@courseware.edu</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger">Deactivate</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="admins" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Last Login</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Admin User</td>
                                        <td>admin@courseware.edu</td>
                                        <td>Today, 09:45 AM</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger">Deactivate</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="addFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="addFirstName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="addLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="addLastName" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="addEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="addEmail" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="addRole" class="form-label">Role</label>
                        <select class="form-select" id="addRole" required>
                            <option value="">Select role</option>
                            <option value="student">Student</option>
                            <option value="faculty">Faculty</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    
                    <div id="studentFields" class="d-none">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="addStudentId" class="form-label">Student ID</label>
                                <input type="text" class="form-control" id="addStudentId">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="addProgram" class="form-label">Program</label>
                                <select class="form-select" id="addProgram">
                                    <option value="">Select program</option>
                                    <option value="BSBA">BSBA</option>
                                    <option value="BPA">BPA</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="addYearLevel" class="form-label">Year Level</label>
                            <select class="form-select" id="addYearLevel">
                                <option value="">Select year level</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                    </div>
                    
                    <div id="facultyFields" class="d-none">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="addFacultyId" class="form-label">Faculty ID</label>
                                <input type="text" class="form-control" id="addFacultyId">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="addDepartment" class="form-label">Department</label>
                                <select class="form-select" id="addDepartment">
                                    <option value="">Select department</option>
                                    <option value="BSBA">BSBA</option>
                                    <option value="BPA">BPA</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="addPosition" class="form-label">Position</label>
                            <input type="text" class="form-control" id="addPosition">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="addPassword" class="form-label">Temporary Password</label>
                        <input type="password" class="form-control" id="addPassword" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="addConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="addConfirmPassword" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="addUserForm" class="btn btn-primary">Add User</button>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('addRole').addEventListener('change', function() {
    const role = this.value;
    document.getElementById('studentFields').classList.add('d-none');
    document.getElementById('facultyFields').classList.add('d-none');
    
    if(role === 'student') {
        document.getElementById('studentFields').classList.remove('d-none');
    } else if(role === 'faculty') {
        document.getElementById('facultyFields').classList.remove('d-none');
    }
});

document.getElementById('addUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('User added successfully!');
    $('#addUserModal').modal('hide');
    this.reset();
});
</script>

<?php include '../../includes/footer.php'; ?>
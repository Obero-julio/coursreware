<?php 
$page_title = "My Courses";
include '../../includes/header.php'; 

// Check if user is a student
if($_SESSION['user_role'] != ROLE_STUDENT) {
    header("Location: /dashboard.php");
    exit;
}
?>

<div class="row">
    <div class="col-md-3">
        <?php include '../student/sidebar.php'; ?>
    </div>
    
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">My Courses</h4>
                    <span class="badge bg-light text-dark"><?php echo htmlspecialchars($_SESSION['program']); ?> Program</span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Instructor</th>
                                <th>Schedule</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>BSBA-101</td>
                                <td>Principles of Management</td>
                                <td>Prof. Ventayen</td>
                                <td>Mon/Wed 9:00-10:30</td>
                                <td>
                                    <a href="course.php?id=1" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>BSBA-102</td>
                                <td>Business Ethics</td>
                                <td>Prof. De Asis</td>
                                <td>Tue/Thu 10:30-12:00</td>
                                <td>
                                    <a href="course.php?id=2" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    <h5>Available Courses for Enrollment</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Schedule</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>BSBA-201</td>
                                    <td>Financial Accounting</td>
                                    <td>Fri 1:00-4:00</td>
                                    <td>
                                        <button class="btn btn-sm btn-success">Enroll</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>BSBA-202</td>
                                    <td>Marketing Principles</td>
                                    <td>Tue/Thu 1:00-2:30</td>
                                    <td>
                                        <button class="btn btn-sm btn-success">Enroll</button>
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

<?php include '../../includes/footer.php'; ?>
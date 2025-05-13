<?php include 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Register</h4>
            </div>
            <div class="card-body">
                <form action="includes/auth.php" method="POST">
                    <input type="hidden" name="action" value="register">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="role" class="form-label">I am a:</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="">Select role</option>
                            <option value="<?php echo ROLE_STUDENT; ?>">Student</option>
                            <option value="<?php echo ROLE_FACULTY; ?>">Faculty</option>
                        </select>
                    </div>
                    
                    <div id="studentFields" class="d-none">
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="student_id" name="student_id">
                        </div>
                        <div class="mb-3">
                            <label for="program" class="form-label">Program</label>
                            <select class="form-select" id="program" name="program">
                                <option value="">Select program</option>
                                <option value="BSBA">BSBA</option>
                                <option value="BPA">BPA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="year_level" class="form-label">Year Level</label>
                            <select class="form-select" id="year_level" name="year_level">
                                <option value="">Select year level</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                    </div>
                    
                    <div id="facultyFields" class="d-none">
                        <div class="mb-3">
                            <label for="faculty_id" class="form-label">Faculty ID</label>
                            <input type="text" class="form-control" id="faculty_id" name="faculty_id">
                        </div>
                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <select class="form-select" id="department" name="department">
                                <option value="">Select department</option>
                                <option value="BSBA">BSBA</option>
                                <option value="BPA">BPA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position">
                        </div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">I agree to the <a href="#">terms and conditions</a></label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
            <div class="card-footer text-center">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('role').addEventListener('change', function() {
    const role = this.value;
    document.getElementById('studentFields').classList.add('d-none');
    document.getElementById('facultyFields').classList.add('d-none');
    
    if(role === '<?php echo ROLE_STUDENT; ?>') {
        document.getElementById('studentFields').classList.remove('d-none');
    } else if(role === '<?php echo ROLE_FACULTY; ?>') {
        document.getElementById('facultyFields').classList.remove('d-none');
    }
});
</script>

<?php include 'includes/footer.php'; ?>
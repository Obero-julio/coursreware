<?php
// auth.php - Authentication functions

require_once __DIR__ . '/config.php'; // Updated path to config.php

// Handle login
if(isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Validate inputs
    if(empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Email and password are required']);
        exit;
    }
    
    try {
        // Check if user exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['user_role'] = $user['role'];
            
            // Get additional user info based on role
            if($user['role'] == 'student') {
                $stmt = $pdo->prepare("SELECT * FROM students WHERE user_id = ?");
                $stmt->execute([$user['user_id']]);
                $student = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $_SESSION['student_id'] = $student['student_id'];
                $_SESSION['student_number'] = $student['student_number'];
                $_SESSION['program'] = $student['program'];
                $_SESSION['year_level'] = $student['year_level'];
            } elseif($user['role'] == 'faculty') {
                $stmt = $pdo->prepare("SELECT * FROM faculty WHERE user_id = ?");
                $stmt->execute([$user['user_id']]);
                $faculty = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $_SESSION['faculty_id'] = $faculty['faculty_id'];
                $_SESSION['faculty_number'] = $faculty['faculty_number'];
                $_SESSION['department'] = $faculty['department'];
                $_SESSION['position'] = $faculty['position'];
            }
            
            // Redirect based on role
            if ($user['role'] == 'admin') {
                echo json_encode(['status' => 'success', 'redirect' => '/courseware/admin/dashboard.php']);
            } elseif ($user['role'] == 'faculty') {
                echo json_encode(['status' => 'success', 'redirect' => '/courseware/faculty/index.php']);
            } elseif ($user['role'] == 'student') {
                echo json_encode(['status' => 'success', 'redirect' => '/courseware/student/index.php']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid role']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
        }
    } catch(PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
    exit;
}

// Handle registration
if(isset($_POST['action']) && $_POST['action'] == 'register') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $role = $_POST['role'];
    $terms = isset($_POST['terms']) ? true : false;
    
    // Validate inputs
    $errors = [];
    
    if(empty($first_name)) $errors[] = 'First name is required';
    if(empty($last_name)) $errors[] = 'Last name is required';
    if(empty($email)) $errors[] = 'Email is required';
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email format';
    if(empty($password)) $errors[] = 'Password is required';
    if(strlen($password) < 8) $errors[] = 'Password must be at least 8 characters';
    if($password != $confirm_password) $errors[] = 'Passwords do not match';
    if(empty($role)) $errors[] = 'Role is required';
    if(!$terms) $errors[] = 'You must agree to the terms and conditions';
    
    // Role-specific validation
    if($role == ROLE_STUDENT) {
        $student_id = trim($_POST['student_id']);
        $program = $_POST['program'];
        $year_level = $_POST['year_level'];
        
        if(empty($student_id)) $errors[] = 'Student ID is required';
        if(empty($program)) $errors[] = 'Program is required';
        if(empty($year_level)) $errors[] = 'Year level is required';
    } elseif($role == ROLE_FACULTY) {
        $faculty_id = trim($_POST['faculty_id']);
        $department = $_POST['department'];
        $position = trim($_POST['position']);
        
        if(empty($faculty_id)) $errors[] = 'Faculty ID is required';
        if(empty($department)) $errors[] = 'Department is required';
        if(empty($position)) $errors[] = 'Position is required';
    }
    
    if(!empty($errors)) {
        echo json_encode(['status' => 'error', 'messages' => $errors]);
        exit;
    }
    
    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if($stmt->rowCount() > 0) {
            echo json_encode(['status' => 'error', 'messages' => ['Email already registered']]);
            exit;
        }
        
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $email, $hashed_password, $role]);
        $user_id = $pdo->lastInsertId();
        
        // Insert role-specific data
        if($role == ROLE_STUDENT) {
            $stmt = $pdo->prepare("INSERT INTO students (user_id, student_number, program, year_level) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $student_id, $program, $year_level]);
        } elseif($role == ROLE_FACULTY) {
            $stmt = $pdo->prepare("INSERT INTO faculty (user_id, faculty_number, department, position) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $faculty_id, $department, $position]);
        }
        
        // Set session variables
        $_SESSION['user_id'] = $user_id;
        $_SESSION['email'] = $email;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['user_role'] = $role;
        
        if($role == ROLE_STUDENT) {
            $_SESSION['student_id'] = $pdo->lastInsertId();
            $_SESSION['student_number'] = $student_id;
            $_SESSION['program'] = $program;
            $_SESSION['year_level'] = $year_level;
        } elseif($role == ROLE_FACULTY) {
            $_SESSION['faculty_id'] = $pdo->lastInsertId();
            $_SESSION['faculty_number'] = $faculty_id;
            $_SESSION['department'] = $department;
            $_SESSION['position'] = $position;
        }
        
        echo json_encode(['status' => 'success', 'role' => $role]);
    } catch(PDOException $e) {
        echo json_encode(['status' => 'error', 'messages' => ['Database error: ' . $e->getMessage()]]);
    }
    exit;
}

// Handle logout
if(isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit;
}
?>
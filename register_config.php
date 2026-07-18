<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful</title>
    <link rel="icon" href="images/header/logo2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    
    <?php 
    
    $action = false;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        require 'db_config.php';
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
        $user_exists = $conn->query("SELECT * FROM virexatrust_users WHERE email='$user_email' OR username='$user_name' LIMIT 1");
        if ($user_exists->num_rows > 0) {
                echo '<div class="alert alert-warning" role="alert">
                <h4> User already exists! <span><i class="bi bi-exclamation-triangle-fill"></i></span>  <span class="m-5"><a href="login_page.html" class="btn btn-outline-success btn-lg">Go to Login Page</a></span></h4>
                </div>';
        }else {
        $insert = $conn->query("INSERT INTO virexatrust_users (username, email, passwords) VALUES ('$user_name', '$user_email', '$user_password')");
        if (!$insert) {
            //die("Error inserting data: " . $conn->error);
            $action = false;
        }else {
            $action = true;
        } 
        }

    if ($action == true) { 
        $bouns = "500";
        $message = "Registration Welcome bonus of $".$bouns." has been credited to your account.";
        $level = "Level 1 Acheived";
        $badge = "Badge Unlocked";
        $status = 'successfully';
        // deposoit welcome bonus of $500 to user account; 
         $deposit = $conn->query("INSERT INTO user_deposit (userid, bonus, deposit_photo, deposit_status) VALUES ('$user_email', '$bouns', 'Admin_approved', '$status')");
        // send notification to user about welcome bonus;
        $notifi = $conn->query("INSERT INTO user_notification (userid, message, level, badge) VALUES ('$user_email','$message', '$level', '$badge')");
        $message2 = "New user registration alert: $user_email has registered.";
         $notifi2 = $conn->query("INSERT INTO admin_data (userid, notifi) VALUES ('$user_email','$message2')");
        // redirect user to success page;
        echo '<script> window.location.href ="./success/reg-success.html"</script>';
        }else{
            //die("Error inserting data: " . $conn->error);
        }
    } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
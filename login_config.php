<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virexatrust</title>
    <link rel="icon" href="images/header/logo2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <?php
session_start();
if(isset($_POST['login_button'])) {
    $user_email = $_POST['user_email'];
    $user_passwords = $_POST['user_passwords'];
    require_once 'db_config.php';
    $login_query = $conn->query("SELECT * FROM virexatrust_users WHERE email='$user_email' AND passwords='$user_passwords' LIMIT 1");
    if ($login_query->num_rows > 0) {
        $user_data = $login_query->fetch_assoc();
        if ( $user_data['email'] === $user_email  && $user_data['passwords'] === $user_passwords) {
            //echo "Login successful!";
            $_SESSION['user_name'] = $user_data['username'];
            $_SESSION['user_email'] = $user_data['email'];
            $_SESSION['user_password'] = $user_data['passwords'];
            sleep(1);
            // You can redirect the user to a dashboard or home page here
            header("Location:dashbord_index.php");
        }
    } else {
            //echo "Incorrect email or password!";
            echo "<div class='alert alert-danger d-flex' role='alert' style='justify-content: space-between; gap: 5px;'>
                    <h4> 
                    <span> Incorrect email or password!</span> <a href='login_page.html' class='btn btn-outline-success  m-3'> Reset Account </a>  <a href='register_page.html' class='btn btn-outline-primary  m-3'> Create Account </a>
                    </h4>
                    <div style='justify-content:center 5px; display: flex; align-items: center;'>
                    <a href='login_page.html' class='text-danger'><i class='bi bi-x-circle-fill'  style='font-size:30px;'></i></a>
                    </div>
                </div>";
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

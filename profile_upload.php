<?php session_start();
$user_id = $_SESSION['user_email'];
require 'db_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile Picture</title>
    <link rel="icon" href="images/header/logo2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark">
    <div class="container mt-5 p-5 text-light rounded" style="background-color:#0f0f0f;"> 
        <h2 class="text-warning">Upload Profile Picture</h2>
        <form class="form-control p-3 bg-dark text-light border-0" action=" profile_upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="profile" class="form-label">Select Profile Image</label>
                <input type="file" class="p-4 form-control" style="width: 400px;" id="profile" name="profile" accept="image/*" required>
            </div>
            <button type="submit" class="mt-3 p-2 btn btn-warning btn-lg">Upload</button>
        </form>
    </div>
    <?php
    if(isset($_FILES['profile'])){
        $profile_img = $_FILES['profile']['name'];
        $target_dir = "profile_img/";
        $target_file = $target_dir . basename($profile_img);

        // Move the uploaded file to the target directory
        if(move_uploaded_file($_FILES['profile']['tmp_name'], $target_file)){
            // Update the database with the new profile image path
            $update_query = "UPDATE user_profile SET profile_img='$profile_img' WHERE userid='$user_id'";
            if($conn->query($update_query) === TRUE){
                // send notification to user about welcome update;
                    $sms = "Profile picture update successfully";
                    $level = "Level 1 Acheived";
                    $badge = "Badge Unlocked";
                    // send notification to user about welcome update;
                    $notifi = $conn->query("INSERT INTO user_notification (
                    userid,
                    message,
                    level,
                    badge
                    )VALUES (
                    '$user_id',
                    '$sms',
                    '$level',
                    '$badge'
                    )");
                // redirect user to success page;
                echo "<script>window.location.href='upload-success.html';</script>";
            } else {
                echo "<script>alert('Error updating profile picture in database.');</script>";
            }
        } else {
            echo "<script>alert('Error uploading profile picture.');</script>";
        }
    }
    
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
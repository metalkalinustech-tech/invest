<?php
//start session
session_start();
$user_email = $_SESSION['user_email'];
require 'db_config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = $_POST['user_address'];
    $city = $_POST['user_city'];
    $code = $_POST['country_code'];
    $contact = $_POST['user_contact'];
    $country = $_POST['user_country'];
    $dob = $_POST['user_dob'];
    // id uploading 
if (isset($_POST['verify_info'])) {
    
        $dir = "id_card/";
        $id_file = basename($_FILES["image"]["name"]);
        $targetFilePath = $dir . $id_file;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // 1. Basic validation (check if it's an actual image)
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {

        // 2. Allow only certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {

            // 3. Move the file to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                
            //UPDATE PROFILE
                $insert = $conn->query("INSERT INTO user_profile (
                userid,
                user_address,
                user_city,
                contact_code,
                user_contact,
                user_country,
                user_dob,
                user_idcard
                ) values ( 
                '$user_email',
                '$address',
                '$city',
                '$code',
                '$contact',
                '$country',
                '$dob',
                '$id_file')"
                );

                //update notification
                if($insert){
                    $sms = "Profile updated, account verified successfully";
                    $level = "Level 1 Acheived";
                    $badge = "Badge Unlocked";
                    // send notification to user about welcome update;
                    $notifi = $conn->query("INSERT INTO user_notification (
                    userid,
                    message,
                    level,
                    badge
                    )VALUES (
                    '$user_email',
                    '$sms',
                    '$level',
                    '$badge'
                    )");
                    // redirect user to success page;
                    echo "<script>window.location.href='upload-success.html';</script>";
                }else{
                    die('error:'. $conn->error);
                }

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Only JPG, JPEG, PNG, & GIF files are allowed.";
        }
    } else {
        echo "File is not an image.";
    }
}
};

?>
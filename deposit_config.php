<?php
session_start();
$user_email = $_SESSION['user_email'];
require 'db_config.php';

if(isset($_POST['deposit_btn'])){

    $amount = $_POST['amount'];

    $dir = "reciept/";
        $reciept_file = basename($_FILES["reciept_img"]["name"]);
        $targetFilePath = $dir . $reciept_file;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // 1. Basic validation (check if it's an actual image)
    $check = getimagesize($_FILES["reciept_img"]["tmp_name"]);
    if($check !== false) {

        // 2. Allow only certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {

            // 3. Move the file to the target directory
            if (move_uploaded_file($_FILES["reciept_img"]["tmp_name"], $targetFilePath)) {
                $message = "Pendding payment of  $".$amount." into your account please wait for confirmation.";
                $level = "Level 2 Acheived";
                $badge = "Badge Unlocked";
                $status = 'pending';
                $bouns = 5000;
                // deposoit welcome bonus of $500 to user account; 
                $deposit = $conn->query("INSERT INTO user_deposit (userid, bonus, deposit_amount, deposit_photo, deposit_status) VALUES ('$user_email', '$bouns', '$amount', '$reciept_file', '$status')");
                 // send notification to user about welcome bonus;
                $notifi = $conn->query("INSERT INTO user_notification (userid, message, level, badge) VALUES ('$user_email','$message', '$level', '$badge')");
                

                $message2 = "Pendding payment of  $".$amount." into ".$user_email." please confirm the payment.";
                $notifi2 = $conn->query("INSERT INTO admin_data (userid, notifi) VALUES ('$user_email','$message2')");
                if($deposit){

                   // echo 'upload successfully $'.$amount;
                    header("Location: processing.php?amount=$amount");
                }
            }else{
                echo 'reciept upload fail';
            }
        }else{
            echo 'file type not supported';
        }
    }



}
?>
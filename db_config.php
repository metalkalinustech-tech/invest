<?php
$conn = New mysqli("localhost", "root", "");

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

//echo virexa_trust Database creating;
$db = $conn->query("CREATE DATABASE IF NOT EXISTS virexa_trust");

if(!$db){
    die("Database creation failed: " . $conn->error);
} else{
    //echo "Database created successfully";
}

// select virexa_trust database;
$conn->select_db("virexa_trust");

// Creating virexatrust_users;
$virexatrust_users_tb = $conn->query("CREATE TABLE IF NOT EXISTS virexatrust_users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    passwords VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

if(!$virexatrust_users_tb){
    die("Table creation failed: " . $conn->error);
}else{
    //echo "virexatrust_users table created successfully";
}

//user_profile table creating;
$user_profile_tb = $conn->query("CREATE TABLE IF NOT EXISTS user_profile (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(50) NOT NULL UNIQUE,
    profile_img VARCHAR(100) NOT NULL,
    user_address VARCHAR(150) NOT NULL,
    user_city VARCHAR(255) NOT NULL,
    contact_code VARCHAR(300) NOT NULL,
    user_contact VARCHAR(350) NOT NULL,
    user_country VARCHAR(355) NOT NULL,
    user_dob VARCHAR(420) NOT NULL,
    user_idcard VARCHAR(480) NOT NULL
)");

if(!$user_profile_tb){
    die("Table creation failed: " . $conn->error);
}else{
    //echo "user profile table created successfully";
}

// Creating user deposit table;
$deposit_tb = $conn->query("CREATE TABLE IF NOT EXISTS user_deposit (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(50) NOT NULL,
    bonus VARCHAR(100) NOT NULL,
    deposit_amount VARCHAR(150) NOT NULL,
    deposit_photo VARCHAR(200) NOT NULL,
    deposit_status VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

if(!$deposit_tb){
    die("Table creation failed: " . $conn->error);
}else{
    //echo "user deposit table created successfully";
}


// Creating user notification table;
$notification_tb = $conn->query("CREATE TABLE IF NOT EXISTS user_notification (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    level VARCHAR(20) NOT NULL,
    badge VARCHAR(30) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

if(!$notification_tb){
    die("Table creation failed: " . $conn->error);
}else{
    //echo "user notification table created successfully";
}



// Creating admin data table;
$admin_data_tb = $conn->query("CREATE TABLE IF NOT EXISTS admin_data (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    notifi VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

if(!$admin_data_tb){
    die("Table creation failed: " . $conn->error);
}else{
    //echo "admin data table created successfully";
}



?>
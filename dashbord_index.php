<?php
    session_start();
    $user_id = $_SESSION['user_email'];
    require_once 'db_config.php';
    $user_balance ="";
    $bouns = '';
    $reg_bonus = '';
      // get deposit
                                        $get_balance = $conn->query("SELECT * FROM user_deposit WHERE userid='$user_id' AND deposit_status='successfully'");
                                        if($get_balance->num_rows>0){
                                            $balance = $get_balance->fetch_assoc();
                                            $reg_bonus= $balance['bonus'];
                                        }else{
                                            echo 'Error fetching deposit data: ' . $conn->error;   
                                        }
?>
<!DOCTYPE html>
<html>
<head>
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta charset="utf-8">
        <title>Virexa Trust | User Dashboard</title>
        <link rel="icon" href="images/header/logo2.png">
        <meta name="description" content="User Dashboard">
        <link href="assets/globals.css" rel="stylesheet">
        <link href="assets/styleguide.css" rel="stylesheet">
        <link href="assets/style.css" rel="stylesheet">
        <script src="../../../../cdn.jsdelivr.net/npm/chart.js%404.4.0/dist/chart.umd.min.js"></script>
        <link href="../../../../cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    </script>
</script>
</head>
<body>
    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="dashboard-layout">
        <!-- ═══ SIDEBAR ═══ -->
        <aside class="side-bar" id="sidebar">
            <div class="logo">
                <div class="l-ogo">
                    <img class="fabicon" src="images/header/logo2.png" alt="logo">
                    <div class="text-wrapper-5">
                        VirexaTrust
                    </div>
                </div>
            </div>
            <img class="line" src="assets/images/line-20.svg">
            <div class="menu-bar">
                <div class="all">
                    <!-- Account Card -->
                    <div class="gaming-card" style='padding:2px'>
                        <img class="image"  src="images/header/logo2.png" alt="logo">
                        <div class="content">
                            <div class="title">
                                <div class="title-2">
                                    <div class="title-3">
                                        <?php 
                                        // get deposit
                                        $get_balance = $conn->query("SELECT * FROM user_deposit WHERE userid='$user_id' AND deposit_status='successfully' ORDER BY id DESC ");
                                        if($get_balance->num_rows>0){
                                            $balance = $get_balance->fetch_assoc();
                                            if($balance['bonus'] === $reg_bonus){
                                                $bouns = $reg_bonus;
                                            }else{
                                                $bouns = (int)$balance['bonus']+$reg_bonus;
                                            }
                                            
                                            $total_balance = "$" . (int)$balance['deposit_amount']+ $bouns;
                                            echo  $total_balance;
                                            $user_balance = $total_balance; 
                                        }else{
                                            echo 'Error fetching deposit data: ' . $conn->error;   
                                        }
                                        ?>
                                    </div>
                                    <div class="game-tag">
                                        Account Balance
                                    </div>
                                </div>
                            </div>
                            <div class="btn">
                                <button class="sizes-button btn custom-bg" onclick="window.location.href='deposite.php'">
                                    <span class="button">
                                        Deposit
                                    </span>
                                </button>
                                <button class="sizes-button-2 btn-hover-outline" onclick="document.location='wit/withdrawal.php'" style="border:solid 1px #5ccaf5;">
                                    <span class="button-2" style="color: #5ccaf5;">
                                        Withdraw
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="reviews">
                            <div class="text-2">
                                Level 1
                            </div>
                        </div>
                        <div class="reviews-2">
                            <img class="img-2" src="assets/images/currencycircledollar.svg">
                            <div class="text-3">
                                USD
                            </div>
                        </div>
                        <img class="image-2" src="assets/images/image.png">
                    </div>
                    <!-- Overview -->
                    <div class="div-2">
                        <div class="title-4">
                            Overview
                        </div>
                        <div class="div-2">
                            <a class="menu menu-link  custom-bg" href="dashbord_index.php">
                                <img class="img-2" src="assets/images/house.svg">
                                <div class="menu-2">
                                    <div class="text-wrapper-6">
                                        Dashboard
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Manage Information -->
                    <div class="div-2">
                        <div class="title-4">
                            Manage Information
                        </div>
                        <div class="menu-3">
                            <a class="div-3 menu-link" href="#">
                                <img class="img-2" src="assets/images/stack.svg">
                                <div class="menu-4">
                                    <div class="text-wrapper-7">
                                        Plan
                                    </div>
                                </div>
                            </a>
                            <a class="div-3 menu-link" href="#">
                                <img class="img-2" src="assets/images/handcoins.svg">
                                <div class="menu-4">
                                    <div class="text-wrapper-7">
                                        Invest History
                                    </div>
                                </div>
                            </a>

                            <a class="div-3 menu-link" href="#">
                                <img class="img-2" src="assets/images/shieldstar.svg">
                                <div class="menu-4">
                                    <div class="text-wrapper-7">
                                        Badges
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- ═══ MAIN CONTENT ═══ -->
        <div class="main-content" id="mainContent">
            <!-- ═══ TOP BAR ═══ -->
            <header class="top-bar">
                <div class="top-bar-left">
                    <!-- Hamburger/Close toggle -->
                    <button aria-label="Toggle sidebar" class="sidebar-toggle" id="sidebarToggle">
                        <i class="fa-solid fa-bars" id="toggleIcon"></i>
                    </button>
                    <div class="input-field-b">
                        <input class="search-input" placeholder="Search..." type="search">
                        <div class="icon" style="background: #28d2f0;">
                            <img class="magnifying-glass" src="assets/images/magnifyingglass.svg">
                        </div>
                    </div>
                </div>
                <div class="icon-2">
                    <!-- Language Dropdown -->
                    <div class="dropdown-wrapper" id="langDropdown">
                        <button aria-label="Language" class="icon-3 icon-btn" id="langBtn">
                            <img class="img" src="assets/images/globe.svg">
                        </button>
                        <div class="dropdown-menu" id="langMenu">
                            <div class="dropdown-header">
                                Language
                            </div>
                            <a class="dropdown-item active-item" href="dashbord_index.php">
                                <i class="fa fa-check"></i>
                                English
                            </a>
                            <a class="dropdown-item" href="dashbord_index.php">
                                <i class="fa fa-globe"></i>
                                French
                            </a>
                            <a class="dropdown-item" href="dashbord_index.php">
                                <i class="fa fa-globe"></i>
                                Spanish
                            </a>
                            <a class="dropdown-item" href="dashbord_index.php">
                                <i class="fa fa-globe"></i>
                                Arabic
                            </a>
                            <a class="dropdown-item" href="dashbord_index.php">
                                <i class="fa fa-globe"></i>
                                Chinese
                            </a>
                        </div>
                    </div>

    <!-- Notification Dropdown -->
    <?php 
        // get notification 
        $noti = $conn->query("SELECT * FROM user_notification WHERE userid='$user_id' ORDER BY id DESC LIMIT 1");
            if($noti->num_rows>0){
                        // Fetch the latest notification
                        $notification = $noti->fetch_assoc();
                        // Extract the message and created_at timestamp
                        $sms = $notification['message'];
                        // Format the created_at timestamp to display only the time 
                        $created_at = $notification['created_at'];
                        // Format the time to a more readable format (e.g., "h:i A" for 12-hour format with AM/PM)  
                        $time = date("h:i A", strtotime($created_at));
                        // Extract the level from the notification
                        $level = $notification['level'];
                        // Extract the badge from the notification
                        $badge = $notification['badge'];
                        echo '<div class="dropdown-wrapper" id="notifDropdown">
                        <button aria-label="Notifications" class="icon-3 icon-btn" id="notifBtn">
                            <img class="img" src="assets/images/bell.svg">
                            <div class="info">
                                <div class="text-wrapper-2">
                                    1
                                </div>
                            </div>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" id="notifMenu">
                            <div class="dropdown-header">
                                Notifications
                                <span class="badge-count">
                                    3 New
                                </span>
                            </div>
                            <div class="notif-item unread">
                                <div class="notif-icon notif-green">
                                    <i class="fa fa-arrow-down"></i>
                                </div>
                                <div class="notif-body">
                                    <div class="notif-title">
                                        '. $sms .'
                                    </div>
                                    <div class="notif-time">
                                        '. $time .'
                                    </div>
                                </div>
                            </div>
                            <div class="notif-item unread">
                                <div class="notif-icon notif-blue">
                                    <i class="fa fa-chart-line"></i>
                                </div>
                                <div class="notif-body">
                                    <div class="notif-title">
                                        '. $level .'
                                    </div>
                                    <div class="notif-time">
                                        Achievement • Plan #1042
                                    </div>
                                </div>
                            </div>
                            <div class="notif-item">
                                <div class="notif-icon notif-yellow">
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="notif-body">
                                    <div class="notif-title">
                                        '. $badge .'
                                    </div>
                                    <div class="notif-time">
                                        Now • Gold Investor
                                    </div>
                                </div>
                            </div>
                            <a class="dropdown-footer-link" href="notifi/notification.php">
                                View all notifications
                            </a> 
                        </div>
                    </div>';          
            }else{
                echo '<div class="notif-item">No new notifications</div>';
            }
    ?>
                    <!-- Profile Dropdown -->
                    <div class="dropdown-wrapper" id="profileDropdown">
                        <button aria-label="Profile" class="icon-4 icon-btn profile-btn" id="profileBtn">
                        <?php
                            $user_profile = $conn->query("SELECT * FROM user_profile WHERE userid='$user_id'");

                            if($user_profile-> num_rows>0){
                            $profile = $user_profile->fetch_assoc();
                            $profile_img = $profile['profile_img'];

                            if(!empty($profile_img)){
                                echo "<img src='profile_img/$profile_img' alt='profile image' class='rounded-circle' style='width: 44px; height: 44px; border-radius: 8px; object-fit: cover; display: block;'>";
                            }else{
                                echo "<img src='assets/images/profile.png' alt='profile image' class='rounded-circle' style='width: 44px; height: 44px; border-radius: 8px; object-fit: cover; display: block;'>";
                            }

                            }else{
                                echo "<img src='assets/images/profile.png' alt='profile image' class='rounded-circle' style='width: 44px; height: 44px; border-radius: 8px; object-fit: cover; display: block;'>";
                            }
                            ?>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" id="profileMenu">
                            <div class="profile-header">
                                <div class="profile-avatar-lg">
                                    <?php
                                        $user_profile = $conn->query("SELECT * FROM user_profile WHERE userid='$user_id'");

                                        if($user_profile-> num_rows>0){
                                        $profile = $user_profile->fetch_assoc();
                                        $profile_img = $profile['profile_img'];

                                        if(!empty($profile_img)){
                                            echo "<img src='profile_img/$profile_img' alt='profile image' class='rounded-circle' style='width: 44px; height: 44px; border-radius: 8px; object-fit: cover; display: block;'>";
                                        }else{
                                            echo "<img src='assets/images/profile.png' alt='profile image' class='rounded-circle' style='width: 44px; height: 44px; border-radius: 8px; object-fit: cover; display: block;'>";
                                        }

                                        }else{
                                            echo "<img src='assets/images/profile.png' alt='profile image' class='rounded-circle' style='width: 44px; height: 44px; border-radius: 8px; object-fit: cover; display: block;'>";
                                        }
                                    ?>
                                </div>
                                <div>
                                    <div class="profile-name">
                                        <?php echo $_SESSION['user_name']; ?>
                                    </div>
                                    <div class="profile-email">
                                        <?php echo $_SESSION['user_email']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="user_profile.php">
                                <i class="fa fa-user"></i>
                                My Profile
                            </a>
                            <a class="dropdown-item" href="settings/security.php">
                                <i class="fa fa-gear"></i>
                                Account Settings
                            </a>
                            <a class="dropdown-item" href="contact.html">
                                <i class="fa fa-shield"></i>
                                Contact us
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-credit-card"></i>
                                Helps
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="signout.php">
                                <i class="fa fa-right-from-bracket"></i>
                                Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <!-- ═══ INNER SCROLL AREA ═══ -->
            <div class="content-scroll">
                <!-- Notification Banner -->
                <div class="title-wrapper" id="notifBanner">
                    <div class="title-5">
                        <div class="info-2">
                            <p class="p">
                                Do not miss any single important notification! Allow your browser to get instant push notification.
                            </p>
                            <button class="sizes-button-3 btn-hover-primary custom-bg">
                                <span class="button">
                                    Allow Me
                                </span>
                            </button>
                        </div>
                        <button aria-label="Close" class="close-btn" id="closeBanner">
                            <img class="x" src="assets/images/x.svg">
                        </button>
                    </div>
                </div>
                <!-- Info Cards Row 1 -->
                <div class="all-user-info">
                    <div class="info-card-r">
                        <div class="content-wrapper">
                            <div class="content-2">
                                <div class="price">
                                    <div class="text-wrapper-8">
                                        Main Balance
                                    </div>
                                    <div class="title-6">
                                        <?php echo $user_balance; ?>
                                    </div>
                                </div>
                                <div class="img-wrapper" onclick="document.location='wallet/balance.php'">
                                    <img class="img-2" src="assets/images/wallet.svg">
                                </div>
                            </div>
                        </div>
                        <div class="title-7">
                            <a class="button-3 btn-link-hover" href="wallet/balance.php" style="color: #5ccaf5">
                                View all
                            </a>
                        </div>
                    </div>
                    <div class="info-card-r">
                        <div class="content-wrapper">
                            <div class="content-2">
                                <div class="price">
                                    <div class="text-wrapper-8">
                                        Interest Balance
                                    </div>
                                    <div class="title-6">
                                        $500.00
                                    </div>
                                </div>
                                <div class="icon-5">
                                    <img class="img-2" src="assets/images/currencycircledollar.svg">
                                </div>
                            </div>
                        </div>
                        <div class="title-7">
                            <a class="button-3 btn-link-hover" href="#" style="color: #5ccaf5">
                                View all
                            </a>
                        </div>
                    </div>
                    <div class="info-card-r">
                        <div class="content-wrapper">
                            <div class="content-2">
                                <div class="price">
                                    <div class="text-wrapper-8">
                                        Total Deposit
                                    </div>
                                    <div class="title-6">
                                        $0.00
                                    </div>
                                </div>
                                <div class="icon-6">
                                    <img class="img-2" src="assets/images/piggybank.svg">
                                </div>
                            </div>
                        </div>
                        <div class="title-7">
                            <a class="button-3 btn-link-hover" href="#" style="color: #5ccaf5">
                                View all
                            </a>
                        </div>
                    </div>
                    <div class="info-card-r">
                        <div class="content-wrapper">
                            <div class="content-2">
                                <div class="price">
                                    <div class="text-wrapper-8">
                                        Total Earn
                                    </div>
                                    <div class="title-6">
                                        $500.88
                                    </div>
                                </div>
                                <div class="icon-7">
                                    <img class="img-2" src="assets/images/creditcard-1.svg">
                                </div>
                            </div>
                        </div>
                        <div class="title-7">
                            <a class="button-3 btn-link-hover" href="#" style="color: #5ccaf5">
                                View all
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Charts Row -->
                <div class="charts-row">
                    <!-- Transaction Analytics -->
                    <div class="transaction card-panel">
                        <div class="title-8">
                            <div class="title-9">
                                Transaction History
                            </div>
                            <div class="tab-group" id="txnTabs">
                                <button class="tab-btn tab-active" data-range="all" style="background: #5ccaf5; border:none;">
                                    All
                                </button>
                                <button class="tab-btn" data-range="1m">
                                    1M 
                                </button>
                                <button class="tab-btn" data-range="6m">
                                    6M
                                </button>
                                <button class="tab-btn" data-range="1y">
                                    Amount
                                </button>
                            </div>
                            <div class="hostory-wrap">
                                <?php
                                    $his = $conn->query("SELECT * FROM user_deposit WHERE deposit_photo='Admin_approved' AND userid='$user_id' ORDER BY id DESC LIMIT 10");
                                    if($his->num_rows>0){
                                        while($history=$his->fetch_assoc()){
                                            echo '
                                            <p class="history-item"><span>Deposited bonus of </span> <span class="num-txt">$'.$history['bonus'].'</span></p>
                                            <p class="history-item"><span> Receive Incoming payment of </span> <span class="num-txt">$'.$history['deposit_amount'].'</span></p>
                                                    
                                                ';
                                        }
                                    }else{
                                        echo '
                                                <p class="history-none"> No history found!</p>
                                            ';
                                    }

                                
                                ?>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="transactionChart"></canvas>
                        </div>
                        <div class="all-info">
                            <div class="legend-item">
                                <div class="ellipse"></div>
                                <div class="text-wrapper-4">
                                    Investment
                                </div>
                            </div>
                            <div class="legend-item">
                                <div class="ellipse-2"></div>
                                <div class="text-wrapper-4">
                                    Payout
                                </div>
                            </div>
                            <div class="legend-item">
                                <div class="ellipse-3"></div>
                                <div class="text-wrapper-4">
                                    Deposit
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fund Analytics -->
                    <div class="fund-analytics card-panel">
                        <div class="title-8">
                            <div class="title-9">
                                Fund Analytics
                            </div>
                            <div class="tab-group" id="fundTabs">
                                <button class="tab-btn tab-active" data-range="all" style="background: #5ccaf5; border:none;">
                                    All
                                </button>
                                <button class="tab-btn" data-range="1m">
                                    1M
                                </button>
                                <button class="tab-btn" data-range="6m">
                                    6M
                                </button>
                                <button class="tab-btn" data-range="1y">
                                    1Y
                                </button>
                            </div>
                        </div>
                        <div class="donut-wrap">
                            <div class="donut-canvas-wrap">
                                <canvas id="fundChart"></canvas>
                                <div class="donut-center-label">
                                    <div class="svgjs-text-18">
                                        Average
                                    </div>
                                    <div class="svgjs-text-19">
                                        5%
                                    </div>
                                </div>
                            </div>
                            <div class="all-info-2">
                                <div class="info-3">
                                    <div class="color"></div>
                                    <div class="text-wrapper-9">
                                        Invest Completed
                                    </div>
                                </div>
                                <div class="info-3">
                                    <div class="color-2"></div>
                                    <div class="text-wrapper-9">
                                        ROI Speed
                                    </div>
                                </div>
                                <div class="info-3">
                                    <div class="color-3"></div>
                                    <div class="text-wrapper-9">
                                        ROI Redeemed
                                    </div>
                                </div>
                                <div class="info-3">
                                    <div class="color-4"></div>
                                    <div class="text-wrapper-9">
                                        Invest Pending
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Info Cards Row 2 + Referral -->
                <div class="bottom-row">
                    <!-- Info Cards -->
                    <div class="info-cards-col">
                        <div class="all-user-info-2">
                            <div class="info-card-r">
                                <div class="content-wrapper">
                                    <div class="content-2">
                                        <div class="price">
                                            <div class="text-wrapper-8">
                                                Total Invest
                                            </div>
                                            <div class="title-6">
                                                $500.38
                                            </div>
                                        </div>
                                        <div class="icon-7">
                                            <img class="img-2" src="assets/images/handcoins-1.svg">
                                        </div>
                                    </div>
                                </div>
                                <div class="title-7">
                                    <a class="button-3 btn-link-hover" href="#" style="color: #5ccaf5;">
                                        View all
                                    </a>
                                </div>
                            </div>
                            <div class="info-card-r">
                                <div class="content-wrapper">
                                    <div class="content-2">
                                        <div class="price">
                                            <div class="text-wrapper-8">
                                                Total Payout
                                            </div>
                                            <div class="title-6">
                                                $0.00
                                            </div>
                                        </div>
                                        <div class="img-wrapper">
                                            <img class="img-2" src="assets/images/coins.svg">
                                        </div>
                                    </div>
                                </div>
                                <div class="title-7">
                                    <a class="button-3 btn-link-hover" href="#" style="color: #5ccaf5;">
                                        View all
                                    </a>
                                </div>
                            </div>
                            <div class="info-card-r">
                                <div class="content-wrapper">
                                    <div class="content-2">
                                        <div class="price">
                                            <div class="text-wrapper-8">
                                                Total Ticket
                                            </div>
                                            <div class="title-6">
                                                0
                                            </div>
                                        </div>
                                        <div class="icon-5">
                                            <img class="img-2" src="assets/images/ticket.svg">
                                        </div>
                                    </div>
                                </div>
                                <div class="title-7">
                                    <a class="button-3 btn-link-hover" href="#" style="color: #5ccaf5;">
                                        View all
                                    </a>
                                </div>
                            </div>
                            <div class="info-card-r">
                                <div class="content-wrapper">
                                    <div class="content-2">
                                        <div class="price">
                                            <div class="text-wrapper-8">
                                                Total Referral Bonus
                                            </div>
                                            <div class="title-6">
                                                $0.00
                                            </div>
                                        </div>
                                        <div class="icon-6">
                                            <img class="img-2" src="assets/images/medal.svg">
                                        </div>
                                    </div>
                                </div>
                                <div class="title-7">
                                    <a class="button-3 btn-link-hover" href="#" style="color: #5ccaf5;">
                                        View all
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Referral Link -->
                    <div class="your-referral-link card-panel">
                        <div class="price-2">
                            <div class="text-wrapper-10">
                                Your referral link
                            </div>
                            <div class="input-field-b-2">
                                <input
                                    class="referral-input"
                                    id="referralInput"
                                    readonly=""
                                    type="text"
                                    value="<?php echo 'https://virexatrust.com/ref/' . $user_id; ?>">
                                <button class="sizes-button-7 btn-hover-primary" id="copyBtn" style="background: #5ccaf5;">
                                    <span class="button">
                                        Copy Link
                                    </span>
                                </button>
                            </div>
                            <div class="copy-success" id="copySuccess" style="display:none;">
                                ✓ Copied to clipboard!
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="footer">
                    <p class="text">
                        <span class="span">
                            Copyright ©2026
                        </span>
                        <span class="text-wrapper-3" style="color: #5ccaf5;">
                            Virexa Trust.
                        </span>
                        <span class="span">
                            . All Rights Reserved
                        </span>
                    </p>
                    <div class="footer-links">
                        <a class="text-wrapper-4 link-hover" href="index.html">
                            Help Center
                        </a>
                        <a class="text-wrapper-4 link-hover" href="index.html">
                            Privacy policy
                        </a>
                    </div>
                </footer>
            </div>
            <!-- end content-scroll -->
        </div>
        <!-- end main-content -->
    </div>

    <style>
        .custom-bg{
            background: #40aee6;
        }
        .custom-bg:hover{
            background: #68c5f3;
        }
        .history-item{
            font-size: 13px;
            border-radius:5px;
            font-weight: bold;
            background: rgb(106, 182, 233);
            margin-top: 20px;
            box-shadow: 0px 0px 5px #a1c4f3;
            width: 500px;
            padding:8px;
            color: #272a58c2;
            display:flex;
            justify-content:space-between;
            align-item:center;
        }
        .history-none{
            font-size: 13px;
            border-radius:5px;
            font-weight: bold;
            background: rgb(245, 131, 103);
            width: 500px;
            height:200px;
            padding:8px;
            color: #000000c2;
            display:flex;
            justify-content:space-between;
            align-item:center;
        .num-txt{
            background-color: #000;
            padding:3px;
            color: #f1f1f1;
        }
    </style>
    <!-- end dashboard-layout -->
    <script src="assets/style.js"></script>
</body>
</html>

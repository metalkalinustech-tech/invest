<?php session_start(); 
$verify_profile = false;
$address='';
$city ='';
$code ='';
$contact ='';
$country ='';
$user_dob = '';
$id_card ='';
$mybtn='visible';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>profile</title>
  <style>
    *{
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
  </style>
  <link rel="icon" href="images/header/logo2.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: rgb(14, 7, 7);">
  <!-- col-1 -->
  <div class="container text-center mt-3 bg-dark p-3 rounded">
  <div class="row">
    <div class="col text-start">
        <div class="search">
                      <form action="#">
                         <div class="input-group"><input type="text" class="form-control" placeholder="Search Here"><span class="input-group-text bg-primary text-white"><i class="bi bi-search"></i></span></div>
                      </form>
                   </div>
    </div>
    <div class="col text-end">
      <div class="profile_icon-wrap d-flex gap-3 flex-row justify-content-end">
        
        <span onclick="document.location='notifi/notification.php'"><i class="bi bi-bell my-icon" style="font-size: 20px;" title="Notifications"></i></span>
        <span onclick="document.location='wallet/balance.php'"><i class="bi bi-wallet2 my-icon" style="font-size: 20px;" title="wallet"></i></span>
        <span onclick="window.history.back()"><i class="bi bi-x-circle my-icon" style="font-size: 20px; cursor: pointer;" title="Close"></i></span>
      </div>
    </div> 
  </div>
</div><!-- col-1 end-->
<!-- col-2 -->
  <div class="container text-center mt-5">
  <div class="row">
    <div class="col text-start">
        <div class="profile-wrap">
            <?php
            $user_id = $_SESSION['user_email'];

            require_once 'db_config.php';
            $user_profile = $conn->query("SELECT * FROM user_profile WHERE userid='$user_id'");

            if($user_profile-> num_rows>0){
              $profile = $user_profile->fetch_assoc();
              $profile_img = $profile['profile_img'];

              if(!empty($profile_img)){
                echo "<img src='profile_img/$profile_img' alt='profile image' class='rounded-circle' style='width: 100px; height: 100px;'>";
                echo "<a href='profile_upload.php'><span class='my-icon text-primary'> Edit profile <i class='bi bi-pencil-square' title='Edit Profile'></i></span></a>";
              }else{
                echo "<img src='assets/images/profile.png' alt='profile image' class='rounded-circle' style='width: 100px; height: 100px;'>";
                echo "<a href='profile_upload.php'><span class='my-icon text-primary'> upload profile <i class='bi bi-pencil-square' title='upload Profile'></i></span></a>";
              }

            }else{
                echo "<img src='assets/images/profile.png' alt='profile image' class='rounded-circle' style='width: 100px; height: 100px;'>";
            }
            ?>
        </div>
        <h3 class="mt-3 text-primary">Welcome, <?php echo $_SESSION['user_name']; ?>!</h3>
    </div>
    <div class="col text-end">
      <span class="badge bg-primary text-dark p-3 text-white">Level 1</span>
    </div>
  </div>
</div>
<div class="container" style="margin-bottom: 100px;">
  <?php
  $profile_data = $conn->query("SELECT * FROM user_profile WHERE userid='$user_id'");
  $verify_profile =true;
  if($profile_data->num_rows>0){
      $data = $profile_data->fetch_assoc();
      $address=$data['user_address'];
      $city = $data['user_city'];
      $code = $data['contact_code'];
      $contact = $data['user_contact'];
      $country = $data['user_country'];
      $user_dob = $data['user_dob'];
      $id_card = $data['user_idcard'];
      $mybtn = 'none';
  }else{
    $verify_profile = false;
  }
  ?>
  <!-- form- -->
<?php
if($verify_profile == true){
  $disable = 'disabled';
  $verify_status = 'edit profile';
}else{
  $verify_status= 'Verify your acccount';
  $disable = 'none';
}
?>
  <form action="update_profile.php" method="POST" enctype="multipart/form-data">
  <div class="container mt-3 bg-dark p-5 rounded">
    <p><span class='badge bg-danger p-3'><?php echo $verify_status ?></span></p>
    <h4 class="text-info mt-3">Personal Information</h4> <br>
  <div class="row">
    <div class="col text-start">
      <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control p-2" placeholder="name" disabled value="<?php echo $_SESSION['user_name']; ?>">
    </div>
    <div class="col text-end">
      <p class="form-label text-start"><label for="email" class="form-label">Email</label></p>
      <input type="text" class="form-control p-2" placeholder="email" disabled value="<?php echo $_SESSION['user_email']; ?>">
      </div>
    </div> 
    <!--row-2-->
    <div class="row mt-3">
    <div class="col text-start">
      <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control p-2" placeholder="address" name="user_address" value="<?php echo $address; ?>" <?php echo $disable ?> required>
    </div>
    <div class="col text-end">
      <p class="form-label text-start"><label for="city" class="form-label">City</label></p>
      <input type="text" class="form-control p-2" placeholder="city" name="user_city" value="<?php echo $city; ?>" <?php echo $disable ?> required>
      </div>
    </div> 
    <!-- row 2 end-->
      <!--row-3-->
    <div class="row mt-3">
    <div class="col text-start">
      <label for="contact" class="form-label">Contact</label>
      <div class="contact-wrap">
        <select name="country_code" id="" class="form-select p-2" <?php echo $disable; ?> required>
          <?php 
          if(!empty($code)){
              echo '<option>'. $code .'</option>';
          }else{
            echo '<option> Country code </option>';
          }
          ?>
        <option value="+234">+234</option>
        <option value="+1">+1</option>
        <option value="+44">+44</option>
        <option value="+06">+06</option>
        <option value="+61">+61</option>
        <option value="+49">+49</option>
        <option value="+33">+33</option>
        <option value="+91">+91</option>
        <option value="+81">+81</option>
        <option value="+86">+86</option>
        <option value="+55">+55</option>
        <option value="+52">+52</option>
        <option value="+39">+39</option>
        <option value="+34">+34</option>
        <option value="+31">+31</option>
        <option value="+46">+46</option>
      </select>
        <input type="text" class="form-control p-2" placeholder="contact" name="user_contact" value='<?php echo $contact;?>' <?php echo $disable; ?> required>
      </div>
    </div>
    <div class="col text-end">
    <p class="form-label text-start"><label for="country" class="form-label">Country</label></p>
      <select name="user_country" id="" class="form-select p-2" <?php echo $disable; ?> required>
            <?php 
          if(!empty($country)){
              echo '<option>'. $country .'</option>';
          }else{
            echo '<option> select country  </option>';
          }
          ?>
        <option value="Nigeria">Nigeria</option>
        <option value="United States">United States</option>
        <option value="Canada">Canada</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="Philippines">Philippines</option>
        <option value="Australia">Australia</option>
        <option value="Germany">Germany</option>
        <option value="France">France</option>
        <option value="India">India</option>
        <option value="Japan">Japan</option>
        <option value="China">China</option>
        <option value="Brazil">Brazil</option>
        <option value="Mexico">Mexico</option>
        <option value="Italy">Italy</option>
        <option value="Spain">Spain</option>
        </select>
      </div>
      <!--row-4-->
    <div class="row mt-3">
    <div class="col text-start">
      <label for="date" class="form-label" class="form-label">Date of Birth</label>
        <input type="date" class="form-control p-2" placeholder="date of birth" name="user_dob" value="<?php echo $user_dob; ?>" <?php echo $disable;?> required />
    </div>
    <div class="col text-end">
      <p class="form-label text-start"><label for="file" class="form-label">Upload a valid ID <i>Driver lience or State ID card</i></label></p>
      <?php  if (!empty($id_card)) { 
        echo "<p> <img src='id_card/$id_card' alt='ID card image' class='rounded' style='width: 200px; height: 100px;'> </p>";
      }else{
        echo "<input type='file' class='form-control p-2' name='image' accept='image/*' required>";
      }?>
      
      </div>
    </div> 
    <!-- row 4 end-->
      <div class="text-start mt-3"><button class="btn btn-info" name="verify_info" style="display: <?php echo $mybtn; ?>">Verify Information</button></div>
    </div> 
    <!-- row 3 end-->
  </div>
</div>
</form>
<!-- FORM end-->
</div>
<!-- col-2 end -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
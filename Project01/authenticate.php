<?php

// Start session
session_start();


// print_r($_POST);
include('connection.php');  

// Validate email address
$uemail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
if ($uemail === false) {
  echo "<h1>Invalid email address.</h1>";
  exit;
}

// Sanitize password
$upassword = mysqli_real_escape_string($con, $_POST['upassword']);

// Run query
$sql = "select * from reg_user where uemail = '$uemail' and upassword = '$upassword'";
$result = mysqli_query($con, $sql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
$count = mysqli_num_rows($result);  
        
// Check if login was successful
if($count == 1){
    
    // Create session variables
        $_SESSION['uemail'] = $uemail;
        $_SESSION['uname'] = $row['uname'];
        
        session_regenerate_id(true);
        setcookie('session_id', session_id(), time() + 3600, '/');
    
    
    echo "<h1><center> Login successful </center></h1>";
    header('Location: Products.php');
}  
else{  
    echo "<h1> Login failed. Invalid username or password.</h1>";  
}     
?>  

<?php
$name = $_POST['name'];
$nameOfChild = $_POST['name2'];
$age = $_POST['age'];
$date = $_POST['date'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$comment = $_POST['comment'];

if(!empty($name) || !empty($name2) || !empty($age) || !empty($date) || !empty($phone) || !empty($email)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "agi_reg_database";

    // connection
    $conn = new mysqli($host, $dbUsername, $dbPassword,$dbname);
    if(mysqli_connect_error()) {
      die('Connect Error(' . mysqli_connect_error().')'. mysqli_connect_error());
    }else{
      $SELECT = "SELECT email From register Where email = ? Limit 1";
      $INSERT = "INSERT Into register (name,name2,age,date,phone,email,comment) value(?,?,?,?,?,?,?)";

      // prepare statement
      $stmt = $conn->prepare($SELECT);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->bind_result($email);
      $stmt->store_result();
      $rnum = $stmt->num_rows;

      if($rnum==0){
        $stmt->close();

        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssiiiss"$name,$name2,$age,$date,$phone,$email,$comment);
        $stmt->execute();
        echo "New record inserted successfully";
      }else {
        echo "Someone already registered with this email address";
      }
      $stmt->close();
      $conn->close();
    }
}else {
  echo "All fields are required";
  die();
}

 ?>

<?php
    $first_name=$_POST['first-name'];
    $last_name=$_POST['last-name'];
    $user_name=$_POST['user-name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password_hashed=password_hash($password,PASSWORD_DEFAULT);
    $register=$_POST['reg-no'];
    $phone_number=$_POST['ph-no'];
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $db_name="social_media";
    $flag=0;
    $conn = new mysqli($servername, $username, $pass,$db_name);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $check="SELECT `email`,`user`,`register`,`phone` from `new_registration`";
    $res=mysqli_query($conn,$check);

    if($res->num_rows){
      while($row=$res->fetch_assoc()){
        if(($email==$row['email']) or ($user_name==$row['user']) or ($register==$row['register']) or ($phone_number==$row['phone'])){
          $flag=1;
          break;
        }
      }
    }
    if($flag==1){
      echo "User Exist";
    }
    else{
      $sql="INSERT INTO `new_registration` (id,`first`,`last`,`user`,`email`,`password`,`register`,`phone`) VALUES('id','$first_name','$last_name','$user_name','$email','$password_hashed','$register','$phone_number')";
      $sql1="INSERT INTO `login` (id,`email`,`password`) VALUES('id','$email','$password_hashed')";
      $rs=mysqli_query($conn,$sql);
      $rs1=mysqli_query($conn,$sql1);
      if($rs && $rs1){
        echo "Added Succesfully";
        // header("Location: index.html");
      }
      else{
        echo "Failed";
      }
    }
?>
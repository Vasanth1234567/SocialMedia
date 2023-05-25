<?php
    $email=$_GET['email'];
    $password=$_GET['password'];
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $db_name="social_media";
    $flag=0;
    $conn=new mysqli($servername,$username,$pass,$db_name);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $sql="SELECT `email`,`password` from `login`";
    $rs=mysqli_query($conn,$sql);

    if($rs->num_rows){
        while($row=$rs->fetch_assoc()){
            if($email==$row['email']){
                if(password_verify($password,$row['password'])){
                    echo "Login Succesfull";
                }
                else{
                    echo "Wrong Password";
                }
                $flag=1;
                break;
            }
        }
    }
    if($flag!=1){
        echo "User Email Dosn't Exit";
    }
    else{

    }
?>
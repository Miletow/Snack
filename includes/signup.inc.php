<?php

if(isset($_POST['submit'])){

  include_once 'dbh.inc.php';


  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

  //Error handlers
  //Check for empty fields
  if(empty($email)||empty($uid)||empty($pwd)){
    header("Location: ../signup.php?signup=empty");
    exit();
  }else{
    //Check if input characters are valid
    if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
      header("Location: ../signup.php?signup=invalid");
      exit();
    }else{
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?signup=email");
        exit();
      }else{
        $sql = "SELECT * FROM users WHERE user_uid='$uid'";
        $result = mysqli_query($conn, $sqli);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0 ) {
          header("Location: ../signup.php?signup=usertaken");
          exit();
        } else {
          //Hashing the Password
          $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
          //Insert the user into the datbase
          $sql = "INSERT INTO users (user_email, uid, pwd) VALUES (?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
           if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL input error";
           }else{
            mysqli_stmt_bind_param($stmt, "sss", $email, $uid, $hashedPwd);
            mysqli_stmt_execute($stmt);
            header("Location: ../index.php?signup=success");
            exit();
        }
      }
    }
  }
}

  header("Location: ../signup.php");
  exit();
}

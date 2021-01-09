<?php
include_once('conn.php');
session_start();

if(isset($_POST['add'])){

    extract($_POST);


    $sql = "INSERT INTO users (name, email, phone)
    VALUES ('$name', '$email', '$phone')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "User Added!";
    //   echo "New record created successfully";
        header('Location:index.php');
    } else {
        $_SESSION['error'] = $conn->error;
      echo "Error: " . $sql . "<br>" . $conn->error;
        header('Location:index.php');
    }
}


else if(isset($_POST['update'])){

    extract($_POST);

    
    $sql = "UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE id = $update_id";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "User Updated!";
    //   echo "New record created successfully";
        header('Location:index.php');
    } else {
        $_SESSION['error'] = $conn->error;
      echo "Error: " . $sql . "<br>" . $conn->error;
        header('Location:index.php');
    }
}

else if(isset($_GET['delete'])){

    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "User Deleted!";
    //   echo "New record created successfully";
        header('Location:index.php');
    } else {
        $_SESSION['error'] = $conn->error;
      echo "Error: " . $sql . "<br>" . $conn->error;
        header('Location:index.php');
    }
}


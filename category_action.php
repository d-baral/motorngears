<?php
session_start();
include 'db_connection.php';



//adding category to the database

if(isset($_POST['add_category_button']))
{
  $categoryname=$_POST['catg_name'];
$categorydescription=$_POST['catg_desc'];
    
$sql = "INSERT INTO post_category(cname,cdescription)
VALUES ('$categoryname', '$categorydescription')";

if ($conn->query($sql) === TRUE) {

    $_SESSION['suc_message']="Category Added Succesfully!";
    header('location:category.php');
    
  } else {
    header('location:dashboard.php');
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();
}

// deleting data
elseif(isset($_GET['cid']))
{ 
  $cid = $_GET['cid'];
  $sql = "DELETE FROM post_category WHERE cid=$cid";
  if ($conn->query($sql) === TRUE) {

    $_SESSION['deleted_message']="Category Deleted Succesfully!";
    header('location:category.php');
    
  } else {
    header('location:category.php');
  }
  
  $conn->close();
}

//redirecting to dashboard if direct url is given
else{
    header('location:dashboard.php');
}





?>
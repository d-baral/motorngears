<?php
session_start();
include 'db_connection.php';


// if(isset($_POST['add_post_button']) && isset($_FILES['feat_image']))
if(isset($_POST['add_post_button']))
{
  $post_title=$_POST['post_title'];
  $post_content=$_POST['post_content'];
  $post_category=$_POST['post_category'];
    
  if(isset($_FILES['feat_image']))
  {
    $img_name=$_FILES['feat_image']['name'];
    $img_size=$_FILES['feat_image']['size'];
    $tmp_name=$_FILES['feat_image']['tmp_name'];
    $error=$_FILES['feat_image']['error'];

    if($error === 0)
    {
      if($img_size>125000)
      {
        $_SESSION['post_message'] = "File if too large";
        header("location: newpost.php");
      }
      else
      {
        $image_extension=pathinfo($img_name, PATHINFO_EXTENSION);
        $image_extension_lowercase=strtolower($image_extension);
        $allowed_extenion=array("jpg", "jpeg", "png");

        if(in_array($image_extension_lowercase, $allowed_extenion))
        {
          $new_img_name = uniqid("IMG-",true).'.'.$image_extension_lowercase;
          $image_upload_path='assets/images/'.$new_img_name;
          move_uploaded_file($tmp_name,$image_upload_path); 

          
        $sql = "INSERT INTO post(ptitle,pdescription,post_cat_id,image_url)
                VALUES ('$post_title', '$post_content', '$post_category', '$new_img_name')";

        if ($conn->query($sql) === TRUE) 
        {

         $_SESSION['post_message']="Post Added Succesfully!";
         header('location:post.php');
        } 

        }
        else
        {
          $_SESSION['post_message'] = "Not a valid Image Format";
          header('location: newpost.php');
        }
      }
    }

    else
    {
      $new_img_name="placeholder.jpg";
      $sql = "INSERT INTO post(ptitle,pdescription,post_cat_id,image_url)
      VALUES ('$post_title', '$post_content', '$post_category', '$new_img_name')";

    if ($conn->query($sql) === TRUE) 
    {
      $_SESSION['post_message']="Post Added Succesfully!";
      header('location:post.php');
    } 
    }
    $conn->close();
  }

  else
  {
    $img_name=$_FILES['feat_image']['name'];
    $img_size=$_FILES['feat_image']['size'];
    $tmp_name=$_FILES['feat_image']['tmp_name'];
    $error=$_FILES['feat_image']['error'];

    if($error === 0)
    {
      if($img_size>125000)
      {
        $_SESSION['post_message'] = "File if too large";
        header("location: newpost.php");
      }
      else
      {
       

        if ($conn->query($sql) === TRUE) 
        {

         $_SESSION['post_message']="Post Added Succesfully!";
         header('location:post.php');
        } 

        }
    }

    else
    {
      $_SESSION['post_message'] = "Unknown Error Occured!";
        header('location: newpost.php');
    }
    $conn->close();
  }


}

elseif(isset($_GET['pid']))
{ 
  $pid = $_GET['pid'];
  $sql = "DELETE FROM post WHERE pid=$pid";
  if ($conn->query($sql) === TRUE) {

    $_SESSION['post_delete_message']="Post Deleted Succesfully!";
    header('location:post.php');
    
  } else {
    header('location:post.php');
  }
  
  $conn->close();
}

//redirecting to dashboard if direct url is given
else{
    header('location:dashboard.php');
}


?>

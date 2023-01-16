<?php
session_start();
include 'db_connection.php';

//Adding New Post
if (isset($_POST['add_post_button'])) {

  $post_title = $conn->real_escape_string($_POST['post_title']);
  $post_content = $conn->real_escape_string($_POST['post_content']);
  $post_category = $_POST['post_category'];

  if (isset($_FILES['feat_image'])) {
    $img_name = $_FILES['feat_image']['name'];
    $img_size = $_FILES['feat_image']['size'];
    $tmp_name = $_FILES['feat_image']['tmp_name'];
    $error = $_FILES['feat_image']['error'];

    if ($error === 0) {
      if ($img_size > 1250000) {
        $_SESSION['post_message'] = "File if too large";
        header("location: newpost.php");
      } else {
        $image_extension = pathinfo($img_name, PATHINFO_EXTENSION);
        $image_extension_lowercase = strtolower($image_extension);
        $allowed_extenion = array("jpg", "jpeg", "png", "webp");

        if (in_array($image_extension_lowercase, $allowed_extenion)) {
          $new_img_name = uniqid("IMG-", true) . '.' . $image_extension_lowercase;
          $image_upload_path = 'assets/images/' . $new_img_name;
          move_uploaded_file($tmp_name, $image_upload_path);



          $sql = "INSERT INTO post(ptitle,pdescription,post_cat_id,image_url)
                VALUES ('$post_title', '$post_content', '$post_category', '$new_img_name')";

          if ($conn->query($sql) === TRUE) {

            $_SESSION['post_message'] = "Post Added Succesfully!";
            header('location:post.php');
          }
        } else {
          $_SESSION['post_message'] = "Not a valid Image Format";
          header('location: newpost.php');
        }
      }
    } else {
      $new_img_name = "placeholder.jpg";
      $sql = "INSERT INTO post(ptitle,pdescription,post_cat_id,image_url)
      VALUES ('$post_title', '$post_content', '$post_category', '$new_img_name')";

      if ($conn->query($sql) === TRUE) {
        $_SESSION['post_message'] = "Post Added Succesfully!";
        header('location:post.php');
      }
    }
    $conn->close();
  }
}


//Editing Post
elseif (isset($_POST['edit_post_button'])) {
  $pid = $_POST['pid'];
  $post_title = $conn->real_escape_string($_POST['post_title']);
  $post_content = $conn->real_escape_string($_POST['post_content']);
  $post_category = $_POST['post_category'];

  if (isset($_FILES['feat_image'])) {
    $img_name = $_FILES['feat_image']['name'];
    $img_size = $_FILES['feat_image']['size'];
    $tmp_name = $_FILES['feat_image']['tmp_name'];
    $error = $_FILES['feat_image']['error'];

    if ($error === 0) {
      if ($img_size > 1250000) {
        $_SESSION['post_message'] = "File if too large";
        header("location: newpost.php");
      } else {
        $image_extension = pathinfo($img_name, PATHINFO_EXTENSION);
        $image_extension_lowercase = strtolower($image_extension);
        $allowed_extenion = array("jpg", "jpeg", "png", "webp");

        if (in_array($image_extension_lowercase, $allowed_extenion)) {
          $new_img_name = uniqid("IMG-", true) . '.' . $image_extension_lowercase;
          $image_upload_path = 'assets/images/' . $new_img_name;
          move_uploaded_file($tmp_name, $image_upload_path);


          $sql = "UPDATE post SET ptitle='$post_title',pdescription='$post_content',post_cat_id='$post_category',image_url='$new_img_name' WHERE pid=$pid";

          if ($conn->query($sql) === TRUE) {

            $_SESSION['post_message'] = "Post Edited Succesfully!";
            header('location:post.php');
          }
        } else {
          $_SESSION['post_message'] = "Not a valid Image Format";
          header('location: newpost.php');
        }
      }
    } else {
      $new_img_name = $_POST['pimage'];
      $sql = "UPDATE post SET ptitle='$post_title',pdescription='$post_content',post_cat_id='$post_category',image_url='$new_img_name' WHERE pid=$pid";

      if ($conn->query($sql) === TRUE) {
        $_SESSION['post_message'] = "Post Edited Succesfully!";
        header('location:post.php');
      }
    }
    $conn->close();
  }
}


//Deleting Post
elseif (isset($_GET['pid'])) {
  $pid = $_GET['pid'];
  $sql = "DELETE FROM post WHERE pid=$pid";
  if ($conn->query($sql) === TRUE) {

    $_SESSION['post_delete_message'] = "Post Deleted Succesfully!";
    header('location:post.php');
  } else {
    header('location:post.php');
  }

  $conn->close();
}

//redirecting to dashboard if direct url is given
else {
  header('location:dashboard.php');
}
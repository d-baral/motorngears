<?php 
session_start();
if(!isset($_SESSION['loginid']))
{
header('location:index.php'); 
}  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MotorNGears | Dashboard </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/sidemenu.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <!-- Side navigation -->
<div class="sidenav">
   <p class="sidebarlogo"><a href="dashboard.php"><img src="./assets/pics/mngwhite.png"></a><p>
    <hr>
    <ul>
        <li> <a class="active" href="dashboard.php">Dashboard</a></li>
        <li> <a href="post.php">All Post</a></li>
        <li> <a href="category.php">Category</a></li>
    </ul>
  <hr>
<span> <a href="logout.php">Log Out</a></span>
</div>

<!-- Page content -->
<div class="dashboard-main">
    <?php
        include 'db_connection.php';
        $sql1="SELECT * FROM post_category";
        $sql2="SELECT * FROM post";

        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sql2);

        if($result1->num_rows>0)
        {
            $cat_count=0;
            while($row=$result1->fetch_assoc())
            {
                $cat_count++;
            }
        }

        if($result1->num_rows>0)
        {
            $post_count=0;
            while($row=$result2->fetch_assoc())
            {
                $post_count++;
            }
        }
        ?>
         <p id="welcome">Welcome to MotorNGears Dashboard.</p>
           <div class="details-container">
        <div class="details-box">
            <span class="number"> <?php echo $post_count ?></span>
            <h4> Total Posts</h4>
        </div>
        <div class="details-box">
            <span class="number"> <?php echo $cat_count ?></span>
            <h4> Total Categories</h4>
        </div>
           </div>

</div>
    
    </body>
</html>

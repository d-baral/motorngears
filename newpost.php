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
    <title>MotorNGears | New Post </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/sidemenu.css">
    <link rel="stylesheet" href="assets/css/cat_form.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
    function confirm_delete() {
        confirm("Are you sure, you want delete?")
    }
    </script>
</head>

<body>
    <!-- Side navigation -->
    <div class="sidenav">
        <p class="sidebarlogo"><a href="dashboard.php"><img src="./assets/pics/mngwhite.png"></a>
        <p>
            <hr>
        <ul>
            <li> <a href="dashboard.php">Dashboard</a></li>
            <li> <a class="active" href="post.php">All Post</a></li>
            <li> <a href="category.php">Category</a></li>
        </ul>
        <hr>
        <span class="logout"> <a href="index.php">Log Out</a></span>
    </div>

    <!-- Page content -->
    <div class="main">

        <div class="new_category">
            <h1 class="head-title">
                New Post
            </h1>
            <?php
                   if(isset($_SESSION['post_message']))
                   {
                    ?>
            <div class="error">
                <?php echo $_SESSION['post_message']; 
                    unset($_SESSION['post_message']);
                    ?>
            </div>
            <?php 
                   }
                    ?>
            <div class="cat-container">

                <form id="addcategory" method="POST" action="post_action.php" enctype="multipart/form-data">


                    <label>
                        <b>Post Title</b>
                    </label>
                    <input required type="text" placeholder="Enter title of the post" name="post_title" id="post_title">
                    <label>
                        <b>Post Content</b>
                    </label>
                    <textarea required name="post_content" id="post_content"></textarea>
                    <label>
                        <b>Post Category</b>
                    </label>
                    <select name="post_category" required>
                        <option value="Category List" selected disabled>Category List</option>
                        <?php
                        include 'db_connection.php';
                        $sql= "SELECT * from post_category";
                        $result = $conn->query($sql);

                        if($result->num_rows>0)
                        {
                            ?>

                        <?php
                            while($row = $result->fetch_assoc())
                            {
                                ?>

                        <option value="<?php echo $row["cid"]; ?>">
                            <?php echo($row["cname"]);?>
                        </option>
                        <?php
                            }
                        }

                        ?>
                    </select>
                    <label>
                        <b>Featured Image</b>
                    </label>
                    <input type="file" name="feat_image" id="feat_image">

                    <button class="button" name="add_post_button">
                        Add New Post
                    </button>
                </form>
            </div>
        </div>

    </div>
    </div>



</body>

</html>
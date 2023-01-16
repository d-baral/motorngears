<?php
session_start();
if (!isset($_SESSION['loginid'])) {
    header('location:index.php');
}
?>
<?php

include 'db_connection.php';

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $sql = "SELECT * FROM post WHERE pid=$pid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $ptitle_fetched = $row["ptitle"];
    $pdescription_fetched = $row["pdescription"];
    $pimage_fetched = $row["image_url"];
    $post_cat_id_fetched = $row["post_cat_id"];
    $conn->close();
} else {
    header('location:post.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MotorNGears | Edit Post </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/sidemenu.css">
    <link rel="stylesheet" href="assets/css/cat_form.css">
    <link rel="stylesheet" href="assets/css/style.css">
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
                Edit Post
            </h1>
            <div class="cat-container">

                <form id="addcategory" method="POST" action="post_action.php" enctype="multipart/form-data">


                    <label>
                        <b>Post Title</b>
                    </label>
                    <input required type="text" placeholder="Enter title of the post" name="post_title" id="post_title"
                        value="<?php echo $ptitle_fetched; ?>">
                    <label>
                        <b>Post Content</b>
                    </label>
                    <textarea required name="post_content" id="post_content">
                    <?php echo $pdescription_fetched; ?></textarea>
                    <label>
                        <b>Post Category</b>
                    </label>
                    <select name="post_category" required>
                        <option value="Category List" disabled>Category List</option>
                        <?php
                        include 'db_connection.php';
                        $sql = "SELECT * from post_category";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            ?>

                            <?php
                            while ($row = $result->fetch_assoc()) {
                                if ($row["cid"] == $post_cat_id_fetched) {
                                    ?>
                                    <option selected value="<?php echo $row["cid"]; ?>">
                                        <?php echo ($row["cname"]); ?>
                                    </option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $row["cid"]; ?>">
                                        <?php echo ($row["cname"]); ?>
                                    </option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                    <label>
                        <b>Featured Image</b>
                    </label>
                    <img class="edit_feat_image" src="./assets/images/<?php echo $pimage_fetched; ?> ">
                    <input type="file" name="feat_image" id="feat_image">
                    <input type="hidden" name="pid" value="<?php echo $pid ?>">
                    <input type="hidden" name="pimage" value="<?php echo $pimage_fetched ?>">
                    <button class="button" name="edit_post_button">
                        Edit Post
                    </button>
                </form>
            </div>
        </div>

    </div>
    </div>



</body>

</html>
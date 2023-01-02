<?php
session_start();
include 'db_connection.php';
if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $sql = "SELECT * FROM post_category WHERE cid=$cid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $cname_fetched = $row["cname"];
    $cdescription_fetched = $row["cdescription"];
    $conn->close();
} else {
    header('location:category.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MotorNGears | Edit Category </title>
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
            <li> <a href="post.php">All Post</a></li>
            <li> <a class="active" href="category.php">Category</a></li>
        </ul>
        <hr>
        <span class="logout"> <a href="index.php">Log Out</a></span>
    </div>

    <!-- Page content -->
    <div class="main">
        <div class="noscroll">
            <div class="new_category">
                <h1 class="head-title">
                    Edit Category
                </h1>
                <div class="cat-container">

                    <form id="addcategory" method="POST" action="category_action.php">
                        <label>
                            <b>Category Name</b>
                        </label>
                        <input type="text" placeholder="Enter name of the category" name="catg_name" id="catg_name"
                            value="<?php echo $cname_fetched; ?>" required>
                        <label>
                            <b>Category Description</b>
                        </label>
                        <input type="text" placeholder="Describe the Category" name="catg_desc" id="catg_desc"
                            value="<?php echo $cdescription_fetched; ?>">
                        <input type="hidden" name="cid" value="<?php echo $cid; ?> ">
                        <button class="button" name="edit_category_button">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
</body>

</html>
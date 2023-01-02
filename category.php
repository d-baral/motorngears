<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MotorNGears | Category </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/sidemenu.css">
    <link rel="stylesheet" href="assets/css/cat_form.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
    function confirm_delete() {
        if (confirm("Are you sure, you want delete?") == true) {
            console.log("OK CLicked");
        } else {
            console.log("Cancel CLicked");
        }
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
                    New Category
                </h1>
                <div class="cat-container">

                    <form id="addcategory" method="POST" action="category_action.php">
                        <label>
                            <b>Category Name</b>
                        </label>
                        <input type="text" placeholder="Enter name of the category" name="catg_name" id="catg_name"
                            required>
                        <label>
                            <b>Category Description</b>
                        </label>
                        <input type="text" placeholder="Describe the Category" name="catg_desc" id="catg_desc">
                        <?php
                        session_start();
                        ?>

                        <button class="button" name="add_category_button">
                            Add Category
                        </button>
                    </form>
                </div>
            </div>

            <div class="new_category">
                <h1 class="head-title">
                    All Category
                </h1>
                <?php
                if (isset($_SESSION['deleted_message'])) {
                ?>
                <div class="error">
                    <?php echo $_SESSION['deleted_message'];
                        unset($_SESSION['deleted_message']);
                        ?>
                </div>
                <?php
                }
                ?>
                <?php
                if (isset($_SESSION['suc_message'])) {
                ?>
                <div class="success">
                    <?php echo $_SESSION['suc_message'];
                        unset($_SESSION['suc_message']);
                        ?>
                </div>
                <?php
                }
                ?>
                <div class="cat-container">
                    <table>
                        <tr>
                            <th>S.N.</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th colspan="2">Operations</th>
                        </tr>
                        <?php
                        include 'db_connection.php';
                        $sql = "SELECT * FROM post_category";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                $count++;
                                $cid = $row["cid"];
                        ?>
                        <tr>
                            <td> <?php echo $count . "."; ?></td>
                            <td> <?php echo $row["cname"]; ?></td>
                            <td> <?php echo $row["cdescription"]; ?></td>
                            <td>
                                <a href="edit_category.php?cid=<?php echo $cid; ?>" class="icon-button">
                                    <img src="./assets/icons/edit.png" alt="Edit Icon">
                                </a>
                            </td>
                            <td>
                                <a href="category_action.php?cid=<?php echo $cid; ?>" onclick="confirm_delete();"
                                    class="icon-button">
                                    <img src="./assets/icons/delete.png" alt="Delete Icon">
                                </a>
                            </td>

                        </tr>
                        <?php
                            }
                        }
                        $conn->close();
                        ?>
                    </table>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
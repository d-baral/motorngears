<?php
session_start();
if (!isset($_SESSION['loginid'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MotorNGears | All Posts </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/sidemenu.css">
    <link rel="stylesheet" href="assets/css/cat_form.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
        function confirm_delete() {
            confirm("Are you sure, you want delete?");
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
        <div class="noscroll">
            <div class="new_category">


                <a class="newpost-btn-link" href="newpost.php">
                    <div class="new-post-button">Create New Post</div>
                </a>

            </div>

            <div class="new_category">
                <h1 class="head-title">
                    All Posts
                </h1>
                <?php
                if (isset($_SESSION['post_message'])) {
                    ?>
                    <div class="success">
                        <?php echo $_SESSION['post_message'];
                        unset($_SESSION['post_message']);
                        ?>
                    </div>
                    <?php
                }
                ?>
                <?php
                if (isset($_SESSION['post_delete_message'])) {
                    ?>
                    <div class="error">
                        <?php echo $_SESSION['post_delete_message'];
                        unset($_SESSION['post_delete_message']);
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="cat-container">
                    <table>
                        <tr>
                            <th>S.N.</th>
                            <th>Post Title</th>
                            <th>Post Description</th>
                            <th>Post Category</th>
                            <th>Featured Image</th>
                            <th colspan="2">Operations</th>
                        </tr>
                        <?php
                        include 'db_connection.php';
                        $sql = "SELECT * FROM post";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                $count++;
                                $pid = $row["pid"];
                                $post_cat_id = $row["post_cat_id"];
                                $image_url = $row["image_url"];
                                ?>
                                <tr>
                                    <td> <?php echo $count . "."; ?></td>
                                    <td>
                                        <?php echo $row["ptitle"]; ?>
                                    </td>
                                    <td class="postdescription-column"> <span>
                                            <?php echo $row["pdescription"]; ?>
                                        </span></td>
                                    <td>
                                        <?php
                                        $sql1 = "SELECT * FROM post_category";
                                        $result1 = $conn->query($sql1);
                                        if ($result1->num_rows > 0) {
                                            while ($row = $result1->fetch_assoc()) {
                                                $cid = $row["cid"];
                                                if ($cid == $post_cat_id) {
                                                    echo $row["cname"];
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <img src="./assets/images/<?php echo $image_url; ?>">
                                    </td>
                                    <td>
                                        <a href="editpost.php?pid=<?php echo $pid; ?>" class="icon-button">
                                            <img src="./assets/icons/edit.png" alt="Edit Icon">
                                            </button>
                                    </td>
                                    <td>
                                        <?php echo "<a onClick=\" javascript:return confirm('Are You Sure to Delete?');\"href='category_action.php?pid={$row['pid']}'>
                                Delete
                                </a>"; ?>
                                        <!-- <img src='./assets/icons/delete.png' alt='Delete Icon'> -->
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
<?php
if (!isset($_GET['cid'])) {
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php
    include 'db_connection.php';
    $cid = $_GET['cid'];
    $sql = "SELECT * FROM post_category WHERE cid=$cid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $tab_name = $row["cname"];
    $conn->close();
    ?>
    <title>MotorNGears | <?php echo $tab_name ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/navigation.css">
    <link rel="stylesheet" href="./assets/css/singlecatpage.css">

</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <a href="index.php">
                    <img src="./assets/pics/mngwhite.png" height="60">
                </a>
            </div>
            <input type="checkbox" id="click">
            <label for="click" class="menu-btn">
                <i class="fas fa-bars"></i>
            </label>
            <ul>
                <li>
                    <?php
                    include 'db_connection.php';
                    $sql = "SELECT * FROM post_category";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $menu_name = $row["cname"];
                            ?>
                            <a href="singlecategorypage.php?cid=<?php echo $row["cid"] ?>">
                                <?php echo "$menu_name" ?>
                            </a>
                            <?php
                        }
                    }
                    $conn->close();
                    ?>
                    <a class=" log-btn" href="login.php">LOGIN</a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="main-container">
        <div class="grid-container">
            <?php
            include 'db_connection.php';
            $sql = "SELECT * FROM post WHERE post_cat_id=$cid ORDER BY pid DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $image_url = $row["image_url"];
                    $ptitle = $row["ptitle"];
                    $pdescription = $row["pdescription"];
                    $pid = $row["pid"];
                    ?>
                    <div class="cat-item">
                        <div class="postcatpageimg">
                            <img src="./assets/images/<?php echo $image_url ?>" />
                        </div>
                        <h3>
                            <?php echo $ptitle ?>
                        </h3>
                        <div class="cat-item-descr">
                            <p>
                                <?php echo $pdescription ?>
                            </p>
                        </div>
                        <a href="singlepost.php?pid=<?php echo $pid ?>"> Read More </a>

                    </div>
                    <?php

                }
            }
            $conn->close();
            ?>

        </div>
    </div>

</body>

</html>
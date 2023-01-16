<?php
    if (!isset($_GET['pid'])) {
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
    $pid = $_GET['pid'];
    $sql = "SELECT * FROM post WHERE pid=$pid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $tab_name = $row["ptitle"];
    $conn->close();
    ?>
    <title>
        <?php echo $tab_name ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/navigation.css">
    <link rel="stylesheet" href="./assets/css/singlepostpage.css">

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
      <div class="flex-container">
            <?php
            include 'db_connection.php';
            $sql = "SELECT * FROM post WHERE pid=$pid";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $image_url = $row["image_url"];
                    $ptitle = $row["ptitle"];
                    $pdescription = $row["pdescription"];
                    $post_cat_id = $row["post_cat_id"];
                    ?>

                    <div class="single-post">
                        <h3>
                            <?php echo $ptitle ?>
                        </h3>
                        <img src="./assets/images/<?php echo $image_url ?>">
                        <p>
                            <?php echo $pdescription ?>
                        </p>
                    </div>
                    <div class="sidebar">
                        <h4>Latest Posts</h4>
                        <?php
                        include 'db_connection.php';
                        $sql = "SELECT * FROM post ORDER BY pid DESC LIMIT 4";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $image_url = $row["image_url"];
                                $ptitle = $row["ptitle"];
                                $pdescription = $row["pdescription"];
                                ?>
                            <div class="sidebar-card">
                            <img src="./assets/images/<?php echo $image_url ?>">
                            <h2><?php echo $ptitle?></h2>
                            <p><?php echo $pdescription?></p>
                            <a href="singlepost.php?pid=<?php echo $row["pid"]?>">Read More</a>
                            </div>
                            <?php
                            }
                        }
                        ?>
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
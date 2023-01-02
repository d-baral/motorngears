<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MotorNGears</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/navigation.css">
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
                    <a href=#><?php echo "$menu_name" ?></a>
                    <?php
                        }
                    }
                    $conn->close();
                    ?>
                    <a class="log-btn" href="login.php">LOGIN</a>
                </li>
                </div>
            </ul>
        </nav>
    </header>
    <div class="main-container">


        <?php
        include 'db_connection.php';
        $sql1 = "SELECT * FROM post  ORDER BY pid DESC";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $post_cat_id = $row["post_cat_id"];
                $pdescription = $row["pdescription"];
                $image_url = $row["image_url"];
        ?>
        <div class="news-section">
            <div class="flex">
                <div class="title"><?php echo $row["ptitle"] ?> </div>
                <div class="topic">
                    <a href="#">
                        <?php
                                $sql2 = "SELECT * FROM post_category";
                                $result2 = $conn->query($sql2);
                                if ($result2->num_rows > 0) {
                                    while ($row = $result2->fetch_assoc()) {
                                        if ($post_cat_id == $row["cid"]) {
                                            echo $row["cname"];
                                        }
                                    }
                                }
                                ?>
                    </a>
                </div>

            </div>
            <div class="feature">
                <img src="./assets/images/<?php echo $image_url ?>" />
            </div>

            <div class="news">
                <p>
                    <?php
                            echo $pdescription;
                            ?>
                </p>
            </div>
            <div class="left-flex">
                <button class="read-more">
                    <a href="singlepost.php">READ MORE</a>
                </button>

            </div>

        </div>
        <?php
            }
        }
        ?>
    </div>

</body>

</html>
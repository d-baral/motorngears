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
    <link rel="stylesheet" href="./assets/css/index.css">
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
    <div class="news-container">
        <?php
        include 'db_connection.php';
        $sql1 = "SELECT * FROM post";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            
        ?>   
        <div class="left-news-container">
            <?php 
            $counter=0;
            while ($row = $result1->fetch_assoc()) {
                $counter++;
                if($counter==1)
                {
                    ?>
                    <div class="left-feature-img">
                    <img src="./assets/images/<?php echo $row["image_url"] ?>" />
            </div>
            <div class="left-title">
                <?php echo $row["ptitle"] ?>
            </div>
            <div class="left-news">
            <?php echo $row["pdescription"] ?>
            
            </div>
            <button class="read-more">
                            <a href="singlepost.php?pid=<?php echo $row["pid"] ?>">READ MORE</a>
                        </button>
                    <?php
                }
                
            }
        }
            ?>
    </div>
        <div class="right-news-container">
        <?php 
                $sql2 = "SELECT * FROM post  ORDER BY pid DESC LIMIT 4";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    
             
            while ($row = $result2->fetch_assoc()) {
                ?>
                <div class="news">
                <div class="right-feature-img">
                <img src="./assets/images/<?php echo $row["image_url"] ?>" />
                </div>
                <div class="news-details">
                    <div class="right-title">
                    <a href="singlepost.php?pid=<?php echo $row["pid"] ?>"><?php echo $row["ptitle"]?></a>
            </div>
                    <div class="right-news">
                        <?php echo $row["pdescription"]?>
                    </div>
                </div>
            </div>
                <?php
            }
        }
            ?>
        </div>   
    </div>


<div class="clear"></div>
    <div class="index-main-container">
        <?php
        include 'db_connection.php';
        $sql1 = "SELECT * FROM post  ORDER BY pid DESC";
        $result1 = $conn->query($sql1);
        
        if($result1-> num_rows>0)
        {
            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    $pid = $row["pid"];
                    $post_cat_id = $row["post_cat_id"];
                    $pdescription = $row["pdescription"];
                    $image_url = $row["image_url"];
                    ?>
                    <div class="news-section">
                        <div class="flex">
                            <div class="title"><?php echo $row["ptitle"] ?> </div>
                            <div class="topic">
                                <a href="singlecategorypage.php?cid=<?php echo $post_cat_id ?>">
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
                                <a href="singlepost.php?pid=<?php echo $pid ?>">READ MORE</a>
                            </button>
    
                        </div>
    
                    </div>
                    <?php
                }
            }
        }
            ?>
    </div>

</body>

</html>
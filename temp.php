if ($result1->num_rows > 5) {
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








        <?php 
$post_counter=0;
 while ($row = $result1->fetch_assoc()) {
    $post_counter++;
    $pid = $row["pid"];
    $post_cat_id = $row["post_cat_id"];
    $pdescription = $row["pdescription"];
    $image_url = $row["image_url"];
    if($post_counter==1)
    {
        ?>
        <div class="left-news-container">
<div class="left-feature-img">
<img src="./assets/images/<?php echo $image_url ?>" />

</div>
<div class="left-title">
<?php echo $row["ptitle"] ?>
</div>
<div class="left-news">
   <p>
<?php echo $row["pdescription"] ?>

   </p>
</div>
<button class="read-more">
                <a href="singlepost.php?pid=<?php echo $pid ?>">READ MORE</a>
            </button>
</div>
        <?php
    }
      ?>
    
    <?php
}
?>
    <?php
}


        
?>

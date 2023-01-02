<?php
if(isset($_POST['add_post_button']) && isset($_FILES['feat_image']))
{
    echo "Image Trial";
    echo "<pre>";
    print_r($_FILES['feat_image']);
    echo "</pre>";

    $img_name=$_FILES['feat_image']['name'];
    $img_size=$_FILES['feat_image']['size'];
    $tmp_name=$_FILES['feat_image']['tmp_name'];
    $error=$_FILES['feat_image']['error'];

    if ($error === 0)
    {
        if ($img_size>125000)
        {
            $message = "File if too large";
            header("location: newpost.php?error=$em");
        }
        else
        {
            $image_extension=pathinfo($img_name, PATHINFO_EXTENSION);
            $image_extension_lowercase=strtolower($image_extension);
            $allowed_extenion=array("jpg", "jpeg", "png");

            if(in_array($image_extension_lowercase, $allowed_extenion))
            {
                $new_img_name = uniqid("IMG-",true).'.'.$image_extension_lowercase;
                $image_upload_path='assets/images/'.$new_img_name;
                move_uploaded_file($tmp_name,$image_upload_path);
            }
            else
            {
                $message = "Not a valid Image Format";
                header("location: newpost.php?error=$em");
            }
        }
    }
    else
    {
        $message = "Unknown Error Occured!";
        header("location: newpost.php?error=$em");
    }
}
?>
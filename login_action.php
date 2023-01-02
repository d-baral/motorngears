<?php


include 'db_connection.php';

$user = $_POST['user_name'];
$email = $_POST['email'];
$password = $_POST['password'];

//login validation logic
if(isset($_POST['loginbutton']))
{
    session_start();
    $sql = "SELECT uname,upass FROM user";
    $result = $conn->query($sql);
    
    if($result->num_rows>0)
    {
        while($row = $result->fetch_assoc())
        {
            $userid_fetched = $row["uid"];
            $user_fetched = $row["uname"];
            $password_fetched = $row["upass"];
            if($user==$user_fetched && $password==$password_fetched)
            {
                $_SESSION['loginid']= "$userid_fetched";
                header('location:dashboard.php'); 
            }
            else
            { 
                $_SESSION['message']="Invalid Login Details!";
                header('location:login.php');
            }
        }
    }
    $conn->close();
}


//writing data from signup form to database
elseif (isset($_POST['signupbutton']))
{
$sql = "INSERT INTO user(uname,uemail,upass)
VALUES ('$user', '$email', '$password')";

if ($conn->query($sql) === TRUE) {

  $_SESSION['suc_message']="Account Created Succesfully!";
  header('location:signup.php');
  
} else {
  header('location:index.php');
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}


//redirecting to index page if tried to come by entering url directly.
else
{
    header('location:index.php');
}


?>
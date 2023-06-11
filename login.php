<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div  >Password does not match</div>";
                }
            }else{
                echo "<div  >Email does not match</div>";
            }
        }
        ?>
      <form action="login.php" method="post">
        <div >
            <input type="email" placeholder="Enter Email:" name="email" >
        </div>
        <div >
            <input type="password" placeholder="Enter Password:" name="password" >
        </div>
        <div >
            <input type="submit" value="Login" name="login" >
        </div>
      </form>
     <div><p>Not registered yet <a href="registration.php">Register Here</a></p></div>
    </div>
</body>
</html>
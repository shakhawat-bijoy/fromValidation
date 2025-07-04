<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="box form-box">
        <?php 
        include("php/config.php");

        if (isset($_POST['submit'])) {
            $input = mysqli_real_escape_string($con, $_POST['email']); // username or email
            $password = mysqli_real_escape_string($con, $_POST['password']);

            // Check for email or username and password match
            $query = "SELECT * FROM users WHERE (Email='$input' OR Username='$input') AND Password='$password'";
            $result = mysqli_query($con, $query) or die("Select Error");
            $row = mysqli_fetch_assoc($result);

            if (is_array($row) && !empty($row)) {
                $_SESSION['valid'] = $row['Email'];
                $_SESSION['username'] = $row['Username'];
                $_SESSION['age'] = $row['Age'];
                $_SESSION['id'] = $row['Id'];
                header("Location: home.php");
                exit();
            } else {
                echo "<div class='message'>
                        <p>Wrong Username or Password</p>
                      </div><br>";
                echo "<a href='index.php'><button class='btn'>Go Back</button></a>";
            }
        } else {
        ?>
        <header>Login</header>
        <form action="" method="post">
            <div class="field input">
                <label for="email">Username or Email</label>
                <input type="text" name="email" id="email" autocomplete="on" required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" required>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Login">
            </div>
            <div class="links">
                Don't have an account? <a href="register.php">Sign Up Now</a>
            </div>
        </form>
        <?php } ?>
    </div>
</div>
</body>
</html>

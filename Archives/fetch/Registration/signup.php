<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Pratyush">
    <meta name="author" content="Aadil">
    <meta name="author" content="Vidit">
    <title>AirMonke-Register</title>
    <link rel="airline-logo.jpg" type="image/x-icon" href="favicon.ico" />
</head>

<body>
    <h1>SIGN UP</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Submit">
    </form>

    <?php
    $host = "localhost";
    $username = "root";
    $password = "ayush@31";
    $dbname = "ervavia";

    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];

        if ($username && $password && $email) {
            $query = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "Email is already registered with us! Log in instead?";
                echo "<button onclick='window.location.href=\"login.php\";'>Login</button>";
            } else {
                $query = "INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email')";
                if (mysqli_query($conn, $query)) {
                    echo "Hohoho! Your account has been created!";
                    echo "<br><button onclick='window.location.href=\"login.php\";'>Continue</button>";
                } else {
                    echo "[PHP-ERROR-1A]: You account could not be created at this moment...";
                    echo "<button onclick='window.location.href=\"signup.php\";'>Retry</button>";
                }
            }
        } else {
            echo "[PHP-ERROR-1B]: Voila! You spotted a bug! Report to customer support for a free flight ticket!";
        }
    }
    mysqli_close($conn);
    ?>

</body>

</html>
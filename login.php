<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fundraising_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "<script>
                sessionStorage.setItem('username', '$username');
                window.location.href = 'index.php';
            </script>";
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/navbar/logo.png" alt="Logo">
            <h2>FundAidHub</h2>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="campaigns.php">Campaigns</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </nav>
        <div class="login-button">
            <a href="login.php" class="button">Login</a>
        </div>
    </header>
    <main>
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login" class="button">
        </form>
        
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </main>
    <footer>
        <p>&copy; 2024 FundAidHub. All rights reserved.</p>
    </footer>
</body>
</html>

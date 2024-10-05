<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FundAidHub</title>
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
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="campaigns.php">Campaigns</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </nav>
        <div class="login-button">
            <?php if (isset($_SESSION['username'])): ?>
                <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="button">Logout</a>
            <?php else: ?>
                <a href="login.php" class="button">Login</a>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <section class="home">
            <div class="container">
                <div class="home-content">
                    <h1>Make an Impact, Share the Love<br> Your support makes a difference</h1>
                    <a href="campaigns.php" class="btn">Donate Now</a>
                </div>
            </div>
        </section>

        <section class="about-us">
            <div class="about-text">
                <h2>About Us</h2>
                <p>Welcome to FundAidHub, where compassion meets action. We are dedicated to empowering individuals and organizations to create positive change in communities worldwide.</p>
                <p>At FundAidHub, transparency, integrity, and innovation are at the core of what we do. We connect donors with impactful causes, making it easy to contribute to initiatives that matter most.</p>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 FundAidHub. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
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
                <li><a href="categories.php" class="active">Categories</a></li>
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
        <h1>Categories</h1>
        <p>Browse campaigns by category.</p>

        <div class="category-container">
            <a href="health.php" class="category-link">
                <div class="category-box">
                    <img src="img/categories/health.png" alt="Category 1">
                    <h3>Health</h3>
                </div>
            </a>

            <a href="education.php" class="category-link">
                <div class="category-box">
                    <img src="img/categories/ed.png" alt="Category 2">
                    <h3>Education</h3>
                </div>
            </a>

            <a href="animals.php" class="category-link">
                <div class="category-box">
                    <img src="img/categories/animals.png" alt="Category 3">
                    <h3>Animals</h3>
                </div>
            </a>

            <a href="environment.php" class="category-link">
                <div class="category-box">
                    <img src="img/categories/env.png" alt="Category 4">
                    <h3>Environment</h3>
                </div>
            </a>

            <a href="community.php" class="category-link">
                <div class="category-box">
                    <img src="img/categories/com.png" alt="Category 5">
                    <h3>Community</h3>
                </div>
            </a>

            <a href="arts.php" class="category-link">
                <div class="category-box">
                    <img src="img/categories/art.png" alt="Category 6">
                    <h3>Arts & Culture</h3>
                </div>
            </a>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 FundAidHub. All rights reserved.</p>
    </footer>
</body>
</html>

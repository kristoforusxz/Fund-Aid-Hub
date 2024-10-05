<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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
                <li><a href="about.php" class="active">About</a></li>
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
        <section class="main-image">
            <img src="img/about/about.jpg" alt="About Image">
        </section>
        <section class="about-section">
            <div class="about-text">
                <h1>About Us</h1>
                <p>Welcome to FundAidHub, where compassion meets action. We are dedicated to empowering individuals and organizations to create positive change in communities worldwide.</p>
                <h2>Our Vision</h2>
                <p>To build a world where every person's basic needs are met, and every community thrives through collective support and solidarity.</p>
                <h2>Our Mission</h2>
                <p>Our mission is to provide a transparent and effective platform that connects donors with impactful causes, making it easy to contribute to initiatives that matter most.</p>
                <h2>Core Values</h2>
                <ul>
                    <li>Compassion: We act with empathy and kindness towards all.</li>
                    <li>Integrity: We uphold honesty, transparency, and accountability.</li>
                    <li>Innovation: We embrace creativity and continuous improvement.</li>
                    <li>Community: We foster collaboration and support among diverse communities.</li>
                    <li>Impact: We strive for meaningful outcomes and sustainable change.</li>
                </ul>

                <div class="team-section">
                    <h2>Our Team</h2>
                    <div class="team-member">
                        <img src="img/team/member1.jpg" alt="Team Member 1">
                        <h3>Samuel</h3>
                        <p>AOL SE</p>
                    </div>
                    <div class="team-member">
                        <img src="img/team/member2.jpg" alt="Team Member 2">
                        <h3>Jason</h3>
                        <p>AOL SE</p>
                    </div>
                    <div class="team-member">
                        <img src="img/team/member3.jpg" alt="Team Member 3">
                        <h3>Bernard</h3>
                        <p>AOL SE</p>
                    </div>
                    <div class="team-member">
                        <img src="img/team/member4.jpg" alt="Your Photo">
                        <h3>Kris</h3>
                        <p>AOL SE</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 FundAidHub. All rights reserved.</p>
    </footer>

    <script src="scripts/main.js"></script>
</body>
</html>

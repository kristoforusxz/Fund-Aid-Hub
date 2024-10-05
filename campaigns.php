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

$active_campaigns = [];
$completed_campaigns = [];

$sql_active = "SELECT * FROM campaigns WHERE current_donation < target_donation";
$result_active = $conn->query($sql_active);

if ($result_active->num_rows > 0) {
    while ($row = $result_active->fetch_assoc()) {
        $active_campaigns[] = $row;
    }
}

$sql_completed = "SELECT * FROM campaigns WHERE current_donation >= target_donation";
$result_completed = $conn->query($sql_completed);

if ($result_completed->num_rows > 0) {
    while ($row = $result_completed->fetch_assoc()) {
        $completed_campaigns[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaigns</title>
    <link rel="stylesheet" href="styles/styles.css">
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
                <li><a href="campaigns.php" class="active">Campaigns</a></li>
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
        <h1>Our Campaigns</h1>
        <p>Explore our active campaigns and find one to support.</p>
        
        <div class="campaigns-container">
            <?php foreach ($active_campaigns as $campaign): ?>
                <div class="campaign-box">
                    <img src="<?php echo htmlspecialchars($campaign['image']); ?>" alt="Campaign Image">
                    <div class="campaign-details">
                        <h3><?php echo htmlspecialchars($campaign['title']); ?></h3>
                        <p>Category: <?php echo htmlspecialchars($campaign['category']); ?></p>
                        <p>Target Donation: $<?php echo number_format($campaign['target_donation']); ?></p>
                        <div class="progress-bar">
                            <div class="progress" style="width: <?php echo ($campaign['current_donation'] / $campaign['target_donation']) * 100; ?>%;"></div>
                        </div>
                        <p>Current Donation: $<?php echo number_format($campaign['current_donation']); ?></p>
                        <a href="campaign_details.php?id=<?php echo $campaign['id']; ?>" class="button">Donate</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <h1>Finished Campaigns</h1>
        <div class="done-campaigns-container">
            <?php foreach ($completed_campaigns as $campaign): ?>
                <div class="done-campaign-box">
                    <img src="<?php echo htmlspecialchars($campaign['image']); ?>" alt="Campaign Image">
                    <div class="campaign-details">
                        <h3><?php echo htmlspecialchars($campaign['title']); ?></h3>
                        <p>Category: <?php echo htmlspecialchars($campaign['category']); ?></p>
                        <p>Target Donation: $<?php echo number_format($campaign['target_donation']); ?></p>
                        <div class="progress-bar">
                            <div class="progress" style="width: 100%;"></div>
                        </div>
                        <p>Current Donation: $<?php echo number_format($campaign['current_donation']); ?></p>
                        <p class="campaign-status">Campaign Completed</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    
    <footer>
        <p>&copy; 2024 FundAidHub. All rights reserved.</p>
    </footer>
</body>
</html>

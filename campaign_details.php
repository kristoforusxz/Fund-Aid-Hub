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

if (isset($_GET['id'])) {
    $campaign_id = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT * FROM campaigns WHERE id = ?");
    $stmt->bind_param("i", $campaign_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $campaign = $result->fetch_assoc();
    } else {
        echo "<p>Campaign not found.</p>";
        exit;
    }

    $stmt->close();
} else {
    echo "<p>No campaign selected.</p>";
    exit;
}

$conn->close();

$donation_success = false;
if (isset($_SESSION['donation_success']) && $_SESSION['donation_success'] === true) {
    $donation_success = true;
    unset($_SESSION['donation_success']); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign Details</title>
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
        <div class="campaign-details-page">
            <img src="<?php echo htmlspecialchars($campaign['image']); ?>" alt="Campaign Image">
            <div class="campaign-details">
                <h1><?php echo htmlspecialchars($campaign['title']); ?></h1>
                <p>Category: <?php echo htmlspecialchars($campaign['category']); ?></p>
                <p>Target Donation: $<?php echo number_format($campaign['target_donation']); ?></p>
                <div class="progress-bar">
                    <div class="progress" style="width: <?php echo ($campaign['current_donation'] / $campaign['target_donation']) * 100; ?>%;"></div>
                </div>
                <p>Current Donation: $<?php echo number_format($campaign['current_donation']); ?></p>
                <p><?php echo htmlspecialchars($campaign['description']); ?></p>
                
                <?php if ($donation_success): ?>
                    <div class="notification success">
                        Donation successful!
                    </div>
                <?php endif; ?>
                
                <form action="donate.php" method="post" class="donation-form">
                    <input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>">
                    <label for="donation-amount">Donation Amount ($):</label>
                    <input type="number" id="donation-amount" name="donation_amount" min="1" required>
                    <button type="submit" class="button">Donate</button>
                </form>
            </div>  
        </div>
    </main>
    <footer>
        <p>&copy; 2024 FundAidHub. All rights reserved.</p>
    </footer>
</body>
</html>

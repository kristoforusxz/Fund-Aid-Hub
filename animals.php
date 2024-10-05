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

$category = "Animals"; 
$stmt = $conn->prepare("SELECT * FROM campaigns WHERE category = ?");
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

$campaigns = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $campaigns[] = $row;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals Campaigns</title>
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
                <li><a href="campaigns.php">Campaigns</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </nav>
        <div class="login-button">
            <?php if (isset($_SESSION['username'])): ?>
                <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="../logout.php" class="button">Logout</a>
            <?php else: ?>
                <a href="../login.php" class="button">Login</a>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <h1>Animals Campaigns</h1>
        <p>Explore campaigns related to animals.</p>

        <div class="campaign-container">
            <?php foreach ($campaigns as $campaign): ?>
                <div class="campaign-box">
                    <img src="<?php echo htmlspecialchars($campaign['image']); ?>" alt="Campaign Image">
                    <h3><?php echo htmlspecialchars($campaign['title']); ?></h3>
                    <p>Target Donation: $<?php echo number_format($campaign['target_donation']); ?></p>
                    <p>Current Donation: $<?php echo number_format($campaign['current_donation']); ?></p>
                    <a href="campaign_details.php?id=<?php echo htmlspecialchars($campaign['id']); ?>" class="button">Donate</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 FundAidHub. All rights reserved.</p>
    </footer>
</body>
</html>

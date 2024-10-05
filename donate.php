<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['campaign_id']) && isset($_POST['donation_amount'])) {
        $campaign_id = intval($_POST['campaign_id']);
        $donation_amount = floatval($_POST['donation_amount']);


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "fundraising_project";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("UPDATE campaigns SET current_donation = current_donation + ? WHERE id = ?");
        $stmt->bind_param("di", $donation_amount, $campaign_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['donation_success'] = true;
        }

        $stmt->close();
        $conn->close();

        header("Location: campaign_details.php?id=$campaign_id");
        exit;
    } else {
        echo "Invalid donation submission.";
        exit;
    }
} else {
    echo "Method not allowed.";
    exit;
}
?>

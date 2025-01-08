<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'digital_boards';
$username = 'root';
$password = '';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Count the total number of orders (count of IDs)
    $sql = "SELECT COUNT(id) AS total_orders FROM adds";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalOrders = $result['total_orders'] ?? 0; // Default to 0 if no records found

    // Calculate the total of total_price
    $sql = "SELECT SUM(total_price) AS total_price_sum FROM adds";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalPriceSum = $result['total_price_sum'] ?? 0; // Default to 0 if no records found

    // Calculate the average of total_price
    $sql = "SELECT AVG(total_price) AS average_price FROM adds";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $averagePrice = $result['average_price'] ?? 0; // Default to 0 if no records found

    // Check if ID is passed via GET
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']); // Sanitize the ID input

        // Fetch record by ID
        $sql = "SELECT * FROM adds WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Check if a record is found
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            die('Invoice not found for the given ID.');
        }
    } else {
        $data = null; // Set data to null if no ID is passed
    }
} catch (PDOException $e) {
    die('Database Error: ' . $e->getMessage());
}
?>

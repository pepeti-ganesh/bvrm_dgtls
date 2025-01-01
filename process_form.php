<?php
// Database connection parameters
$host = 'localhost'; // Replace with your host (e.g., 'localhost')
$dbname = 'digital_boards'; // Replace with your database name
$username = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password

// Create a PDO instance for MySQL
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error handling
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage()); // Error message if connection fails
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $gst = htmlspecialchars($_POST['gst']);
    $boards = htmlspecialchars($_POST['boards']); // Fixed missing parenthesis
    $duration = (int) $_POST['duration'];
    $months = (int) $_POST['months'];
    $start_date = htmlspecialchars($_POST['start-date']);
    $end_date = htmlspecialchars($_POST['end-date']);
    $cycles = (int) $_POST['cycles'];
    $total-output = (int) $_POST['total-output'];
    // Price calculation logic
    $pricePerBoard = 0;
    switch ($boards) {
        case 1: // Combo boards
            $pricePerBoard = 2000;
            break;
        case 2: // 8/10 feet boards
            $pricePerBoard = 1500;
            break;
        case 3: // 10/16 feet boards
            $pricePerBoard = 2500;
            break;
        default:
            $pricePerBoard = 0; // Default case
            break;
    }

    // Price per month calculation logic
    $pricePerMonth = 0;
    switch ($duration) {
        case 20:
            $pricePerMonth = 1000;
            break;
        case 30:
            $pricePerMonth = 1200;
            break;
        case 50:
            $pricePerMonth = 1500;
            break;
        default:
            $pricePerMonth = 0;
            break;
    }

    // Calculate the total price
    $totalPrice = $pricePerBoard * $pricePerMonth * $months * $cycles;

    // SQL query to insert form data into the 'adds' table
    $sql = "INSERT INTO adds (name, gst, boards, duration, months, start_date, end_date, cycles, total_price)
            VALUES (:name, :gst, :boards, :duration, :months, :start_date, :end_date, :cycles, :total_price)";

    try {
        // Prepare and execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':gst' => $gst,
            ':boards' => $boards,
            ':duration' => $duration,
            ':months' => $months,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':cycles' => $cycles,
            ':total_price' => $total-output
        ]);


    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>"; // Error message if insertion fails
    }
}
?>
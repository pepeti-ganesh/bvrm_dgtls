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


    // Function to fetch a record from the 'adds' table by ID
    function getAddById($pdo, $id) {
        if (is_numeric($id)) {
            $id = intval($id); // Sanitize the ID input
            $sql = "SELECT * FROM adds WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return null; // No data found
            }
        }
        return null; // Invalid ID
    }

    // Function to fetch all expenses
    function fetchExpenses($pdo) {
        $sql = "SELECT * FROM expenses";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Function to generate table rows for expenses
    function generateExpenseTableRows($expenses) {
        if (!empty($expenses)) {
            foreach ($expenses as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['bill']) . "</td>";
                echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10' class='text-center'>No data found</td></tr>";
        }
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
}
} catch (PDOException $e) {
    die('Database Error: ' . $e->getMessage());
}
?>

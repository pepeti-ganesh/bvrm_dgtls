<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'digital_boards';
$username = 'root';
$password = '';

try {
    // Create a PDO instance for MySQL
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
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

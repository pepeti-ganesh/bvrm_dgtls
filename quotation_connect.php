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

    // Function to fetch monthly expenses
    function fetchMonthlyExpenses($pdo) {
        $monthlyExpenses = [];
        $sql = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, SUM(amount) AS total_amount
                FROM expenses
                GROUP BY month
                ORDER BY month";

        try {
            $stmt = $pdo->query($sql);
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $monthlyExpenses[$row['month']] = $row['total_amount'];
                }
            }
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
        }

        return $monthlyExpenses;
    }

    // Function to fetch recent adds
    function fetchRecentAdds($pdo, $limit = 10) {
        $recentAdds = [];
        $sql = "SELECT * FROM adds ORDER BY id DESC LIMIT :limit";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $recentAdds = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
        }

        return $recentAdds;
    }

    // Function to insert a new quotation
    function insertQuotation($pdo, $data) {
        $sql = "INSERT INTO adds (name, gst, boards, duration, months, start_date, end_date, cycles, total_price)
                VALUES (:name, :gst, :boards, :duration, :months, :start_date, :end_date, :cycles, :total_price)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
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
    die('Database Error: ' . $e->getMessage());
}
?>

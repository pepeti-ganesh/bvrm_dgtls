<?php
// Include the database connection file
include 'connect.php';

// Function to fetch a record from the 'adds' table by ID
function getAddById($conn, $id) {
    if (is_numeric($id)) {
        $id = intval($id); // Sanitize the ID input
        $sql = "SELECT * FROM adds WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null; // No data found
        }
    }
    return null; // Invalid ID
}

// Function to fetch all expenses
function fetchExpenses($conn) {
    $sql = "SELECT * FROM expenses";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to fetch monthly expenses
function fetchMonthlyExpenses($conn) {
    $monthlyExpenses = [];
    $sql = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, SUM(amount) AS total_amount
            FROM expenses
            GROUP BY month
            ORDER BY month";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $monthlyExpenses[$row['month']] = $row['total_amount'];
        }
    }

    return $monthlyExpenses;
}

// Function to fetch recent adds
function fetchRecentAdds($conn, $limit = 10) {
    $recentAdds = [];
    $sql = "SELECT * FROM adds ORDER BY id DESC LIMIT ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $recentAdds = $result->fetch_all(MYSQLI_ASSOC);

    return $recentAdds;
}

// Function to insert a new quotation
function insertQuotation($pdo, $data) {
    $sql = "INSERT INTO adds (name, gst, boards, duration, months, start_date, end_date, cycles, total_price)
            VALUES (:name, :gst, :boards, :duration, :months, :start_date, :end_date, :cycles, :total_price)";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ':name' => $data[':name'],
        ':gst' => $data[':gst'],
        ':boards' => $data[':boards'],
        ':duration' => $data[':duration'],
        ':months' => $data[':months'],
        ':start_date' => $data[':start_date'],
        ':end_date' => $data[':end_date'],
        ':cycles' => $data[':cycles'],
        ':total_price' => $data[':total_price']
    ]);
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

?>

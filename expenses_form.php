<?php
// Database connection
include 'connect.php';

// Initialize variables
$message = "";

// Function to handle form submission
function handleFormSubmission($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);

        // Handle file upload
        $bill = $_FILES['bill'];
        $billName = $bill['name'];
        $billTmpName = $bill['tmp_name'];
        $billType = $bill['type'];

        // Allowed file types
        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

        if (in_array($billType, $allowedTypes)) {
            // Read the file content
            $billContent = file_get_contents($billTmpName);

            // Insert data into the database
            $sql = "INSERT INTO expenses (title, description, date, bill_content, bill_type, amount)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $title, $description, $date, $billContent, $billType, $amount);

            if ($stmt->execute()) {
                // Close the statement
                $stmt->close();

                // Redirect to prevent form resubmission
                header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                exit;
            } else {
                $error = "Error: " . $stmt->error;
                $stmt->close();
                return $error;
            }
        } else {
            return "Invalid file type. Only PDF, JPG, PNG, JPEG, and GIF files are allowed.";
        }
    }
    return "";
}

// Function to fetch all expenses
function fetchAllExpenses($conn) {
    $sql = "SELECT id, title, description, date, bill_content, bill_type, amount FROM expenses";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to handle bill download
function handleBillDownload($conn) {
    if (isset($_GET['download_id'])) {
        $id = intval($_GET['download_id']);

        // Fetch the bill content and type from the database
        $sql = "SELECT bill_content, bill_type FROM expenses WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $billContent = null;
        $billType = null;
        $stmt->bind_result($billContent, $billType);
        $stmt->fetch();

        if ($billContent) {
            // Set headers for file download
            header("Content-Type: " . $billType);
            header("Content-Disposition: attachment; filename=bill_" . $id);

            // Output the file content
            echo $billContent;
            exit;
        } else {
            echo "Bill not found.";
            exit;
        }
    }
}

// Handle bill download if requested
handleBillDownload($conn);

// Handle form submission
$message = handleFormSubmission($conn);

// Fetch all expenses
$expenses = fetchAllExpenses($conn);

// Close connection
$conn->close();
?>

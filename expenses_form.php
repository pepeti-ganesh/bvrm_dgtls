<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digital_boards";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    // Handle file upload
    $bill = $_FILES['bill'];
    $billName = $bill['name'];
    $billTmpName = $bill['tmp_name'];
    $billSize = $bill['size'];
    $billError = $bill['error'];
    $billType = $bill['type'];

    // Allowed file types (PDF, JPG, PNG, JPEG, GIF)
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

    if (in_array($billType, $allowedTypes)) {
        $billExtension = pathinfo($billName, PATHINFO_EXTENSION);
        $newBillName = uniqid('bill_', true) . '.' . $billExtension; // Unique file name
        $billDestination = 'uploads/' . $newBillName;

        if (move_uploaded_file($billTmpName, $billDestination)) {
            // Insert data into the database
            $sql = "INSERT INTO expenses (title, description, date, bill, amount)
                    VALUES ('$title', '$description', '$date', '$billDestination', '$amount')";

            if ($conn->query($sql) === TRUE) {
                echo "Expense recorded successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Failed to upload bill. Please try again.";
        }
    } else {
        echo "Invalid file type. Only PDF, JPG, PNG, JPEG, and GIF files are allowed.";
    }
}

// Close connection
$conn->close();
?>

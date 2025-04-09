<?php
// Include database connection
include 'connect.php';

// Initialize variables
$message = "";

// Function to create table if not exists
function createClientsTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS clients (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        product_name VARCHAR(255) NOT NULL
    )";
    $conn->query($sql);
}

// Create clients table
createClientsTable($conn);

// Function to handle form submission
function handleFormSubmission($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);

        // Insert data into the database
        $sql = "INSERT INTO clients (name, location, product_name) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $location, $product_name);

        if ($stmt->execute()) {
            // Redirect to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            $stmt->close();
            exit;
        } else {
            $stmt->close();
            return "Error: " . $stmt->error;
        }
    }
    return "";
}

// Function to handle AJAX updates
function handleAjaxUpdate($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['id']) && !empty($data['id'])) {
            $id = $data['id'];
            $name = $conn->real_escape_string($data['name']);
            $location = $conn->real_escape_string($data['location']);
            $product_name = $conn->real_escape_string($data['product_name']);

            $sql = "UPDATE clients SET name = '$name', location = '$location', product_name = '$product_name' WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                // Return the updated client data
                echo json_encode([
                    'success' => true,
                    'updatedClient' => [
                        'id' => $id,
                        'name' => $name,
                        'location' => $location,
                        'product_name' => $product_name
                    ]
                ]);
            } else {
                echo json_encode(['success' => false, 'error' => $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid data']);
        }
        exit;
    }
}

// Function to fetch all clients
function fetchAllClients($conn) {
    $sql = "SELECT id, name, location, product_name FROM clients";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Handle AJAX updates
handleAjaxUpdate($conn);

// Handle form submission
$message = handleFormSubmission($conn);

// Fetch all clients
$clients = fetchAllClients($conn);

// Close connection
$conn->close();
?>

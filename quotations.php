<?php
// Include the database connection file
include 'connect.php';

// Handle form submission
$submissionSuccess = false; // Flag to track successful submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $gst = htmlspecialchars($_POST['gst']);
    $boards = htmlspecialchars($_POST['boards']);
    $duration = (int)$_POST['duration'];
    $months = (int)$_POST['months'];
    $start_date = htmlspecialchars($_POST['start-date']);
    $end_date = htmlspecialchars($_POST['end-date']);
    $cycles = (int)$_POST['cycles'];
    $totalPrice = (int)$_POST['total-price']; // Retrieve the total price from the form

    // Insert data into database
    $sql = "INSERT INTO adds (name, gst, boards, duration, months, start_date, end_date, cycles, total_price)
            VALUES (:name, :gst, :boards, :duration, :months, :start_date, :end_date, :cycles, :total_price)";
    try {
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
            ':total_price' => $totalPrice // Use the total price from the form
        ]);

        $submissionSuccess = true; // Set the success flag if insertion is successful
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }

    // Explicitly release resources
    $stmt = null;
}
?>


<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
<head>
    <?php include 'head.php'; ?>
    <script>
     document.addEventListener("DOMContentLoaded", () => {
        // Check if the form was submitted successfully
        <?php if ($submissionSuccess): ?>
            alert("Quotation added successfully!");
        <?php endif; ?>

        const form = document.getElementById("quotation-form");
        const totalOutput = document.getElementById("total-output");
        const durationField = document.getElementById("duration");
        const monthsField = document.getElementById("months");
        const cyclesField = document.getElementById("cycles");
        const boardsField = document.getElementById("boards");
        const startDateField = document.getElementById("start-date");
        const endDateField = document.getElementById("end-date");

        // Calculate total money
        function calculateTotal() {
    const duration = parseInt(monthsField.value, 10); // Duration in months (1, 3, or 6)
    const boards = boardsField.value; // Selected board type

    let total = 0;

    // Pricing logic
    if (boards === "Combo") {
        if (duration === 1) total = 8000;
        else if (duration === 3) total = 18000;
        else if (duration === 6) total = 30000;
    } else if (boards === "8/10 ASR Nagar") {
        if (duration === 1) total = 3000;
        else if (duration === 3) total = 7500;
        else if (duration === 6) total = 12000;
    } else if (boards === "10/16 Bombay Sweets") {
        if (duration === 1) total = 5000;
        else if (duration === 3) total = 13500;
        else if (duration === 6) total = 24000;
    }

    // Display the total
    if (total > 0) {
        totalOutput.textContent = `Total Money: ₹${total}`;
        document.getElementById("total-price").value = total; // Update hidden input
    } else {
        totalOutput.textContent = "Invalid selection. Please check your inputs.";
        document.getElementById("total-price").value = 0; // Reset hidden input
    }

    return total;
}



        // Calculate end date
        function calculateEndDate() {
            const startDate = new Date(startDateField.value);
            const months = parseInt(monthsField.value, 10);

            if (!isNaN(startDate.getTime()) && !isNaN(months)) {
                const endDate = new Date(startDate);
                endDate.setMonth(endDate.getMonth() + months);
                endDateField.value = endDate.toISOString().split('T')[0];
            } else {
                endDateField.value = "";
            }
        }

        // Event listeners
        durationField.addEventListener("change", calculateTotal);
        monthsField.addEventListener("change", () => {
            calculateTotal();
            calculateEndDate();
        });
        cyclesField.addEventListener("change", calculateTotal);
        boardsField.addEventListener("change", calculateTotal);
        startDateField.addEventListener("change", calculateEndDate);
    });
    </script>
</head>
<body>
    <section class="body">
        <?php include 'header.php'; ?>
        <div class="inner-wrapper">
            <?php include 'leftsidebar.php'; ?>
            <section role="main" class="content-body content-body-modern">
                <header class="page-header page-header-left-inline-breadcrumb">
                    <h2 class="font-weight-bold text-6">Quotations</h2>
                    <div class="right-wrapper">
                        <ol class="breadcrumbs">
                            <li><span>Home</span></li>
                            <li><span>Quotations</span></li>
                        </ol>
                        <a class="sidebar-right-toggle" data-open="sidebar-right">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </div>
                </header>

                <div class="row">
                <div class="col-lg-6">
    <form id="quotation-form" class="form-horizontal form-bordered" method="POST">
        <section class="card">
            
            <div class="card-body">
                <!-- Name -->
                <div class="form-group row pb-3">
                    <label for="name" class="col-sm-4 control-label text-sm-end pt-2">Name:</label>
                    <div class="col-sm-8">
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                </div>

                <!-- GST -->
                <div class="form-group row pb-3">
                    <label for="gst" class="col-sm-4 control-label text-sm-end pt-2">GST:</label>
                    <div class="col-sm-8">
                        <input type="text" id="gst" name="gst" class="form-control">
                    </div>
                </div>

                <!-- Boards -->
                <div class="form-group row pb-3">
                    <label for="boards" class="col-sm-4 control-label text-sm-end pt-2">Boards:</label>
                    <div class="col-sm-8">
                        <select id="boards" name="boards" class="form-control" required>
                            <option value="">Select boards</option>
                            <option value="Combo">Combo</option>
                            <option value="8/10 ASR Nagar">8/10 ASR Nagar</option>
                            <option value="10/16 Bombay Sweets">10/16 Bombay Sweets</option>
                        </select>
                    </div>
                </div>

                <!-- Duration -->
                <div class="form-group row pb-3">
                    <label for="duration" class="col-sm-4 control-label text-sm-end pt-2">Duration:</label>
                    <div class="col-sm-8">
                        <select id="duration" name="duration" class="form-control" required>
                            <option value="">Select duration</option>
                            <option value="20">20 seconds</option>
                            <option value="30">30 seconds</option>
                            <option value="50">50 seconds</option>
                        </select>
                    </div>
                </div>

                <!-- Months -->
                <div class="form-group row pb-3">
                    <label for="months" class="col-sm-4 control-label text-sm-end pt-2">Months:</label>
                    <div class="col-sm-8">
                        <select id="months" name="months" class="form-control" required>
                            <option value="1">1 month</option>
                            <option value="3">3 months</option>
                            <option value="6">6 months</option>
                            <option value="12">12 months</option>
                        </select>
                    </div>
                </div>

                <!-- Start Date -->
                <div class="form-group row pb-3">
                    <label for="start-date" class="col-sm-4 control-label text-sm-end pt-2">Start Date:</label>
                    <div class="col-sm-8">
                        <input type="date" id="start-date" name="start-date" class="form-control" required>
                    </div>
                </div>

                <!-- End Date -->
                <div class="form-group row pb-3">
                    <label for="end-date" class="col-sm-4 control-label text-sm-end pt-2">End Date:</label>
                    <div class="col-sm-8">
                        <input type="date" id="end-date" name="end-date" class="form-control" readonly>
                    </div>
                </div>

                <!-- Cycles -->
                <div class="form-group row pb-3">
                    <label for="cycles" class="col-sm-4 control-label text-sm-end pt-2">Cycles:</label>
                    <div class="col-sm-8">
                        <select id="cycles" name="cycles" class="form-control" required>
                            <option value="50">50 cycles</option>
                            <option value="100">100 cycles</option>
                        </select>
                    </div>
                </div>

<!-- Total Output -->
<div class="form-group row pb-3">
    <label class="col-sm-4 control-label text-sm-end pt-2">Total:</label>
    <div class="col-sm-8">
        <div id="total-output" class="form-control-static">Total Money: ₹0</div>
        <input type="hidden" id="total-price" name="total-price" value="0">
    </div>
</div>

            </div>

            <footer class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </footer>
        </section>
    </form>
</div>

                </div>
            </section>
        </div>
        <?php include 'rightsidebar.php'; ?>
    </section>

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>

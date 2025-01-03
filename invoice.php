<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
	<head>
    <?php include 'head.php'; ?>
		
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
		<?php include 'header.php'; ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include 'leftsidebar.php'; ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body content-body-modern">
					<header class="page-header page-header-left-inline-breadcrumb">
						<h2 class="font-weight-bold text-6">Invoices</h2>
						<div class="right-wrapper">
							<ol class="breadcrumbs">

								<li><span>Home</span></li>

								<li><span>Invoices</span></li>

							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
<script>
function generateInvoice(rowData) {
    // Parse the row data (already passed as JSON from PHP)
    const data = rowData;

    // Create a new window or tab for the invoice
    const invoiceWindow = window.open('', '_blank', 'width=800,height=600');

    // HTML template for the invoice
    const invoiceHTML = `
        <html>
        <head>
            <title>Invoice</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .invoice-header { text-align: center; margin-bottom: 20px; }
                .invoice-table { width: 100%; border-collapse: collapse; }
                .invoice-table th, .invoice-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                .invoice-table th { background-color: #f4f4f4; }
                .total { font-weight: bold; text-align: right; }
            </style>
        </head>
        <body>
            <div class="invoice-header">
                <h1>Invoice</h1>
                <p>Date: ${new Date().toLocaleDateString()}</p>
            </div>
            <table class="invoice-table">
                <tr>
                    <th>ID</th>
                    <td>${data.id}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>${data.name}</td>
                </tr>
                <tr>
                    <th>GST</th>
                    <td>${data.gst}</td>
                </tr>
                <tr>
                    <th>Boards</th>
                    <td>${data.boards}</td>
                </tr>
                <tr>
                    <th>Duration</th>
                    <td>${data.duration}</td>
                </tr>
                <tr>
                    <th>Months</th>
                    <td>${data.months}</td>
                </tr>
                <tr>
                    <th>Start Date</th>
                    <td>${data.start_date}</td>
                </tr>
                <tr>
                    <th>End Date</th>
                    <td>${data.end_date}</td>
                </tr>
                <tr>
                    <th>Cycles</th>
                    <td>${data.cycles}</td>
                </tr>
                <tr>
                    <th>Total Price (₹)</th>
                    <td class="total">₹${data.total_price}</td>
                </tr>
            </table>
            <button onclick="window.print()">Print Invoice</button>
        </body>
        </html>
    `;

    // Write the invoice HTML to the new window
    invoiceWindow.document.open();
    invoiceWindow.document.write(invoiceHTML);
    invoiceWindow.document.close();
}
</script>

    <div class="container mt-5">
        <h2 class="mb-4">Adds Data</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>GST</th>
                    <th>Boards</th>
                    <th>Duration</th>
                    <th>Months</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Cycles</th>
                    <th>Total Price (₹)</th>
                    <th>Generate Invoice</th>
                </tr>
            </thead>
            <tbody>
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

    // Query to fetch data
    $sql = "SELECT * FROM adds";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Display table rows
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['gst']) . "</td>";
            echo "<td>" . htmlspecialchars($row['boards']) . "</td>";
            echo "<td>" . htmlspecialchars($row['duration']) . "</td>";
            echo "<td>" . htmlspecialchars($row['months']) . "</td>";
            echo "<td>" . htmlspecialchars($row['start_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['end_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['cycles']) . "</td>";
            echo "<td>₹" . htmlspecialchars($row['total_price']) . "</td>";
            echo "<td><button class='btn btn-primary' onclick=\"location.href='print.php?id=" . htmlspecialchars($row['id']) . "'\">Print</button></td>";
                echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='11' class='text-center'>No data found</td></tr>";
    }
    
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage()); // Log error securely
    echo "<tr><td colspan='11' class='text-danger'>An error occurred. Please try again later.</td></tr>";
}
?>

            </tbody>
        </table>
    </div>
</body>
</html>

					<!-- end: page -->
				</section>
			</div>

			<?php include 'rightsidebar.php'; ?>
		</section>

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.js"></script>
		<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="vendor/popper/umd/popper.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="vendor/common/common.js"></script>
		<script src="vendor/nanoscroller/nanoscroller.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="vendor/jquery-placeholder/jquery.placeholder.js"></script>

		<!-- Specific Page Vendor -->
		<script src="vendor/raphael/raphael.js"></script>
		<script src="vendor/morris/morris.js"></script>
		<script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="vendor/datatables/media/js/dataTables.bootstrap5.min.js"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>

		<!-- Theme Custom -->
		<script src="js/custom.js"></script>

		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

		<!-- Examples -->
		<script src="js/examples/examples.header.menu.js"></script>
		<script src="js/examples/examples.ecommerce.dashboard.js"></script>
		<script src="js/examples/examples.ecommerce.datatables.list.js"></script>

	</body>
</html>
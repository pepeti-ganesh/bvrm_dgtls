<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
<head>
    <?php include 'head.php'; ?>
    <title>Invoices</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="pl.css">
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
                            include 'connect.php';

                            try {
                                // Fetch all rows from the database
                                $sql = "SELECT * FROM adds";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();

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
                                        echo "<td><button class='btn btn-primary' onclick='generateInvoice(" . json_encode($row) . ")'>Print</button></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='11' class='text-center'>No data found</td></tr>";
                                }
                            } catch (PDOException $e) {
                                error_log("Database Error: " . $e->getMessage());
                                echo "<tr><td colspan='11' class='text-danger'>An error occurred. Please try again later.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <script>
            function generateInvoice(rowData) {
    const data = rowData; // Parse the row data

    // Create a new window or tab for the invoice
    const invoiceWindow = window.open('', '_blank', 'width=800,height=600');

    // HTML template for the invoice
    const invoiceHTML = `
        <html>
        <head>
            <title>Invoice</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .invoice-container { width: 100%; padding: 20px; box-sizing: border-box; }
                .header-logo, .footer-logo { max-width: 100%; }
                .to-section { display: flex; justify-content: space-between; margin-bottom: 20px; }
                .to-left p, .date-right p { margin: 0; }
                .ad-details table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                .ad-details th, .ad-details td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                .ad-details th { background-color: #f4f4f4; }
                footer { margin-top: 20px; display: flex; justify-content: space-between; font-size: 14px; }
                footer div { margin-right: 20px; }
                .print-button { margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class="invoice-container">
                <header>
                    <img src="./img/header.png" alt="Company Logo" class="header-logo">
                </header>

                <section class="to-section">
                    <div class="to-left">
                        <p><strong>TO:</strong> ${data.name}</p>
                        <p style="margin-left: 34px"><strong>City:</strong> ${data.city || 'N/A'}</p>
                    </div>
                    <div class="date-right">
                        <p><strong>Date:</strong> ${data.start_date}</p>
                    </div>
                </section>

                <section>
                    <div style="text-align: center;">
                        <b>To Whomsoever It May Concern</b>
                    </div>
                    <p><b>Sub:</b> Quotation for Digital ADs of your brands at LED Video Wall at ASR Nagar.</p>
                    <p><b>AD Timings:</b> Morning 4:30 AM to 11:00 AM.</p>
                    <p style="margin-left: 12.5%;">Evening 3:00 PM to 11:00 PM</p>
                    <p><b>AD Board Location:</b> At ‘Y’ Junction above Bombay Sweets, (18 X 7)</p>

                    <p><b>For 30 Days:</b> ${data.duration} Ad Slot</p>
                </section>

                <section class="ad-details">
                    <b>Customized Discounted Price:</b>
                    <table>
                        <thead>
                            <tr>
                                <th>Duration</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${data.duration}</td>
                                <td>${data.start_date}</td>
                                <td>${data.end_date}</td>
                                <td>₹${data.total_price}</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <p>The above discount pricing is valid only if we agree for a 6-months contract | Quote Validity: 1 Week. GST/Taxes Not Included in Pricing.</p>

                <div class="base">
                    <div style="margin-right: 60%;">
                    <b>Regards,</b>
                    </div>
                    <div style="margin-left: 60%;">
                        <h2>Amrutha Mudunuri</h2>
                        <b>Proprietor, Bhimavaram Online</b>
                    </div>
                </div>
                <footer>
                    <div><b>Phone:</b><br>9992223542</div>
                    <div><b>Email:</b><br>bhimavaramdigitals@gmail.com</div>
                    <div><b>Address:</b> 2nd Floor, i-Hub Incubation Center,<br>SRKREC, Bhimavaram, AP, India</div>
                </footer>

                <img src="./img/footer.png" alt="Footer Logo" class="footer-logo">
                <button class="btn btn-primary print-button" onclick="window.print()">Print Invoice</button>
            </div>
        </body>
        </html>
    `;

    // Write the invoice HTML to the new window
    invoiceWindow.document.open();
    invoiceWindow.document.write(invoiceHTML);
    invoiceWindow.document.close();
}

                </script>
                <!-- end: page -->
            </section>
        </div>

        <?php include 'rightsidebar.php'; ?>
    </section>

    <!-- Vendor -->
    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

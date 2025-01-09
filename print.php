<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="pl.css">
</head>
<body>
    <div class="invoice-container">
        <header>
            <img src="./img/header.png" alt="Company Logo" class="header-logo" style="max-width: 100%;">
        </header>

        <section class="to-section">
            <div class="to-left">
                <p><strong>TO:</strong> <?php echo htmlspecialchars($data['name']); ?></p>
                <p style="margin-left: 34px"><strong>City:</strong> <?php echo htmlspecialchars($data['city'] ?? 'N/A'); ?></p>
            </div>
            <div class="date-right">
                <p><strong>Date:</strong> <?php echo htmlspecialchars($data['start_date']); ?></p>
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

            <p><b>For 30 Days:</b> <?php echo htmlspecialchars($data['duration']); ?> Ad Slot</p>
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
                        <td><?php echo htmlspecialchars($data['duration']); ?></td>
                        <td><?php echo htmlspecialchars($data['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($data['end_date']); ?></td>
                        <td><?php echo htmlspecialchars($data['total_price']); ?></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <p>The above discount pricing is valid only if we agree for a 6-months contract | Quote Validity: 1 Week. GST/Taxes Not Included in Pricing.</p>

        <div class="base">
            <b>Regards,</b>
            <div>
                <h2>Amrutha Mudunuri</h2>
                <b>Proprietor, Bhimavaram Online</b>
            </div>
        </div>
        <footer>
            <div><b>Phone:</b><br>9992223542</div>
            <div><b>Email:</b><br>bhimavaramdigitals@gmail.com</div>
            <div><b>Address:</b> 2nd Floor, i-Hub Incubation Center,<br>SRKREC, Bhimavaram, AP, India</div>
        </footer>

        <img src="./img/footer.png" alt="Footer Logo" style="max-width: 100%;">
        <button class="btn btn-primary print-button" onclick="window.print()">Print Invoice</button>
    </div>
</body>
</html>

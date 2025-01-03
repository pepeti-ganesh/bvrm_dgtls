<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
	<head>
    <?php include 'head.php'; ?>
	<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("quotation-form");
  const totalOutput = document.getElementById("total-output");
  const durationField = document.getElementById("duration");
  const monthsField = document.getElementById("months");
  const cyclesField = document.getElementById("cycles");
  const startDateField = document.getElementById("start-date");
  const endDateField = document.getElementById("end-date");

  // Calculate total money whenever duration, cycles, or months are changed
  function calculateTotal() {
    const duration = parseInt(durationField.value, 10);
    const months = parseInt(monthsField.value, 10);
    const cycles = parseInt(cyclesField.value, 10);

    if (!isNaN(duration) && !isNaN(months) && !isNaN(cycles)) {
      let pricePerMonth = 0;
      if (duration === 20) {
        pricePerMonth = 1000;
      } else if (duration === 30) {
        pricePerMonth = 1200;
      } else if (duration === 50) {
        pricePerMonth = 1500;
      }

      // Calculate the total price, considering both months and cycles
      let total = pricePerMonth * months;

      // Adjust total based on cycles
      if (cycles === 50) {
        total *= 1; // No change for 50 cycles
      } else if (cycles === 100) {
        total *= 1.5; // Increase total by 50% for 100 cycles
      }

      totalOutput.textContent = `Total Money: ₹${total}`;
    } else {
      totalOutput.textContent = "Total Money: ₹0";
    }
  }

  // Calculate end date based on start date and months
  function calculateEndDate() {
    const startDate = new Date(startDateField.value);
    const months = parseInt(monthsField.value, 10);

    if (!isNaN(startDate.getTime()) && !isNaN(months)) {
      const endDate = new Date(startDate);
      endDate.setMonth(endDate.getMonth() + months);
      endDateField.value = endDate.toISOString().split('T')[0]; // Format as yyyy-mm-dd
    } else {
      endDateField.value = "";
    }
  }

  // Event listeners for changes in the form fields
  durationField.addEventListener("change", calculateTotal);
  monthsField.addEventListener("change", () => {
    calculateTotal();
    calculateEndDate();
  });
  cyclesField.addEventListener("change", calculateTotal);
  startDateField.addEventListener("change", calculateEndDate);
});

  </script>
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
						<h2 class="font-weight-bold text-6">Expenses</h2>
						<div class="right-wrapper">
							<ol class="breadcrumbs">

								<li><span>Home</span></li>

								<li><span>Expenses</span></li>

							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<div class="row">
            <form id="expense-form" action="expenses_form.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="title">Expense Title:</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter Expense Title" required>
              </div>
              <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" class="form-control" placeholder="Enter Description">
              </div>
              <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="bill">Upload Bill</label>
                <input type="file" id="bill" name="bill" class="form-control" accept="application/pdf/image" required>
              </div>
              <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter Amount Paid" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            <?php if (!empty($message)) echo $message; ?>
          </div>
          

					
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
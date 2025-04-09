<?php include("connect.php"); ?>

<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">

<head>
	<?php include 'head.php'; ?>

</head>

<body>

	<?php


	// Fetch monthly expenses
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

	// Initialize an array to store the counts for each month
	$monthlyCounts = array_fill_keys(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 0);

	// Fetch data from the database
	$sql = "SELECT start_date, end_date FROM adds";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$startDate = new DateTime($row['start_date']);
			$endDate = new DateTime($row['end_date']);

			// Loop through each month in the range
			while ($startDate <= $endDate) {
				$monthName = $startDate->format('M'); // Get the month name (e.g., Jan, Feb)
				$monthlyCounts[$monthName]++;
				$startDate->modify('+1 month'); // Move to the next month
			}
		}
	}

	// Convert the data into the format required for the chart
	$revenueChartData = [];
	foreach ($monthlyCounts as $month => $count) {
		$revenueChartData[] = ['y' => $month, 'a' => $count];
	}


	?>

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
					<h2 class="font-weight-bold text-6">Dashboard</h2>
					<div class="right-wrapper">
						<ol class="breadcrumbs">

							<li><span>Home</span></li>

							<li><span>eCommerce Dashboard</span></li>

						</ol>

						<a class="sidebar-right-toggle" data-open="sidebar-right"><i
								class="fas fa-chevron-left"></i></a>
					</div>
				</header>

				<!-- start: page -->
				<div class="row">
					<div class="col-lg-12 col-xl-4">

						<div class="row">
							<div class="col-12">
								<div class="card card-modern">
									<div class="card-body p-0">
										<div class="widget-user-info">
											<div class="widget-user-info-header">
												<h2 class="font-weight-bold text-color-dark text-5"> Mr Prudhvi</h2>
												<p class="mb-0">Administrator</p>

												<div class="widget-user-acrostic bg-primary">
													<span class="font-weight-bold">MP</span>
												</div>
											</div>
											<div class="widget-user-info-body">
												<div class="row">
													<?php
													$sql = "SELECT SUM(total_price) AS total_market FROM adds";
													$result = $conn->query($sql);

													if ($result && $row = $result->fetch_assoc()) {
														$totalMarket = $row['total_market'] ?? 0;
													} else {
														$totalMarket = 0;
													}


													?>
													<div class="col-auto">
														<strong
															class="text-color-dark text-5">₹<?php echo number_format($totalMarket, 2, '.', ','); ?></strong>
														<h3 class="text-4-1">Total Market</h3>
													</div>
													<div class="col-auto">
														<?php
														// Fetch the total number of unique clients from the 'adds' table
														$sql = "SELECT COUNT(DISTINCT name) AS total_clients FROM adds";
														$result = $conn->query($sql);

														if ($result && $row = $result->fetch_assoc()) {
															$totalClients = $row['total_clients'] ?? 0;
														} else {
															$totalClients = 0;
														}
														?>
														<strong
															class="text-color-dark text-5"><?php echo number_format($totalClients); ?></strong>
														<h3 class="text-4-1">Total Clients</h3>
													</div>
												</div>
												<div class="row">

													<div class="col">
														<a href="https://bhimavaramdigitals.com"
															class="btn btn-light btn-xl border font-weight-semibold text-color-dark text-3 mt-4">Visit
															Profile</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-xl-12 pb-2 pb-lg-0 mb-4 mb-lg-0">
								<div class="card card-modern">
									<div class="card-body py-4">
										<div class="row alizgn-items-center">
											<div class="col-6 col-md-4">
												<h3 class="text-4-1 my-0">Total Orders</h3>
												<?php
												$sql = "SELECT COUNT(*) AS total_orders FROM adds";
												$result = $conn->query($sql);

												if ($result && $row = $result->fetch_assoc()) {
													$totalOrders = $row['total_orders'] ?? 0;
												} else {
													$totalOrders = 0;
												}
												?>
												<strong
													class="text-6 text-color-dark"><?php echo number_format($totalOrders); ?></strong>
											</div>
											<div
												class="col-6 col-md-4 border border-top-0 border-end-0 border-bottom-0 border-color-light-grey py-3">
												<h3 class="text-4-1 text-color-success line-height-2 my-0">Orders
													<strong>UP &uarr;</strong>
												</h3>
												<span>30 days</span>
											</div>
											<div class="col-md-4 text-start text-md-right pe-md-4 mt-4 mt-md-0">
												<i
													class="bx bx-cart-alt icon icon-inline icon-xl bg-primary rounded-circle text-color-light"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-xl-12 pt-xl-2 mt-xl-4">
								<div class="card card-modern">
									<div class="card-body py-4">
										<div class="row align-items-center">
											<div class="col-6 col-md-4">
												<h3 class="text-4-1 my-0">Average Price</h3>
												<?php
												$sql = "SELECT SUM(total_price) AS total_amount, COUNT(*) AS total_orders FROM adds";
												$result = $conn->query($sql);

												if ($result && $row = $result->fetch_assoc()) {
													$totalAmount = $row['total_amount'] ?? 0;
													$totalOrders = $row['total_orders'] ?? 1; // Avoid division by zero
													$averagePrice = $totalAmount / $totalOrders;
												} else {
													$averagePrice = 0;
												}
												?>
												<strong
													class="text-6 text-color-dark">$<?php echo number_format($averagePrice, 2, '.', ','); ?></strong>
											</div>
											<div
												class="col-6 col-md-4 border border-top-0 border-end-0 border-bottom-0 border-color-light-grey py-3">
												<h3 class="text-4-1 text-color-success line-height-2 my-0">Average
													<strong>UP &uarr;</strong>
												</h3>
												<span>30 days</span>
											</div>
											<div class="col-md-4 text-start text-md-right pe-md-4 mt-4 mt-md-0">
												<i
													class="bx bx-purchase-tag-alt icon icon-inline icon-xl bg-primary rounded-circle text-color-light pe-0"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-xl-8 pt-2 pt-xl-0 mt-4 mt-xl-0">


						<!-- graph -->
						<div class="row">
							<div class="col">
								<div class="card card-modern">
									<div class="card-header">
										<div class="card-actions">
											<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
										</div>
										<h2 class="card-title">Revenue</h2>
									</div>
									<div class="card-body">
										<div class="row">
											<?php
											// Fetch the current month and year
											$currentMonth = date('m'); // Current month (e.g., 02 for February)
											$currentYear = date('Y'); // Current year (e.g., 2025)
											
											// Initialize variables to store totals
											$thisMonthTotal = 0;
											$lastMonthTotal = 0;

											// Fetch all records from the 'adds' table
											$sql = "SELECT start_date, end_date, total_price FROM adds";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$startDate = new DateTime($row['start_date']);
													$endDate = new DateTime($row['end_date']);
													$totalPrice = $row['total_price'];

													// Calculate the number of months between start and end dates
													$interval = $startDate->diff($endDate);
													$months = ($interval->y * 12) + $interval->m + 1; // Include the start month
											
													// Calculate the monthly amount
													$monthlyAmount = $totalPrice / $months;

													// Loop through each month in the range and add the amount to the respective month
													while ($startDate <= $endDate) {
														$month = $startDate->format('m');
														$year = $startDate->format('Y');

														if ($month == $currentMonth && $year == $currentYear) {
															$thisMonthTotal += $monthlyAmount;
														} elseif ($month == ($currentMonth - 1) && $year == $currentYear) {
															$lastMonthTotal += $monthlyAmount;
														} elseif ($currentMonth == 1 && $month == 12 && $year == ($currentYear - 1)) {
															$lastMonthTotal += $monthlyAmount;
														}

														// Move to the next month
														$startDate->modify('+1 month');
													}
												}
											}
											?>

											<div class="col-auto">
												<strong
													class="text-color-dark text-6">₹<?php echo number_format($thisMonthTotal, 2, ',', '.'); ?></strong>
												<h3 class="text-4 mt-0 mb-2">This Month</h3>
											</div>
											<div class="col-auto">
												<strong
													class="text-color-dark text-6">₹<?php echo number_format($lastMonthTotal, 2, ',', '.'); ?></strong>
												<h3 class="text-4 mt-0 mb-2">Last Month</h3>
											</div>
										</div>
										<div class="row">
											<div class="col">

												<!-- Morris: Area -->
												<div class="chart chart-md chart-bar-stacked-sm my-3" id="revenueChart"
													style="height: 409px;"></div>
												<script type="text/javascript">

													var revenueChartData = <?php echo json_encode($revenueChartData); ?>;

													// Example usage in your chart
													console.log(revenueChartData);

												</script>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-xl-4">
						<div class="card card-modern">
							<div class="card-body py-4">
								<div class="row align-items-center">
									<div class="col-6 col-md-4">
										<h3 class="text-4-1 my-0">Total Customers</h3>
										<?php
										$sql = "SELECT COUNT(DISTINCT name) AS total_customers FROM adds";
										$result = $conn->query($sql);

										if ($result && $row = $result->fetch_assoc()) {
											$totalCustomers = $row['total_customers'] ?? 0;
										} else {
											$totalCustomers = 0;
										}
										?>
										<strong
											class="text-6 text-color-dark"><?php echo number_format($totalCustomers); ?></strong>
									</div>
									<div
										class="col-6 col-md-4 border border-top-0 border-end-0 border-bottom-0 border-color-light-grey py-3">
										<h3 class="text-4-1 text-color-success line-height-2 my-0">Customers <strong>UP
												&uarr;</strong></h3>
										<span>30 days</span>
									</div>
									<div class="col-md-4 text-start text-md-right pe-md-4 mt-4 mt-md-0">
										<i
											class="bx bx-user icon icon-inline icon-xl bg-primary rounded-circle text-color-light"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="card card-modern">
							<div class="card-header">
								<div class="card-actions">
									<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
								</div>
								<h2 class="card-title">Recent Activity</h2>
							</div>
							<div class="card-body">
								<ul class="list list-unstyled mb-0">
									<?php
									$sqlAdds = "SELECT id, name, start_date FROM adds ORDER BY start_date DESC LIMIT 3";
									$resultAdds = $conn->query($sqlAdds);

									if ($resultAdds && $resultAdds->num_rows > 0) {
										while ($row = $resultAdds->fetch_assoc()) {
											$timeAgo = time() - strtotime($row['start_date']); // Use the correct column
											echo '<li class="activity-item">';
											echo '<span class="activity-time">' . formatTimeAgo($timeAgo) . '</span> <i class="fas fa-chevron-right text-color-primary"></i>';
											echo '<span class="activity-description">';
											echo '<strong>Quotation</strong>: ' . htmlspecialchars($row['name']);
											echo '</span>';
											echo '</li>';
										}
									}

									// Fetch recent activities from the 'expenses' table
									$sqlExpenses = "SELECT id, title, date FROM expenses ORDER BY date DESC LIMIT 3";
									$resultExpenses = $conn->query($sqlExpenses);

									if ($resultExpenses && $resultExpenses->num_rows > 0) {
										while ($row = $resultExpenses->fetch_assoc()) {
											$timeAgo = time() - strtotime($row['date']); // Calculate time ago
											echo '<li class="activity-item">';
											echo '<span class="activity-time">' . formatTimeAgo($timeAgo) . '</span> <i class="fas fa-chevron-right text-color-primary"></i>';
											echo '<span class="activity-description">';
											echo '<strong>Expense</strong>: ' . htmlspecialchars($row['title']);
											echo '</span>';
											echo '</li>';
										}
									}

									// Function to format time ago
									function formatTimeAgo($timeAgo)
									{
										if ($timeAgo < 60) {
											return $timeAgo . ' seconds ago';
										} elseif ($timeAgo < 3600) {
											return floor($timeAgo / 60) . ' minutes ago';
										} elseif ($timeAgo < 86400) {
											return floor($timeAgo / 3600) . ' hours ago';
										} else {
											return floor($timeAgo / 86400) . ' days ago';
										}
									}
									?>
								</ul>


							</div>
						</div>
					</div>
					<div class="col-lg-6 col-xl-4 pt-2 pt-lg-0 mt-4 mt-lg-0">
						<div class="card card-modern">
							<div class="card-header">
								<div class="card-actions">
									<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
								</div>
								<h2 class="card-title">Top 5 Clients</h2>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-ecommerce-simple table-borderless table-striped mb-1">
										<thead>
											<tr>
												<th>Client Name</th>
												<th>Total Amount</th>
											</tr>
										</thead>
										<tbody>
											<?php
											// Get the current month and year
											$currentMonth = date('m'); // Current month (e.g., 04 for April)
											$currentYear = date('Y'); // Current year (e.g., 2025)
											
											// Initialize an array to store client totals
											$clientTotals = [];

											// Fetch all records from the 'adds' table
											$sql = "SELECT name, start_date, end_date, total_price FROM adds";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$name = $row['name'];
													$startDate = new DateTime($row['start_date']);
													$endDate = new DateTime($row['end_date']);
													$totalPrice = $row['total_price'];

													// Calculate the number of months between start and end dates
													$interval = $startDate->diff($endDate);
													$months = ($interval->y * 12) + $interval->m + 1; // Include the start month
											
													// Calculate the monthly amount
													$monthlyAmount = $totalPrice / $months;

													// Loop through each month in the range and add the amount to the respective month
													while ($startDate <= $endDate) {
														$month = $startDate->format('m');
														$year = $startDate->format('Y');

														if ($month == $currentMonth && $year == $currentYear) {
															if (!isset($clientTotals[$name])) {
																$clientTotals[$name] = 0;
															}
															$clientTotals[$name] += $monthlyAmount;
														}

														// Move to the next month
														$startDate->modify('+1 month');
													}
												}
											}

											// Sort clients by total amount in descending order
											arsort($clientTotals);

											// Display the top 5 clients
											$topClients = array_slice($clientTotals, 0, 5, true);
											if (!empty($topClients)) {
												foreach ($topClients as $clientName => $totalAmount) {
													echo "<tr>";
													echo "<td>" . htmlspecialchars($clientName) . "</td>";
													echo "<td>₹" . number_format($totalAmount, 2, '.', ',') . "</td>";
													echo "</tr>";
												}
											} else {
												echo "<tr><td colspan='2' class='text-center'>No data available</td></tr>";
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-xl-4 pt-2 pt-xl-0 mt-4 mt-xl-0">
						<div class="card card-modern">
							<div class="card-header">
								<div class="card-actions">
									<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
								</div>
								<h2 class="card-title">Customers By Location</h2>
							</div>
							<div class="card-body">
								<label>Los Angeles (69.992)</label>
								<div class="progress progress-xs mb-4 light rounded-0">
									<div class="progress-bar progress-bar-primary rounded-0" role="progressbar"
										aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
										<span class="sr-only">50%</span>
									</div>
								</div>
								<label>Miami (41.953)</label>
								<div class="progress progress-xs mb-4 light rounded-0">
									<div class="progress-bar progress-bar-info rounded-0" role="progressbar"
										aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%;">
										<span class="sr-only">35%</span>
									</div>
								</div>
								<label>New York (23.307)</label>
								<div class="progress progress-xs mb-4 light rounded-0">
									<div class="progress-bar progress-bar-primary rounded-0" role="progressbar"
										aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
										<span class="sr-only">25%</span>
									</div>
								</div>
								<label>Chicago (20.200)</label>
								<div class="progress progress-xs mb-4 light rounded-0">
									<div class="progress-bar progress-bar-info rounded-0" role="progressbar"
										aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" style="width: 22%;">
										<span class="sr-only">22%</span>
									</div>
								</div>
								<label>Detroit (19.550)</label>
								<div class="progress progress-xs mb-5 light rounded-0">
									<div class="progress-bar progress-bar-primary rounded-0" role="progressbar"
										aria-valuenow="19" aria-valuemin="0" aria-valuemax="100" style="width: 19%;">
										<span class="sr-only">19%</span>
									</div>
								</div>

								<a href="#"
									class="btn btn-light btn-xl border font-weight-semibold text-color-dark text-3 mb-4">View
									More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">

						<div class="card card-modern card-modern-table-over-header">
							<div class="card-header">
								<div class="card-actions">
									<a href="#" class="card-action card-action-toggle" data-card-toggle></a>

								</div>
								<div>
									<div class="row">
										<div class="col-lg-6 mb-3">
											<section class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-xl-8">
															<div class="chart-data-selector" id="salesSelectorWrapper">

																<h2>
																	Sales:
																	<strong>
																		<select class="form-control" id="salesSelector">
																			<option value="Category1" selected>COMBO
																			</option>
																			<option value="Category2">8/10 ASR Nagar
																			</option>
																			<option value="Category3">10/16 Bombay
																				Sweets
																			</option>
																		</select>
																	</strong>
																</h2>

																<div id="salesSelectorItems"
																	class="chart-data-selector-items mt-3">
																	<!-- Flot: Sales Category 1 -->
																	<div class="chart chart-sm"
																		data-sales-rel="Category1" id="flotDashSales1"
																		class="chart-active" style="height: 203px;">
																	</div>
																	<script>
																		<?php
																		// Fetch sales data for Category 1
																		$category1Data = [];
																		$sql = "SELECT DATE_FORMAT(start_date, '%b') AS month, SUM(total_price) AS total_amount 
				FROM adds 
				WHERE boards = 'Combo' 
				GROUP BY month 
				ORDER BY MONTH(start_date)";
																		$result = $conn->query($sql);
																		if ($result->num_rows > 0) {
																			while ($row = $result->fetch_assoc()) {
																				$category1Data[] = [$row['month'], (float) $row['total_amount']];
																			}
																		}
																		?>
																		var flotDashSales1Data = [{
																			data: <?php echo json_encode($category1Data); ?>,
																			color: "#0088cc"
																		}];
																	</script>

																	<!-- Flot: Sales Category 2 -->
																	<div class="chart chart-sm"
																		data-sales-rel="Category2" id="flotDashSales2"
																		class="chart-hidden"></div>
																	<script>
																		<?php
																		// Fetch sales data for Category 2
																		$category2Data = [];
																		$sql = "SELECT DATE_FORMAT(start_date, '%b') AS month, SUM(total_price) AS total_amount 
				FROM adds 
				WHERE boards = '8/10 ASR Nagar' 
				GROUP BY month 
				ORDER BY MONTH(start_date)";
																		$result = $conn->query($sql);
																		if ($result->num_rows > 0) {
																			while ($row = $result->fetch_assoc()) {
																				$category2Data[] = [$row['month'], (float) $row['total_amount']];
																			}
																		}
																		?>
																		var flotDashSales2Data = [{
																			data: <?php echo json_encode($category2Data); ?>,
																			color: "#2baab1"
																		}];
																	</script>

																	<!-- Flot: Sales Category 3 -->
																	<div class="chart chart-sm"
																		data-sales-rel="Category3" id="flotDashSales3"
																		class="chart-hidden"></div>
																	<script>
																		<?php
																		// Fetch sales data for Category 3
																		$category3Data = [];
																		$sql = "SELECT DATE_FORMAT(start_date, '%b') AS month, SUM(total_price) AS total_amount 
				FROM adds 
				WHERE boards = '10/16 Bombay Sweets' 
				GROUP BY month 
				ORDER BY MONTH(start_date)";
																		$result = $conn->query($sql);
																		if ($result->num_rows > 0) {
																			while ($row = $result->fetch_assoc()) {
																				$category3Data[] = [$row['month'], (float) $row['total_amount']];
																			}
																		}
																		?>
																		var flotDashSales3Data = [{
																			data: <?php echo json_encode($category3Data); ?>,
																			color: "#734ba9"
																		}];
																	</script>
																</div>
															</div>
														</div>
														<div class="col-xl-4 text-center">
															<h2 class="card-title mt-3">Sales Goal</h2>
															<div class="liquid-meter-wrapper liquid-meter-sm mt-3">
																<div class="liquid-meter">
																	<?php
																	// Define the sales goals
																	$monthlySalesGoal = 100000; // Monthly sales goal in rupees
																	$annualSalesGoal = 1200000; // Annual sales goal in rupees
																	
																	// Fetch the total sales for the current month
																	$currentMonth = date('m'); // Current month (e.g., 04 for April)
																	$currentYear = date('Y'); // Current year (e.g., 2025)
																	
																	// Fetch total sales for the current month
																	$sqlMonthly = "SELECT SUM(total_price) AS total_sales 
                           FROM adds 
                           WHERE MONTH(start_date) = ? AND YEAR(start_date) = ?";
																	$stmtMonthly = $conn->prepare($sqlMonthly);
																	$stmtMonthly->bind_param("ii", $currentMonth, $currentYear);
																	$stmtMonthly->execute();
																	$resultMonthly = $stmtMonthly->get_result();

																	$monthlySales = 0;
																	if ($resultMonthly && $row = $resultMonthly->fetch_assoc()) {
																		$monthlySales = $row['total_sales'] ?? 0;
																	}

																	// Fetch total sales for the current year
																	$sqlAnnual = "SELECT SUM(total_price) AS total_sales 
                          FROM adds 
                          WHERE YEAR(start_date) = ?";
																	$stmtAnnual = $conn->prepare($sqlAnnual);
																	$stmtAnnual->bind_param("i", $currentYear);
																	$stmtAnnual->execute();
																	$resultAnnual = $stmtAnnual->get_result();

																	$annualSales = 0;
																	if ($resultAnnual && $row = $resultAnnual->fetch_assoc()) {
																		$annualSales = $row['total_sales'] ?? 0;
																	}

																	// Calculate the percentage of the sales goals achieved
																	$monthlySalesPercentage = min(($monthlySales / $monthlySalesGoal) * 100, 100); // Cap at 100%
																	$annualSalesPercentage = min(($annualSales / $annualSalesGoal) * 100, 100); // Cap at 100%
																	?>
																	<meter min="0" max="100"
																		value="<?php echo $monthlySalesPercentage; ?>"
																		id="meterSales"></meter>
																</div>
																<div class="liquid-meter-selector mt-4 pt-1"
																	id="meterSalesSel">
																	<a href="#"
																		data-val="<?php echo $monthlySalesPercentage; ?>"
																		class="active">Monthly Goal</a>
																	<a href="#"
																		data-val="<?php echo $annualSalesPercentage; ?>">Annual
																		Goal</a>
																</div>
															</div>

														</div>
													</div>
												</div>
											</section>
										</div>
										<div class="col-lg-6">
											<div class="row mb-3">
												<div class="col-xl-6">
													<section class="card card-featured-left card-featured-primary mb-3">
														<div class="card-body">
															<div class="widget-summary">
																<div class="widget-summary-col widget-summary-col-icon">
																	<div class="summary-icon bg-primary">
																		<i class="fas fa-life-ring"></i>
																	</div>
																</div>
																<div class="widget-summary-col">
																	<div class="summary">
																		<h4 class="title">Support Questions</h4>
																		<div class="info">
																			<strong class="amount">1281</strong>
																			<span class="text-primary">(14
																				unread)</span>
																		</div>
																	</div>
																	<div class="summary-footer">
																		<a class="text-muted text-uppercase"
																			href="#">(view all)</a>
																	</div>
																</div>
															</div>
														</div>
													</section>
												</div>
												<div class="col-xl-6">
													<section class="card card-featured-left card-featured-secondary">
														<div class="card-body">
															<div class="widget-summary">
																<div class="widget-summary-col widget-summary-col-icon">
																	<div class="summary-icon bg-secondary">
																		<i class="fas fa-dollar-sign"></i>
																	</div>
																</div>
																<div class="widget-summary-col">
																	<div class="summary">
																		<h4 class="title">Total Profit</h4>
																		<div class="info">
																			<strong class="amount">$ 14,890.30</strong>
																		</div>
																	</div>
																	<div class="summary-footer">
																		<a class="text-muted text-uppercase"
																			href="#">(withdraw)</a>
																	</div>
																</div>
															</div>
														</div>
													</section>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-6">
													<section
														class="card card-featured-left card-featured-tertiary mb-3">
														<div class="card-body">
															<div class="widget-summary">
																<div class="widget-summary-col widget-summary-col-icon">
																	<div class="summary-icon bg-tertiary">
																		<i class="fas fa-shopping-cart"></i>
																	</div>
																</div>
																<div class="widget-summary-col">
																	<div class="summary">
																		<h4 class="title">Today's Orders</h4>
																		<div class="info">
																			<strong class="amount">38</strong>
																		</div>
																	</div>
																	<div class="summary-footer">
																		<a class="text-muted text-uppercase"
																			href="#">(statement)</a>
																	</div>
																</div>
															</div>
														</div>
													</section>
												</div>
												<div class="col-xl-6">
													<section class="card card-featured-left card-featured-quaternary">
														<div class="card-body">
															<div class="widget-summary">
																<div class="widget-summary-col widget-summary-col-icon">
																	<div class="summary-icon bg-quaternary">
																		<i class="fas fa-user"></i>
																	</div>
																</div>
																<div class="widget-summary-col">
																	<div class="summary">
																		<h4 class="title">Today's Visitors</h4>
																		<div class="info">
																			<strong class="amount">3765</strong>
																		</div>
																	</div>
																	<div class="summary-footer">
																		<a class="text-muted text-uppercase"
																			href="#">(report)</a>
																	</div>
																</div>
															</div>
														</div>
													</section>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="container mt-5">
								<h2 class="mb-4">Recent Adds</h2>
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
										</tr>
									</thead>
									<tbody>
										<?php
										include 'quotation_connect.php';

										try {
											// Fetch top 3 rows from the database, ordered by ID in descending order
											$sql = "SELECT * FROM adds ORDER BY id DESC LIMIT 10 ";
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
													echo "</tr>";
												}
											} else {
												echo "<tr><td colspan='10' class='text-center'>No data found</td></tr>";
											}
										} catch (PDOException $e) {
											error_log("Database Error: " . $e->getMessage());
											echo "<tr><td colspan='10' class='text-danger'>An error occurred. Please try again later.</td></tr>";
										}
										?>
									</tbody>
								</table>


							</div>

						</div>

					</div>
				</div>
				<!-- end: page -->
			</section>
		</div>

		<?php include 'rightsidebar.php'; ?>
	</section>

	<!-- Vendor -->



	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
		const ctx = document.getElementById('expenseChart').getContext('2d');
		const expenseChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode(array_keys($monthlyExpenses)); ?>,
				datasets: [{
					label: 'Monthly Expenses',
					data: <?php echo json_encode(array_values($monthlyExpenses)); ?>,
					backgroundColor: 'rgba(54, 162, 235, 0.6)',
					borderColor: 'rgba(54, 162, 235, 1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	</script>





	<?php include 'tags.php'; ?>
</body>

</html>
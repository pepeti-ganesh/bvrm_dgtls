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
						<h2 class="font-weight-bold text-6">Dashboard</h2>
						<div class="right-wrapper">
							<ol class="breadcrumbs">

								<li><span>Home</span></li>

								<li><span>eCommerce Dashboard</span></li>

							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
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
													<h2 class="font-weight-bold text-color-dark text-5">Hello, John Doe</h2>
													<p class="mb-0">Administrator</p>

													<div class="widget-user-acrostic bg-primary">
														<span class="font-weight-bold">JD</span>
													</div>
												</div>
												<div class="widget-user-info-body">
													<div class="row">
														<div class="col-auto">
															<strong class="text-color-dark text-5">$19.876,02</strong>
															<h3 class="text-4-1">User Balance</h3>
														</div>
														<div class="col-auto">
															<strong class="text-color-dark text-5">637</strong>
															<h3 class="text-4-1">Products</h3>
														</div>
													</div>
													<div class="row">
														<div class="col">
															<a href="pages-user-profile.html" class="btn btn-light btn-xl border font-weight-semibold text-color-dark text-3 mt-4">View Profile</a>
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
											<div class="row align-items-center">
												<div class="col-6 col-md-4">
													<h3 class="text-4-1 my-0">Total Orders</h3>
													<strong class="text-6 text-color-dark">4825</strong>
												</div>
												<div class="col-6 col-md-4 border border-top-0 border-end-0 border-bottom-0 border-color-light-grey py-3">
													<h3 class="text-4-1 text-color-success line-height-2 my-0">Orders <strong>UP &uarr;</strong></h3>
													<span>30 days</span>
												</div>
												<div class="col-md-4 text-start text-md-right pe-md-4 mt-4 mt-md-0">
													<i class="bx bx-cart-alt icon icon-inline icon-xl bg-primary rounded-circle text-color-light"></i>
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
													<strong class="text-6 text-color-dark">$39,03</strong>
												</div>
												<div class="col-6 col-md-4 border border-top-0 border-end-0 border-bottom-0 border-color-light-grey py-3">
													<h3 class="text-4-1 text-color-danger line-height-2 my-0">Price <strong>DOWN &darr;</strong></h3>
													<span>30 days</span>
												</div>
												<div class="col-md-4 text-start text-md-right pe-md-4 mt-4 mt-md-0">
													<i class="bx bx-purchase-tag-alt icon icon-inline icon-xl bg-primary rounded-circle text-color-light pe-0"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-xl-8 pt-2 pt-xl-0 mt-4 mt-xl-0">

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
												<div class="col-auto">
													<strong class="text-color-dark text-6">$19.876,02</strong>
													<h3 class="text-4 mt-0 mb-2">This Month</h3>
												</div>
												<div class="col-auto">
													<strong class="text-color-dark text-6">$14.345,26</strong>
													<h3 class="text-4 mt-0 mb-2">Last Month</h3>
												</div>
												<div class="col-auto">
													<strong class="text-color-dark text-6">$119.876,02</strong>
													<h3 class="text-4 mt-0 mb-2">Total Profit</h3>
												</div>
											</div>
											<div class="row">
												<div class="col">

													<!-- Morris: Area -->
													<div class="chart chart-md chart-bar-stacked-sm my-3" id="revenueChart" style="height: 409px;"></div>
													<script type="text/javascript">

														var revenueChartData = [{
															y: 'Jan',
															a: 56,
															b: 65
														}, {
															y: 'Feb',
															a: 76,
															b: 96
														}, {
															y: 'Mar',
															a: 65,
															b: 75
														}, {
															y: 'Apr',
															a: 80,
															b: 90
														}, {
															y: 'May',
															a: 55,
															b: 55
														}, {
															y: 'Jun',
															a: 75,
															b: 15
														}, {
															y: 'Jul',
															a: 79,
															b: 85
														}, {
															y: 'Aug',
															a: 54,
															b: 63
														}, {
															y: 'Sep',
															a: 78,
															b: 98
														}, {
															y: 'Oct',
															a: 35,
															b: 46
														}, {
															y: 'Nov',
															a: 35,
															b: 42
														}, {
															y: 'Dec',
															a: 72,
															b: 81
														}];

														// See: js/examples/examples.charts.js for more settings.

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
											<strong class="text-6 text-color-dark">3872</strong>
										</div>
										<div class="col-6 col-md-4 border border-top-0 border-end-0 border-bottom-0 border-color-light-grey py-3">
											<h3 class="text-4-1 text-color-success line-height-2 my-0">Customers <strong>UP &uarr;</strong></h3>
											<span>30 days</span>
										</div>
										<div class="col-md-4 text-start text-md-right pe-md-4 mt-4 mt-md-0">
											<i class="bx bx-user icon icon-inline icon-xl bg-primary rounded-circle text-color-light"></i>
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
										<li class="activity-item">
											<span class="activity-time">1 MIN AGO</span> <i class="fas fa-chevron-right text-color-primary"></i> 
											<span class="activity-description">
												<a href="#" class="text-color-dark"><strong>John Doe</strong></a> Added <a href="#" class="text-color-dark"><strong>Black Watch</strong></a> to Cart.
											</span>
										</li>
										<li class="activity-item">
											<span class="activity-time">2 MIN AGO</span> <i class="fas fa-chevron-right text-color-primary"></i> 
											<span class="activity-description">
												<a href="#" class="text-color-dark"><strong>Order #123</strong></a> had payment refused.
											</span>
										</li>
										<li class="activity-item">
											<span class="activity-time">3 MIN AGO</span> <i class="fas fa-chevron-right text-color-primary"></i> 
											<span class="activity-description">
												<a href="#" class="text-color-dark"><strong>Greg Doe</strong></a> added <a href="#" class="text-color-dark"><strong>Porto SmartWatch</strong></a> to Cart.
											</span>
										</li>
										<li class="activity-item">
											<span class="activity-time">4 MIN AGO</span> <i class="fas fa-chevron-right text-color-primary"></i> 
											<span class="activity-description">
												<a href="#" class="text-color-dark"><strong>Order #231</strong></a> had payment refused.
											</span>
										</li>
										<li class="activity-item">
											<span class="activity-time">5 MIN AGO</span> <i class="fas fa-chevron-right text-color-primary"></i> 
											<span class="activity-description">
												<a href="#" class="text-color-dark"><strong>Monica Doe</strong></a> added <a href="#" class="text-color-dark"><strong>Porto Bag</strong></a> to Cart.
											</span>
										</li>
									</ul>

									<a href="#" class="btn btn-light btn-xl border font-weight-semibold text-color-dark text-3 mt-3">View More</a>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-xl-4 pt-2 pt-lg-0 mt-4 mt-lg-0">
							<div class="card card-modern">
								<div class="card-header">
									<div class="card-actions">
										<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
									</div>
									<h2 class="card-title">Top 5 Selling Products</h2>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-ecommerce-simple table-borderless table-striped mb-1">
											<thead>
												<tr>
													<th></th>
													<th>Product Name</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td width="72"><a href="#"><img src="img/products/product-1.jpg" class="img-fluid" width="45" alt="Porto SmartWatch" /></a></td>
													<td><a href="#" class="font-weight-semibold">Product Short Name Example</a></td>
													<td width="90">$15</td>
												</tr>
												<tr>
													<td><a href="#"><img src="img/products/product-2.jpg" class="img-fluid" width="45" alt="Porto SmartWatch" /></a></td>
													<td><a href="#" class="font-weight-semibold">Product Short Name Example</a></td>
													<td>$15</td>
												</tr>
												<tr>
													<td><a href="#"><img src="img/products/product-3.jpg" class="img-fluid" width="45" alt="Porto SmartWatch" /></a></td>
													<td><a href="#" class="font-weight-semibold">Product Short Name Example</a></td>
													<td>$15</td>
												</tr>
												<tr>
													<td><a href="#"><img src="img/products/product-4.jpg" class="img-fluid" width="45" alt="Porto SmartWatch" /></a></td>
													<td><a href="#" class="font-weight-semibold">Product Short Name Example</a></td>
													<td>$15</td>
												</tr>
												<tr>
													<td><a href="#"><img src="img/products/product-5.jpg" class="img-fluid" width="45" alt="Porto SmartWatch" /></a></td>
													<td><a href="#" class="font-weight-semibold">Product Short Name Example</a></td>
													<td>$15</td>
												</tr>
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
										<div class="progress-bar progress-bar-primary rounded-0" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
											<span class="sr-only">50%</span>
										</div>
									</div>
									<label>Miami (41.953)</label>
									<div class="progress progress-xs mb-4 light rounded-0">
										<div class="progress-bar progress-bar-info rounded-0" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%;">
											<span class="sr-only">35%</span>
										</div>
									</div>
									<label>New York (23.307)</label>
									<div class="progress progress-xs mb-4 light rounded-0">
										<div class="progress-bar progress-bar-primary rounded-0" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
											<span class="sr-only">25%</span>
										</div>
									</div>
									<label>Chicago (20.200)</label>
									<div class="progress progress-xs mb-4 light rounded-0">
										<div class="progress-bar progress-bar-info rounded-0" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" style="width: 22%;">
											<span class="sr-only">22%</span>
										</div>
									</div>
									<label>Detroit (19.550)</label>
									<div class="progress progress-xs mb-5 light rounded-0">
										<div class="progress-bar progress-bar-primary rounded-0" role="progressbar" aria-valuenow="19" aria-valuemin="0" aria-valuemax="100" style="width: 19%;">
											<span class="sr-only">19%</span>
										</div>
									</div>

									<a href="#" class="btn btn-light btn-xl border font-weight-semibold text-color-dark text-3 mb-4">View More</a>
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
									<h2 class="card-title">Recent Orders</h2>
								</div>
								<div class="card-body">
									<div class="datatables-header-footer-wrapper">
										<div class="datatable-header">
											<div class="row align-items-center mb-3">

												<div class="col-8 col-lg-auto ms-auto ml-auto mb-3 mb-lg-0">
													<div class="d-flex align-items-lg-center flex-column flex-lg-row">
														<label class="ws-nowrap me-3 mb-0">Filter By:</label>
														<select class="form-control select-style-1 filter-by" name="filter-by">
															<option value="all" selected>All</option>
															<option value="1">ID</option>
															<option value="2">Customer Name</option>
															<option value="3">Date</option>
															<option value="4">Total</option>
															<option value="5">Status</option>
														</select>
													</div>
												</div>
												<div class="col-4 col-lg-auto ps-lg-1 mb-3 mb-lg-0">
													<div class="d-flex align-items-lg-center flex-column flex-lg-row">
														<label class="ws-nowrap me-3 mb-0">Show:</label>
														<select class="form-control select-style-1 results-per-page" name="results-per-page">
															<option value="12" selected>12</option>
															<option value="24">24</option>
															<option value="36">36</option>
															<option value="100">100</option>
														</select>
													</div>
												</div>
												<div class="col-12 col-lg-auto ps-lg-1">
													<div class="search search-style-1 search-style-1-lg mx-lg-auto">
														<div class="input-group">
															<input type="text" class="search-term form-control" name="search-term" id="search-term" placeholder="Search Order">
															<button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
														</div>
													</div>
												</div>
											</div>
										</div>

										<table class="table table-ecommerce-simple table-borderless table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 640px;">

											<thead>
												<tr>
													<th width="3%"><input type="checkbox" name="select-all" class="select-all checkbox-style-1 p-relative top-2" value="" /></th>
													<th width="8%">ID</th>
													<th width="28%">Customer Name</th>
													<th width="18%">Date</th>
													<th width="18%">Total</th>
													<th width="15%">Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>191</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example</strong></a></td>
													<td>Nov 21, 2019</td>
													<td>$200</td>
													<td><span class="ecommerce-status on-hold">On Hold</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>192</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 2</strong></a></td>
													<td>Nov 22, 2019</td>
													<td>$70</td>
													<td><span class="ecommerce-status on-hold">On Hold</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>193</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 3</strong></a></td>
													<td>Nov 23, 2019</td>
													<td>$20</td>
													<td><span class="ecommerce-status processing">Processing</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>194</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 4</strong></a></td>
													<td>Nov 24, 2019</td>
													<td>$399</td>
													<td><span class="ecommerce-status on-hold">On Hold</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>195</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 5</strong></a></td>
													<td>Nov 25, 2019</td>
													<td>$1.000</td>
													<td><span class="ecommerce-status processing">Processing</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>196</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 6</strong></a></td>
													<td>Nov 26, 2019</td>
													<td>$1.300</td>
													<td><span class="ecommerce-status on-hold">On Hold</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>197</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 7</strong></a></td>
													<td>Nov 27, 2019</td>
													<td>$50</td>
													<td><span class="ecommerce-status processing">Processing</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>198</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 8</strong></a></td>
													<td>Nov 28, 2019</td>
													<td>$879</td>
													<td><span class="ecommerce-status on-hold">On Hold</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>199</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 9</strong></a></td>
													<td>Nov 29, 2019</td>
													<td>$621</td>
													<td><span class="ecommerce-status completed">Completed</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>200</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 10</strong></a></td>
													<td>Nov 30, 2019</td>
													<td>$245</td>
													<td><span class="ecommerce-status canceled">Canceled</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>201</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 11</strong></a></td>
													<td>Nov 11, 2019</td>
													<td>$178</td>
													<td><span class="ecommerce-status completed">Completed</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>202</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 12</strong></a></td>
													<td>Nov 12, 2019</td>
													<td>$63</td>
													<td><span class="ecommerce-status canceled">Canceled</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>203</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 13</strong></a></td>
													<td>Nov 13, 2019</td>
													<td>$91</td>
													<td><span class="ecommerce-status on-hold">On Hold</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>204</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 14</strong></a></td>
													<td>Nov 14, 2019</td>
													<td>$568</td>
													<td><span class="ecommerce-status processing">Processing</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>205</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 15</strong></a></td>
													<td>Nov 15, 2019</td>
													<td>$796</td>
													<td><span class="ecommerce-status on-hold">On Hold</span></td>
												</tr>
												<tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td><a href="ecommerce-orders-detail.html"><strong>206</strong></a></td>
													<td><a href="ecommerce-orders-detail.html"><strong>Customer Name Example 16</strong></a></td>
													<td>Nov 16, 2019</td>
													<td>$213</td>
													<td><span class="ecommerce-status completed">Completed</span></td>
												</tr>
											</tbody>
										</table>
										<hr class="solid mt-5 opacity-4">
										<div class="datatable-footer">
											<div class="row align-items-center justify-content-between mt-3">
												<div class="col-md-auto order-1 mb-3 mb-lg-0">
													<div class="d-flex align-items-stretch">
														<div class="d-grid gap-3 d-md-flex justify-content-md-end me-4">
															<select class="form-control select-style-1 bulk-action" name="bulk-action" style="min-width: 170px;">
																<option value="" selected>Bulk Actions</option>
																<option value="delete">Delete</option>
															</select>
															<a href="ecommerce-orders-detail.html" class="bulk-action-apply btn btn-light btn-px-4 py-3 border font-weight-semibold text-color-dark text-3">Apply</a>
														</div>
													</div>
												</div>
												<div class="col-lg-auto text-center order-3 order-lg-2">
													<div class="results-info-wrapper"></div>
												</div>
												<div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
													<div class="pagination-wrapper"></div>
												</div>
											</div>
										</div>
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
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
						<h2 class="font-weight-bold text-6">Prices</h2>
						<div class="right-wrapper">
							<ol class="breadcrumbs">

								<li><span>Home</span></li>

								<li><span>Prices(20 sec)</span></li>

							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<div class="pricing-table row no-gutters mt-3 mb-3">
						<div class="col-lg-4">
							<div class="plan most-popular"  >
							<div class="plan-ribbon-wrapper"><div class="plan-ribbon">Popular</div></div>
								<h3>COMBO<span>2x</span></h3>
								<a class="btn btn-lg btn-primary" href="quotations.php">Sign up</a>
								<ul>
									<li><strong>1 Month</strong> 8,000</li>
									<li><strong>3 Months</strong> 18,000</li>
									<li><strong>6 Months</strong> 30,000</li>
									<li><strong>Value Pack</strong> </li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="plan">
								<h3>Bombay Sweets<span>18/17</span></h3>
								<a class="btn btn-lg btn-primary" href="quotations.php">Sign up</a>
								<ul>
									<li><strong>1 Month</strong> 5,000</li>
									<li><strong>3 Months</strong> 13,500</li>
									<li><strong>6 Months</strong> 24,000</li>
									<li><strong>Unlimited</strong> subdomains</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="plan">
								<h3>ASR Nagar<span>10/4.5</span></h3>
								<a class="btn btn-lg btn-primary" href="quotations.php">Sign up</a>
								<ul>
									<li><strong>1 Month</strong> 3,000</li>
									<li><strong>3 Months</strong> 7,500</li>
									<li><strong>6 Months</strong> 12,000</li>
									<li><strong>Unlimited</strong> subdomains</li>
								</ul>
							</div>
						</div>
					</div>

			<?php include 'rightsidebar.php'; ?>
		</section>
		<?php include 'tags.php'; ?>
		

	</body>
</html>
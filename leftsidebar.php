<aside id="sidebar-left" class="sidebar-left">

	<div class="sidebar-header">
		<div class="sidebar-toggle d-none d-md-flex" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">

				<ul class="nav nav-main">
					<li>
						<a class="nav-link" href="financial_dashboard.php">
							<i class="bx bx-bar-chart-alt" aria-hidden="true"></i>
							<span>Financial Dashboard</span>
						</a>                        
					</li>
					<li>
						<a class="nav-link" href="invoice.php">
							<i class="bx bx-file" aria-hidden="true"></i>
							<span>Invoices</span>
						</a>                        
					</li>
					<li>
						<a class="nav-link" href="quotations.php">
							<i class="bx bx-file" aria-hidden="true"></i>
							<span>Quotations</span>
						</a>                        
					</li>
					<li>
						<a class="nav-link" href="expenses.php">
							<i class="fas fa-balance-scale-left" aria-hidden="true"></i>
							<span>Expenses</span>
						</a>                        
					</li>
					<li>
						<a class="nav-link" href="new_updates.php">
							<i class="bx bx-bell" aria-hidden="true"></i>
							<span>New Updates</span>
						</a>                        
					</li>
					<li>
						<a class="nav-link" href="prices.php">
							<i class="bx bx-dollar" aria-hidden="true"></i>
							<span>Prices</span>
						</a>                        
					</li>
					<li>
						<a class="nav-link" href="accounts.php">
							<i class="bx bx-user" aria-hidden="true"></i>
							<span>Accounts</span>
						</a>                        
					</li>
				</ul>
			</nav>

			<hr class="separator" />

			

		</div>

		<script>
			// Maintain Scroll Position
			if (typeof localStorage !== 'undefined') {
				if (localStorage.getItem('sidebar-left-position') !== null) {
					var initialPosition = localStorage.getItem('sidebar-left-position'),
						sidebarLeft = document.querySelector('#sidebar-left .nano-content');

					sidebarLeft.scrollTop = initialPosition;
				}
			}
		</script>

	</div>

</aside>

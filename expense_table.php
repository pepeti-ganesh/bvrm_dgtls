<?php
// Include the backend logic
include 'expenses_form.php';
?>

<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
<head>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <section class="body">
        <?php include 'header.php'; ?>
        <div class="inner-wrapper">
            <?php include 'leftsidebar.php'; ?>
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

                <!-- Add Expense Button -->
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#expenseModal">
                        Add Expense
                    </button>
                </div>

                <!-- Display Success Message -->
                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                    <div class="alert alert-success">Expense recorded successfully!</div>
                <?php endif; ?>

                <!-- Expense Table -->
                <div class="container mt-5">
                    <h2 class="mb-4">Expenses</h2>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Bill</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expenses as $expense): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($expense['id']); ?></td>
                                    <td><?php echo htmlspecialchars($expense['title']); ?></td>
                                    <td><?php echo htmlspecialchars($expense['description']); ?></td>
                                    <td><?php echo htmlspecialchars($expense['date']); ?></td>
                                    <td>
                                        <?php if (!empty($expense['bill_content'])): ?>
                                            <a href="?download_id=<?php echo $expense['id']; ?>" class="btn btn-sm btn-primary">Download</a>
                                        <?php else: ?>
                                            No Bill
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($expense['amount']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <?php include 'rightsidebar.php'; ?>
    </section>

    <!-- Expense Modal -->
    <div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="expenseModalLabel">Add Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="expense-form" action="" method="POST" enctype="multipart/form-data">
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
                            <input type="file" id="bill" name="bill" class="form-control" accept="application/pdf,image/*">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter Amount Paid" required>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor -->
    
    <?php include 'tags.php'; ?>
</body>
</html>
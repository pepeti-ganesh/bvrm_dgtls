<?php
// Include the backend logic
include 'Client_connect.php';
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
                    <h2 class="font-weight-bold text-6">Clients</h2>
                    <div class="right-wrapper">
                        <ol class="breadcrumbs">
                            <li><span>Home</span></li>
                            <li><span>Clients</span></li>
                        </ol>
                        <a class="sidebar-right-toggle" data-open="sidebar-right"><i
                                class="fas fa-chevron-left"></i></a>
                    </div>
                </header>

                <!-- Add Client Button -->
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clientModal">
                        Add Client
                    </button>
                </div>

                <!-- Display Success Message -->
                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                    <div class="alert alert-success">Client added successfully!</div>
                <?php endif; ?>

                <!-- Clients Table -->
                <div class="container mt-5">
                    <h2 class="mb-4">Clients</h2>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Product Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1; // Sequential numbering
                            foreach ($clients as $client): ?>
                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo htmlspecialchars($client['name']); ?></td>
                                    <td><?php echo htmlspecialchars($client['location']); ?></td>
                                    <td><?php echo htmlspecialchars($client['product_name']); ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm edit-btn"
                                            data-id="<?php echo $client['id']; ?>"
                                            data-name="<?php echo htmlspecialchars($client['name']); ?>"
                                            data-location="<?php echo htmlspecialchars($client['location']); ?>"
                                            data-product_name="<?php echo htmlspecialchars($client['product_name']); ?>">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <?php include 'rightsidebar.php'; ?>
    </section>

    <!-- Client Modal -->
    <div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clientModalLabel">Add Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="client-form" action="" method="POST">

                        <div class="form-group">
                            <label for="name">Client Name:</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter Client Name" required>
                        </div>
                        <div class="form-group">
                            <label for="product_name">Product Name:</label>
                            <input type="text" id="product_name" name="product_name" class="form-control"
                                placeholder="Enter Product Name" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" id="location" name="location" class="form-control"
                                placeholder="Enter Client Location" required>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Client Modal -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Edit Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-client-form">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-name">Client Name:</label>
                            <input type="text" id="edit-name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-product_name">Product Name:</label>
                            <input type="text" id="edit-product_name" name="product_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-location">Location:</label>
                            <input type="text" id="edit-location" name="location" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-primary" id="save-edit-btn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle Edit Button Click
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const location = this.getAttribute('data-location');
                const productName = this.getAttribute('data-product_name');

                // Populate the modal fields
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-location').value = location;
                document.getElementById('edit-product_name').value = productName;

                // Show the modal
                const editModal = new bootstrap.Modal(document.getElementById('editClientModal'));
                editModal.show();
            });
        });

        // Handle Save Changes Button Click
        document.getElementById('save-edit-btn').addEventListener('click', function () {
            const id = document.getElementById('edit-id').value;
            const name = document.getElementById('edit-name').value;
            const location = document.getElementById('edit-location').value;
            const productName = document.getElementById('edit-product_name').value;

            // Send AJAX request to update the client
            fetch('client_connect.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest' // Identify as AJAX request
                },
                body: JSON.stringify({ id, name, location, product_name: productName })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                   

                    // Close the modal
                    const editModalElement = document.getElementById('editClientModal');
                    const editModal = bootstrap.Modal.getInstance(editModalElement);
                    if (editModal) {
                        editModal.hide();
                    }

                    // Update the table row dynamically
                    const row = document.querySelector(`button[data-id="${data.updatedClient.id}"]`).closest('tr');
                    row.querySelector('td:nth-child(2)').textContent = data.updatedClient.name;
                    row.querySelector('td:nth-child(3)').textContent = data.updatedClient.location;
                    row.querySelector('td:nth-child(4)').textContent = data.updatedClient.product_name;

                } else {
                    alert('Error updating client: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the client.');
            });
        });
    </script>
</body>
<?php include 'tags.php'; ?>
</html>
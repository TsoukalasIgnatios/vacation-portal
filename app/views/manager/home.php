<!-- app/views/manager/home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Manager Dashboard</h2>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">User Management</h5>
                <a href="index.php?route=manager/create_user" class="btn btn-primary mb-3">Create New User</a>
        
            <h3>Registered Users</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Employee Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['employee_code']; ?></td>
                            <td>
                                <a href="index.php?route=manager/update_user&id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?route=manager/delete_user&id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm"onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
        <a href="index.php?route=manager/vacation_requests" class="btn btn-primary">View Vacation Requests</a>
        <a href="index.php?route=auth/logout" class="btn btn-secondary">Logout</a>
    </div>
    
</body>
</html>

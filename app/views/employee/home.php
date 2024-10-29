<!-- app/views/employee/home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center" mb-4>Welcome, <?php  echo $_SESSION['user']['name']; ?></h2>
        <a href="index.php?route=employee/request_vacation" class="btn btn-primary mb-3">Request Vacation</a>
        
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">My Vacation Requests</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($requests as $request): ?>
                                <tr>
                                    <td><?php echo $request['start_date']; ?></td>
                                    <td><?php echo $request['end_date']; ?></td>
                                    <td><?php echo $request['reason']; ?></td>
                                    <td><?php echo ucfirst($request['status']); ?></td>
                                    <td>
                                    <?php if ($request['status'] === 'pending'): ?>
                                            <a href="index.php?route=employee/delete_request&id=<?php echo $request['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this request?');">Delete</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <a href="index.php?route=auth/logout" class="btn btn-secondary">Logout</a>
    </div>
        
</body>
</html>

<!-- app/views/manager/vacation_requests.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vacation Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Vacation Requests</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>Employee</th>
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
                            <td><?php echo $request['user_name']; ?></td>
                            <td><?php echo $request['start_date']; ?></td>
                            <td><?php echo $request['end_date']; ?></td>
                            <td><?php echo $request['reason']; ?></td>
                            <td><?php echo ucfirst($request['status']); ?></td>
                            <td>
                                <?php if ($request['status'] == 'pending'): ?>
                                    <a href="index.php?route=manager/approve_request&id=<?php echo $request['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                                    <a href="index.php?route=manager/reject_request&id=<?php echo $request['id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                                <?php else: ?>
                                    <span class="text-muted">No actions available</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
             </table>
         </div>
        <a href="index.php?route=auth/logout" class="btn btn-secondary">Logout</a>
        <a href="index.php?route=manager/home" class="btn btn-link mt-3 d-block text-center">Back to Home</a>
    </div>
</body>
</html>

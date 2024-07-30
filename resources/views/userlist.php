<?php 
include_once '../../auth/session.php';
include_once '../../app/controllers/UserController.php';
Session::checkSession();

$userObj = new UserController();
$data = $userObj->index();
?>

<?php include_once '../views/layout/header.php'; ?>

<style>
    .custom-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 18px;
    text-align: left;
}

.custom-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
}

.custom-table th,
.custom-table td {
    padding: 12px 15px;
}

.custom-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.custom-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.custom-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.custom-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

.custom-table th i {
    margin-left: 5px;
    color: #ffffff;
}

.custom-table td i {
    margin-right: 5px;
    color: #009879;
}


.category-title {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}
</style>

<div class="main-content">
    <h2>User Details</h2>
    <div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search here...">
        </div>
    </div>
    <table class="custom-table">
        <thead>
            <tr>
                <th>ID <i class="fas fa-id-badge"></i></th>
                <th>Username <i class="fas fa-user"></i></th>
                <th>Name <i class="fas fa-envelope"></i></th>
                <th>Created At <i class="fas fa-calendar-alt"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data): ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No data found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include_once '../views/layout/footer.php'; ?>

<?php session_abort();
include_once("./db.php");
$sql = "SELECT * FROM users";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All User | User Management</title>
    <script src="./.library/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao="
        crossorigin="anonymous"></script>
    <!-- Stylesheets -->
    <link href="./.library/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1 class="page-title">All User</h1>
    <?php echo isset($_SESSION['msg']) ? "<span class='notify'>" . $_SESSION['msg'] . "</span>" : ""; ?>
    <?php if (!$res): ?>
        <span class="error">Oops! No user found.</span>
    <?php else: ?>
        <!-- Use DataTables jQuery addon library on this table -->
        <table border="1" id="dataTable" cellspacing="0" cellpadding="6">
            <thead>
                <tr>
                    <th>#</th>
                    <th>E-Mail</th>
                    <th>Full Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)):
                    $i++; ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td>
                            <a href="./edit.php?id=<?php echo $row['id']; ?>" title="" class="text-link">Edit</a> &nbsp;|&nbsp;
                            <a href="./delete.php?id=<?php echo $row['id']; ?>" title="" class="text-link danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <hr>
    <a href="./logout.php" class="text-link" title="">Logout</a>
    <hr>
    <a href="./index.php" class="text-link" title="">Back to Home</a>

    <!-- Scripts -->
    <script src="./.library/datatables.min.js"></script>
    <script src="./script.js"></script>
    <script>
        const table = new DataTable('#dataTable', {
            // Configuration options
        });
    </script>
</body>
</html>

<?php unset($_SESSION['msg']); ?>
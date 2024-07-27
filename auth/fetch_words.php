<?php include_once '../app/db.php'; ?>
<?php

    $dbObj = new Db();
    $filter = isset($_GET['filter']) ? trim($_GET['filter']) : '';

    $sql = "SELECT name, meaning FROM words";
    if ($filter !== '') {
        $sql .= " WHERE name LIKE '$filter%'";
    }

    $result = $dbObj->select($sql);

    $words = [];

    if ($result->num_rows > 0) {
        // Fetch all results into an associative array
        while($row = $result->fetch_assoc()) {
            $words[] = $row;
        }
    }

    // Return the data as JSON
    echo json_encode($words);

?>
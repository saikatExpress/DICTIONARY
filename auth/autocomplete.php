<?php include_once '../app/db.php'; ?>
<?php
$dbObj = new DB();

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    
    $sql = "SELECT name FROM words WHERE name LIKE '%$term%' LIMIT 10";
    $result = $dbObj->select($sql);
    
    $suggestions = array();
    
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['name'];
    }
    
    echo json_encode($suggestions);
}

?>
<?php include_once '../app/db.php'; ?>
<?php

$dbObj = new DB();

if (isset($_GET['word'])) {
    $word = $_GET['word'];
    
    $sql = "SELECT category, meaning FROM words WHERE name = '$word'";
    $result = $dbObj->select($sql);
    
    $meanings = array();

    while ($row = $result->fetch_assoc()) {
        $category = $row['category'];
        if (!isset($meanings[$category])) {
            $meanings[$category] = array();
        }
        $meanings[$category][] = $row['meaning'];
    }

    echo json_encode(array('success' => true, 'meanings' => $meanings));
}else {
    echo json_encode(array('success' => false));
}

?>
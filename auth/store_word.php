<?php include_once '../app/db.php'; ?>
<?php
$dbObj = new DB();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $word = ucwords(trim($_POST['word']));
    $slug = strtolower($_POST['word']);
    $meaning = $_POST['meaning'];
    $noun = strtolower($_POST['word']);
    $firstLetter = strtoupper(substr($word, 0, 1));

    $checkSql = "SELECT COUNT(*) AS count FROM words WHERE name = '$word'";

    $existWord = $dbObj->select($checkSql);
    $row = $existWord->fetch_assoc();

    if ($row['count'] > 0) {
        echo "The word '$word' already exists in the database.";
        exit();
    }
    
    $sql = "INSERT INTO words (category, `groups`, name, slug, meaning, noun) VALUES ('$firstLetter', '$firstLetter', '$word', '$slug', '$meaning', '$noun')";

    if ($dbObj->insert($sql) === TRUE) {
        echo "New record created successfully.";
    } else {
        echo "Error: Something went wrong";
    }
}
?>

<?php include_once '../app/db.php'; ?>
<?php

class Post
{
    private $table = 'posts';
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function create($content, $userId)
    {
        $lines = explode("\n", $content);
        $title = trim($lines[0]);

        // Remove the first line from content
        $bodyContent = implode("\n", array_slice($lines, 1));

        // $content = htmlspecialchars(strip_tags($content));

        $query = "INSERT INTO posts(created_by,title,content)VALUES('$userId','$title', '$content')";

        $res = $this->db->insert($query);

        if($res === true){
            return true;
        }else{
            return false;
        }
    }

}

?>
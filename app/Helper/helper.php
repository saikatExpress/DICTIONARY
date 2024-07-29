<?php include_once '../../app/db.php'; ?>
<?php

function stringGenerate()
{
    $name = 'DICTIONARY';
}

function wordOftheDay()
{
    $dbObj = new DB();

    $sql = "SELECT name FROM words ORDER BY RAND() LIMIT 1";

    $data = $dbObj->select($sql);

    $result = $data->fetch_assoc();

    return $result['name'];
}

function todaysSentences()
{
    $dbObj = new DB();

    $sql = "SELECT * FROM sentences ORDER BY RAND() LIMIT 5";

    $data = $dbObj->select($sql);
    foreach($data as $value){ ?>
        <?php
        $dateTime = new DateTime($value['created_at']);
        $formattedDateTime = $dateTime->format('d M, y h:i A');
        $shortSentenceName = substr($value['category'], 0, 3);
        ?>
        <div class="post">
            <h5><?= htmlspecialchars($value['sentence_name'], ENT_QUOTES, 'UTF-8') ?></h5>
            <p style="margin-top: 8px;;"><span style="font-size: 10px; font-weight:600;color:blue;"><i class="fas fa-tag category"></i></span> : <?= htmlspecialchars($value['sentence_meaning'], ENT_QUOTES, 'UTF-8') ?></p>
            <div class="info">
                <i class="fas fa-tag category"></i> <?= htmlspecialchars(ucfirst($shortSentenceName), ENT_QUOTES, 'UTF-8') ?>
                &nbsp;|&nbsp;
                <i class="fas fa-calendar-alt date-time"></i> <?= htmlspecialchars($formattedDateTime, ENT_QUOTES, 'UTF-8') ?>
                &nbsp;|&nbsp;
                <i class="fas fa-lock privacy"></i> <?= htmlspecialchars($value['privacy'], ENT_QUOTES, 'UTF-8') ?>
            </div>
        </div>
    <?php }
    
}

?>
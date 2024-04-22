<?php
//   include 'posts.php';

const HOST = 'localhost';
const USERNAME = 'x4la';
const PASSWORD = 's1230400102s';
const DATABASE = 'blog';




function createDBConnection(): mysqli
{
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "Connected successfully<br>";
    return $conn;
}

function closeDBConnection(mysqli $conn): void
{
    $conn->close();
}


function getAndPrintpostsFromDB(mysqli $conn): array
{
    $posts = [];
    $sql = "SELECT * FROM post";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['content'] = json_decode($row['content']);
            $posts[] = $row;
        }
    } else {
        echo "0 results";
    }
    return $posts;
}



$conn = createDBConnection();
$posts = getAndPrintpostsFromDB($conn);
closeDBConnection($conn);

$postId = (int)$_GET['id'];
if ($postId == 0) {
    echo 'Wrond post ID!';
    die();
}
// echo $postId;  
$index = array_search($postId, array_column($posts, 'id'));
if ($index === false) {
    header("HTTP/1.1 404 Not Found");
    die();
}
$current_post = $posts[$index];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/static/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.cdnfonts.com/css/lora');
    </style>
</head>

<body>
    <div class="all">
        <header class="base">
            <div class="escape">
                <a>Escape.</a>
            </div>
            <div class="buttons">
                <a>HOME</a>
                <a>CATEGORIES</a>
                <a>ABOUT</a>
                <a>CONTACT</a>
            </div>
        </header>
        <div class="head">
            <div class="title">
                <?= $current_post['title'] ?>
            </div>
            <div class="comment">
                <?= $current_post['subtitle'] ?>
            </div>
        </div>
        <div>
            <img src="<?= $current_post['image_url'] ?>" class="image">
        </div>
        <div class="text">
            <?php
            if ($current_post['content'] != null) {
                if (count($current_post['content']) != 0) {
                    $current_post['content'][0];
                }
                for ($i = 1; $i < count($current_post['content']); $i++) {
                    echo '<br>';
                    echo '<br>';
                    echo $current_post['content'][$i];
                }
            } else {
                echo 'Content missing!';
            }
            ?>
        </div>
        <div class="footer">
            <footer>
                <div class="escape">
                    <a id="escape">Escape.</a>
                </div>
                <div class="buttons opacity">
                    <a class="opacity">HOME</a>
                    <a class="opacity">CATEGORIES</a>
                    <a class="opacity">ABOUT</a>
                    <a class="opacity">CONTACT</a>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
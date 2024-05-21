<?php

function saveImage(string $imageBase64): string
{
    $imageBase64Array = explode(';base64,', $imageBase64);
    $imgExtention = str_replace('data:image/', '', $imageBase64Array[0]);
    $imageDecoded = base64_decode($imageBase64Array[1]);
    $fopen = "static/images/image.{$imgExtention}";
    $file = fopen("static/images/image.{$imgExtention}", 'w');
    try {
        fwrite($file, $imageDecoded);
    } finally {
        fclose($file);
    }
    return $fopen;
}

function saveFile(string $file, string $data): void
{
    $myFile = fopen($file, 'w');
    if ($myFile) {
        $result = fwrite($myFile, $data);
        if ($result) {
            echo 'Данные успешно сохранены в файл';
        } else {
            echo 'Произошла ошибка при сохранении данных в файл';
        }
        fclose($myFile);
    } else {
        echo 'Произошла ошибка при открытии файла';
    }
}

echo 'Admin panel';

const HOST = 'localhost';
const USERNAME = 'x4la';
const PASSWORD = 's1230400102s';
const DATABASE = 'blog';



//TODO dodelatb


function savePostInDB(mysqli $conn): void
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dataAsJson = file_get_contents("php://input");
        $dataAsArray = json_decode($dataAsJson, true);
        $img_url = saveImage($dataAsArray['image']);
        $img_url = './' . $img_url;
    }
    $statement = $conn->prepare("INSERT INTO post (title, subtitle, content, author, author_url, publishdate, image_url, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param("sssssssi", $_POST['title'], $_POST['subtitle'], $_POST['content'], $_POST['author'], $_POST['author_url'], $_POST['publishdate'], $img_url, $_POST['featured']);
    $statement->execute();
    if ($statement->affected_rows > 0) {
        echo "New record created successfully";
    } else {
        echo "Error: " . "<br>" . $conn->error;
    }
    closeDBConnection($conn);

}


$conn = createDBConnection();
savePostInDB($conn);
closeDBConnection($conn);




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

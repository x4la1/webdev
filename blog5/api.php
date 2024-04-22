<?php

function saveImage(string $imageBase64)
{
    $imageBase64Array = explode(';base64,', $imageBase64);
    $imgExtention = str_replace('data:image/', '', $imageBase64Array[0]);
    $imageDecoded = base64_decode($imageBase64Array[1]);
    $file = fopen("static/images/image.{$imgExtention}", 'w');
    try {
        fwrite($file, $imageDecoded);
    } finally {
        fclose($file);
    }
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


function savePostInDB(mysqli $conn,array $arr): void
{
    $sql = "INSERT INTO post (title, subtitle, content, author, author_url, publishdate, image_url, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = $conn->prepare($sql);

}


$conn = createDBConnection();
savePostInDB($conn, $_POST);
closeDBConnection($conn);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dataAsJson = file_get_contents("php://input");
    $dataAsArray = json_decode($dataAsJson, true);
    saveImage($dataAsArray['image']);
}





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

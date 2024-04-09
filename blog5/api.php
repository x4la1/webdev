<?php
function saveImage(string $imageBase64) {
    $imageBase64Array = explode(';base64,', $imageBase64);
    $imgExtention = str_replace('data:image/', '', $imageBase64Array[0]);
    $imageDecoded = base64_decode($imageBase64Array[1]);
    $file = fopen("image.{$imgExtention}", 'w');
    try {
        fwrite($file, $imageDecoded);
    } finally {
        fclose($file);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dataAsJson = file_get_contents("php://input");
    $dataAsArray = json_decode($dataAsJson, true);
    if ($dataAsArray && $dataAsArray['image']) {
        saveImage($dataAsArray['image']);
    } else {
        echo 'Ошибка';
    }
}
?>
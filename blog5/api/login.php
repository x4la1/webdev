<?php

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
    return $conn;
}

function closeDBConnection(mysqli $conn): void
{
    $conn->close();
}

function findUserInDB(mysqli $conn):  void
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dataAsJson = file_get_contents("php://input");
        $dataAsArray = json_decode($dataAsJson, true);
    }
    $salt = 'MyPass';
    $pass = md5(md5((string)$dataAsArray['password']) . $salt);
    $email = $dataAsArray['login'];
    $query = "SELECT user_id FROM user WHERE email = ? AND password = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("ss", $email, $pass);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['user_id'];
        session_name('auth');
        session_start();
        $_SESSION['user_id'] = $userId; 
        header('HTTP/1.1 200 OK'); 
    } else {
        header('HTTP/1.1 401 Unauthorized');
    }
    closeDBConnection($conn);
}

$conn = createDBConnection();
findUserInDB($conn);
<?php
// Reference:
// https://www.leaseweb.com/labs/2015/10/creating-a-simple-rest-api-in-php/

// Use this API for demonstration purposes only
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Get the HTTP method, path, and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));
$input = json_decode(file_get_contents('php://input'), true);

// Connect to the MySQL database, provide the appropriate credentials
//$conn = mysqli_connect('localhost', 'root', '', 'your_db_name');
$conn = mysqli_connect('feenix-mariadb.swin.edu.au', 's104082552', '111004', 's104082552_db');
mysqli_set_charset($conn, 'utf8');

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize the table name accordingly
$table = "reviews";

// Retrieve the search key field name and value from the path
$fld = preg_replace('/[^a-z0-9_]+/i', '', array_shift($request));
$key = array_shift($request);

// Retrieve the data to prepare set values
if (isset($input)) {
    $columns = preg_replace('/[^a-z0-9_]+/i', '', array_keys($input));
    $values = array_map(function ($value) use ($conn) {
        if ($value === null) return null;
        return mysqli_real_escape_string($conn, (string)$value);
    }, array_values($input));

    $set = '';
    for ($i = 0; $i < count($columns); $i++) {
        $set .= ($i > 0 ? ',' : '') . '`' . $columns[$i] . '`=';
        $set .= ($values[$i] === null ? 'NULL' : '"' . $values[$i] . '"');
    }
}

// Create SQL
switch ($method) {
    case 'GET':
        $sql = "SELECT * FROM `$table`" . ($key ? " WHERE $fld='$key'" : '');
        break;
    case 'PUT':
        $sql = "UPDATE `$table` SET $set WHERE " . ($key ? "$fld='$key'" : "0=1");
        break;
    case 'POST':
        $sql = "INSERT INTO `$table` SET $set";
        break;
    case 'DELETE':
        $sql = "DELETE FROM `$table` WHERE " . ($key ? "$fld='$key'" : "0=1");
        break;
}

// Execute SQL statement
$result = mysqli_query($conn, $sql);
if ($result) {
    if ($method == 'GET') {
        header('Content-Type: application/json');
        echo '[';
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
        }
        echo ']';
    } elseif ($method == 'POST') {
        echo mysqli_insert_id($conn);
    } else {
        echo mysqli_affected_rows($conn);
    }
}

// Close MySQL connection
mysqli_close($conn);

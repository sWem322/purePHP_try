<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// конфиг файл
include 'db_connect.php';
//конект к БД
$conn = connect();
// TEST CONNECT 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
//запрос в бд
$firstRequest = "SELECT device_uuid, device_type, device_name, device_updated FROM device";
// $jsonRequest  = "SELECT device_endpoints FROM device";
////
$result = $conn->query($firstRequest);
// $json   = $conn->query($jsonRequest);
// var_dump(json_decode($json));

//вывод данных из БД
if ($result > 0) {
       while($row = $result->fetch_array()) {
        echo "<br> - Device_uuid: ". $row["device_uuid"]. "<br> - Type: ". $row["device_type"]. " <br> - Name: " . $row["device_name"]. "<br> - Updated: " . $row["device_updated"]. " <br> - Endpoints: " . $row["device_endpoints"]. "<br>";
    }
} else {
    echo "0 results";
}

// закрываем конект
closeCon($conn);
?>
    
</body>
</html>

<!-- echo "<br> - Device_uuid: ". $row["device_uuid"]. "<br> - Type: ". $row["device_type"]. " <br> - Name: " . $row["device_name"]. " <br> - Endpoints: " . $row["device_endpoints"]. "<br>";
 -->
<?php
// конфиг файл
include_once 'db_connect.php';

//конект к БД
$conn = connect();

// TEST CONNECT 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//запрос в бд
$firstRequest = "SELECT device_uuid, device_type, device_name, device_updated FROM device";


$result = $conn->query($firstRequest);

//вывод данных из БД
$comma = false;
if ($result > 0) {
    echo "[";
       while($row = $result->fetch_array()) {
        $arr = [
            "Device_uuid" => $row["device_uuid"],
            "Device_type" => $row["device_type"],
            "Device_name" => $row["device_name"],
            "Device_updated" => $row["device_updated"]];

        if ($comma) {
            echo ",";
        }  else {
                $comma = true;
            }
        echo json_encode($arr);
    }
    echo "]";
} else {
    echo "0 results";
}

// закрываем конект
closeCon($conn);
?>
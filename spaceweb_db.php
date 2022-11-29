<?php
class Spaceweb_db {

    var $mysqli;
    var $data_start = 1645099416;
    var $data_end   = 1645099517;
    public function connect($server, $user, $pass, $connect_db) {
        $this->mysqli = new mysqli($server, $user, $pass, $connect_db);
        return $this->mysqli->connect_error == 0;
    }

    public function close_conn() {
        $this->mysqli->close();
    }

    public function device_list() {
        $array = array();
        $result = $this->mysqli->query('SELECT device_uuid, device_name FROM device');
        if ($result) {
            while ($row = $result->fetch_array()) {
                $array[] = [
                    'Device_uuid' => $row['device_uuid'],
                    'Device_name' => $row['device_name'],
                ];
            }
        } else {
            echo '0 results';
        }
        return $array;
    }
    public function device_info($device_uuid) {
        $stmt = $this->mysqli->prepare('SELECT device_uuid, device_type, device_name, device_created, device_updated, device_language 
                                        FROM device
                                        WHERE device_uuid = ?');
        $stmt->bind_param('s', $device_uuid);
        $stmt->execute();
        $result = $stmt->get_result();
        $array = array();
        $comma  = false;
        if ($result) {
            while ($row = $result->fetch_array()) {
                $array[] = [
                    'Device_uuid'     => $row['device_uuid'],
                    'Device_type'     => $row['device_type'],
                    'Device_name'     => $row['device_name'],
                    'Device_created'  => $row['device_created'],
                    'Device_updated'  => $row['device_updated'],
                    'Device_language' => $row['device_language'],
                ];
            }
        } else {
            echo '0 results';
        }
        return $array;
    }
    public function measurment_list($device_uuid) {
        $stmt = $this->mysqli->prepare('SELECT a_base, b_base FROM (
                                                SELECT a.endpoint_raw_data_timebase 
                                                AS a_base, min(b.endpoint_raw_data_timebase) AS b_base
                                                FROM endpoint_raw_data AS a
                                                JOIN endpoint_raw_data AS b
                                                WHERE a.endpoint_raw_data_timebase < b.endpoint_raw_data_timebase 
                                                AND a.device_uuid = ?
                                                AND b.device_uuid = ?
                                                GROUP BY a_base) AS c
                                        WHERE b_base - a_base >= 30
                                        ORDER BY a_base ASC;');
        $stmt->bind_param('ss', $device_uuid, $device_uuid);
        $stmt->execute();
        $result = $stmt->get_result();
        $comma = false;
        if ($result) {
            while ($row = $result->fetch_array()) {
                $array = [
                    'start' => $row['a_base'],
                    'end' => $row['b_base'],
                ];
                if ($comma) {
                    echo ',';
                } else {
                    $comma = true;
                }
                echo json_encode($array);
            }
            echo ']';
        } else {
            echo 'o results';
        }
    }
    public function measurment_data() {
        $stmt = $this->mysqli->prepare('SELECT * FROM endpoint_raw_data 
                                        WHERE endpoint_raw_data_timebase >= ?
                                        AND endpoint_raw_data_timebase <= ?
                                        AND device_uuid = ?;');
        $stmt->bind_param('iis', $this->data_start, $this->data_end, $this->device);
        $stmt->execute();
        $result = $stmt->get_result();
        $comma = false;
        if ($result) {
            while ($row = $result->fetch_array()) {
                $array = [
                    'ID' => $row['endpoint_id'],
                    'Time' => $row['endpoint_raw_data_timebase'],
                    'microTime' => $row['endpoint_raw_data_timeshift'],
                    'Value' => $row['endpoint_raw_data_value'],
                ];
                if ($comma) {
                    echo ',';
                } else {
                    $comma = true;
                }
                echo json_encode($array);
            }
            echo ']';
        } else {
            echo 'o results';
        }
    }
}
?>

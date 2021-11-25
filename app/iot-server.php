<?php
$conn_string = 'mongodb://192.168.11.75:27017/';
$method = $_SERVER['REQUEST_METHOD'];
echo "$method::Welcome to iot-server " . "<br>";
echo $conn_string . "<br>";
// echo $clientid, ' ', $lastname, PHP_EOL;
try {
    $m = new MongoDB\Driver\Manager($conn_string);
    
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        $data = json_decode(file_get_contents("php://input"));
        // Bulk write inserts
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert(['identifier' => "$data->identifier",'value' => "$data->value", 'date' => "$data->date"]);
        $m->executeBulkWrite('admin_iot.eMeter', $bulk);
        echo "200 OK, Records added successfully!!" . "<br>";
    } else {
        echo "Connection to database successfully" . "<br>";
    }
}
catch (Throwable $e) {
    // catch throwables when the connection is not a success
    echo "Captured Throwable for connection : " . $e->getMessage() . PHP_EOL;
}
?>
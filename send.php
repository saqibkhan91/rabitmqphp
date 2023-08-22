<?php


require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'admin', 'Arshad_123');
$channel = $connection->channel();

$channel->queue_declare('json_queue', false, true, false, false);

$messageData = ['key' => 'XYZ', 'data' => 'data'];
$message = new AMQPMessage(json_encode($messageData));

$channel->basic_publish($message, '', 'json_queue');

    echo " Massage Send Successfuly. \n";

$channel->close();
$connection->close();









//require_once __DIR__ . '/vendor/autoload.php';
//
//use PhpAmqpLib\Connection\AMQPStreamConnection;
//use PhpAmqpLib\Message\AMQPMessage;
//
//require_once("classDatabaseManager.php");
//
//$connection = new AMQPStreamConnection('localhost', 5672, 'admin', 'Arshad_123');
//$channel = $connection->channel();
//
//$queueName = 'my_queue';
//$exchangeName = 'my_exchange';
//
//$channel->queue_declare($queueName, false, true, false, false);
//$channel->exchange_declare($exchangeName, 'direct', false, true, false);
//$channel->queue_bind($queueName, $exchangeName);
//
//echo "Waiting for messages. To exit press CTRL+C\n";
//
//$callback = function ($msg) {
//    $data = json_decode($msg->body, true);
//
//    if (isset($data['key']) && $data['key'] === 'ABC') {
//        if (isset($data['name'])) {
//            $name = $data['name'];
//
//
//            $dbCon = new DatabaseManager();
//            $query = "INSERT INTO Form (name) VALUES ('saqib')";
//            $inserted = $dbCon->executeQuery($query, array($name), "create");
//
//            if ($inserted) {
//                echo "Data inserted successfully.\n";
//            } else {
//                echo "Insert query failed.\n";
//            }
//        } else {
//            echo "Name not set in input data.\n";
//        }
//    } else {
//        echo "Key is not 'ABC'.\n";
//    }
//};
//
//$channel->basic_consume($queueName, '', false, true, false, false, $callback);
//
//while ($channel->is_consuming()) {
//    $channel->wait();
//}
//
//$channel->close();
//$connection->close();





//
//require_once __DIR__ . '/vendor/autoload.php';
//use PhpAmqpLib\Connection\AMQPStreamConnection;
//use PhpAmqpLib\Message\AMQPMessage;
//
//$connection = new AMQPStreamConnection('localhost', 5672, 'admin', 'Arshad_123');
//$channel = $connection->channel();
//
//$channel->queue_declare('hello', false, false, false, false);
//
//$data = [
//    'key1' => "its me \n",
//    'key2' => "how are You \n",
//    'key3' => "its correct \n",
//    'key' => "ABCD"
//];
//
//function processMessages($data) {
//    $output = [];
//    foreach ($data as $key => $value) {
//        $sqlQuery = "INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...)";
//
//        if ($key === 'key' && $value === 'ABC') {
//            $output[] = " [x] Running SQL query: $sqlQuery";
//        } else {
//            $output[] = " [x] Running Value: $value";
//        }
//    }
//    return $output;
//}
//
//$jsonData = json_encode(processMessages($data), JSON_PRETTY_PRINT);
//
//$msg = new AMQPMessage($jsonData);
//
//$channel->basic_publish($msg, '', 'hello');
//
//echo "Sent JSON data :\n$jsonData\n";
//
//$channel->close();
//$connection->close();
?>

<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'admin', 'Arshad_123');
$channel = $connection->channel();

$channel->queue_declare('json_queue', false, true, false, false);

$callback = function ($msg) {
    $messageData = json_decode($msg->body, true);

    if ($messageData['key'] === 'ABC') {
        $dbConnection = new mysqli(localhost, root, Arshad_123, users);

        if ($dbConnection->connect_error) {
            die("Connection failed: " . $dbConnection->connect_error);
        }

        $query = "INSERT INTO Form (name) VALUES ('saqib')";

        if ($dbConnection->query($query) === true) {
            echo "Data inserted successfully.\n";
        } else {
            echo "Error: " . $dbConnection->error . "\n";
        }

        $dbConnection->close();
    }else if($messageData['key'] === 'XYZ'){
        $dbConnection = new mysqli(localhost, root, Arshad_123, users);

        if ($dbConnection->connect_error) {
            die("Connection failed: " . $dbConnection->connect_error);
        }

        $query = "UPDATE Form SET name = 'Hadi' WHERE id=7";

        if ($dbConnection->query($query) === true) {
            echo "Data Updated successfully.\n";
        } else {
            echo "Error: " . $dbConnection->error . "\n";
        }
    }else{
        echo "No Query Run at this Time";
    }
};

$channel->basic_consume('json_queue', '', false, true, false, false, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();


?>

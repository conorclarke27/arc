<?php
//setup
   $address = 'localhost';
   $service_port = 8080;
   $timeout = 30;  
//create
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if(!socket_set_block($socket))
     {
         echo "BOOOOOOOOOOOO";
     }
//more settings
    $error = NULL;
    $attempts = 0;
    $timeout *= 1000;
    $connected = FALSE;
//connection and check
    $connected = @socket_connect($socket, $address, $service_port);
    if (!$connected)
    {
        $error = socket_last_error();
        if ($error != 10035 && $error != SOCKET_EINPROGRESS && $error != SOCKET_EALREADY) {
            echo "Error Connecting Socket: ".socket_strerror($error) . "\n";
            socket_close($socket);
            exit();
        }
    }


    
    $close = false; 
    
    if($close){
        socket_close($socket);
    }
?>
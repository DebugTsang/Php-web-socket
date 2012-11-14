<?php
setServerSocket('localhost', 9006);


function setServerSocket($address, $port){
    set_time_limit (0);
    // Create a TCP Stream socket
    $sock = socket_create(AF_INET, SOCK_STREAM, 0);
    socket_bind($sock, $address, $port) or die('Could not bind to address');
    socket_listen($sock);
    printf("Socket Server is running...\n");
    /* Accept incoming requests and handle them as child processes */
    $client = socket_accept($sock);	
    printf("client accept");
    $is_repeat = true;
    while($is_repeat){
        $input = socket_read($client, 1024);
        /*
        $output = preg_replace("[ \t\n\r]","","reply from server: ".$input);
        echo "Command: <br>".$input;
		*/
        if($input){
        	if ($input == 'c1'){
        		$out = 's1';
	        	socket_write($client, $out, strlen($out));
        	}else 
        	if ($input == 'c2'){
	        	$out = 's2';
	        	socket_write($client, $out, strlen($out));
	        	
        	}else{
	        	$is_repeat = false;
        	}
        	
        	printf("input:".$input."\n");
/*             $output = 'From server: '.$input; */
//            printf($output);
/*             socket_write($client, $output); */
        }
    }

    socket_close($client);
    
    socket_close($sock);
}
?>
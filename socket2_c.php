<?php


echo "return:".setClientSocket('localhost',9006,'c1');

function setClientSocket($hostname,$port,$msg){
    $msg = $msg;
    $response = '';
    $address = gethostbyname($hostname);
    $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
    $result =  @socket_connect($socket,$address,$port);
    
    if ($result == FALSE) return 'ERROR';
    
    //$response .= 'connect: '.$result.'<br>';
    //$response .= 'socket_write: '.$final_msg.'('.strlen($final_msg).')'.'<br>';
    socket_write($socket,$msg,strlen($msg));

/*     $response .= socket_read($socket,1024); */
	$response = socket_read($socket, 1024);
    while ($response){
	    printf("CLIENT:".$response."\n");    	
    	if ($response == 's1'){
	    	$msg = 'c2';
	    	socket_write($socket, $msg, strlen($msg));
    	}else     	
    	if ($response == 's2'){
	    	$msg = 'c3';
	    	socket_write($socket, $msg, strlen($msg));
	    	break;
    	}else{
	    	print("!\n");
	    	break;
    	}
    	$response = socket_read($socket, 1024);
    }
    
    socket_shutdown($socket);
    socket_close($socket);
    return $response;
}
?>
 
 
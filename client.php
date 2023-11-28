<?php
// Client setup
$host = '127.0.0.1';
$port = 3000;

// Create a socket
$client = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// Connect to the server
socket_connect($client, $host, $port);

// Send a request to the server
$request = "Hello, server! How are you?";
socket_write($client, $request, strlen($request));

// Receive and print the response from the server
$response = socket_read($client, 1024);
echo "Server's response: $response\n";

// Close the connection
socket_close($client);

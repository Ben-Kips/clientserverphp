<?php
// Server setup
$host = '127.0.0.1';
$port = 3000;

// Create a socket
$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($server === false) {
    die("Error creating socket: " . socket_strerror(socket_last_error()));
}

// Allow reuse of the local address
socket_set_option($server, SOL_SOCKET, SO_REUSEADDR, 1);

// Bind the socket
if (!socket_bind($server, $host, $port)) {
    die("Error binding socket: " . socket_strerror(socket_last_error($server)));
}

// Listen for incoming connections
if (!socket_listen($server)) {
    die("Error listening for connections: " . socket_strerror(socket_last_error($server)));
}

echo "Server is listening for connections...\n";

while (true) {
    // Accept incoming connection
    $client = socket_accept($server);

    if ($client === false) {
        die("Error accepting connection: " . socket_strerror(socket_last_error($server)));
    }

    // Handle client request
    $data = socket_read($client, 1024);
    echo "Received request from client: $data\n";

    // Send a response back to the client
    $response = "Hello, client! Your request was received.";
    socket_write($client, $response);

    // Close the connection
    socket_close($client);
}

// Close the server socket (this code will not be reached in the loop)
socket_close($server);

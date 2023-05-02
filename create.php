<?php
// Define the credentials for the Sender user type
$sender_username = 'sender';
$sender_password = 'sender_password';

// Get the credentials from the HTTP request
$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];
if ($username == $sender_username && $password == $sender_password) {
    // Get the data from the request
    $recipient_name    = $_POST['recipient_name'];
    $recipient_address = $_POST['recipient_address'];
    $sender_name       = $_POST['sender_name'];
    $sender_address    = $_POST['sender_address'];
    $weight            = $_POST['weight'];
    $status            = 'Pending';

    // Insert the data into the database
    $pdo  = new PDO('mysql:host=localhost;dbname=parcels', 'username', 'password');
    $sql  = 'INSERT INTO parcels (recipient_name, recipient_address, sender_name, sender_address, weight, status) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recipient_name, $recipient_address, $sender_name, $sender_address, $weight, $status]);

    // Return a success message
    echo json_encode(['message' => 'Parcel added successfully']);
} else {
    echo 'Access Denied!';
}

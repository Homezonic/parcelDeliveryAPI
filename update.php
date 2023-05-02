<?php
// Define the credentials for the Sender user type
$sender_username = 'sender';
$sender_password = 'sender_password';

// Get the credentials from the HTTP request
$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

// Check if the credentials match the Sender user type
if ($username == $sender_username && $password == $sender_password) {
    // Get the parcel ID and new data from the request
    $parcel_id         = $_POST['id'];
    $recipient_name    = $_POST['recipient_name'];
    $recipient_address = $_POST['recipient_address'];
    $sender_name       = $_POST['sender_name'];
    $sender_address    = $_POST['sender_address'];
    $weight            = $_POST['weight'];
    $status            = $_POST['status'];

    // Update the parcel in the database
    $pdo  = new PDO('mysql:host=localhost;dbname=parcels', 'username', 'password');
    $sql  = 'UPDATE parcels SET recipient_name = ?, recipient_address = ?, sender_name = ?, sender_address = ?, weight = ?, status = ? WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recipient_name, $recipient_address, $sender_name, $sender_address, $weight, $status, $parcel_id]);

    // Return a success message
    echo json_encode(['message' => 'Parcel updated successfully']);
} else {
    echo 'Access Denied!';
}

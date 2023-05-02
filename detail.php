<?php

// Get the parcel ID from the request
$parcel_id = $_GET['id'];

// Define the credentials for the Recipient user type
$recipient_username = 'recipient';
$recipient_password = 'recipient_password';

// Get the credentials from the HTTP request
$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

// Check if the credentials match the Recipient user type
if ($username == $recipient_username && $password == $recipient_password) {
    // Query the database for the parcel with the given ID
    $pdo  = new PDO('mysql:host=localhost;dbname=parcels', 'username', 'password');
    $sql  = 'SELECT * FROM parcels WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$parcel_id]);
    $parcel = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the parcel data as JSON
    echo json_encode($parcel);
} else {
    echo 'Access Not Granted!!';
}

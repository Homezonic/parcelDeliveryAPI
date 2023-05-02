<?php

// Get the parcel ID from the request
$parcel_id = $_POST['id'];

// Delete the parcel from the database
$pdo  = new PDO('mysql:host=localhost;dbname=parcels', 'username', 'password');
$sql  = 'DELETE FROM parcels WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$parcel_id]);

// Return a success message
echo json_encode(['message' => 'Parcel deleted successfully']);

<?php

// Query the database for all parcels
$pdo     = new PDO('mysql:host=localhost;dbname=parcels', 'username', 'password');
$sql     = 'SELECT * FROM parcels';
$stmt    = $pdo->query($sql);
$parcels = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the parcel data as JSON
echo json_encode($parcels);

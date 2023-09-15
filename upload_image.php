<?php
session_start();
// Define the directory to save the images
$imageDirectory = 'assets/upload/';

if (!isset($_SESSION['login'])) {
    exit();
}

if (!$_SESSION['login']) {
    exit();
}

// Create the directory if it doesn't exist
if (!file_exists($imageDirectory)) {
    mkdir($imageDirectory, 0777, true);
}

// Check if the POST request contains an image
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $tempFilePath = $_FILES['image']['tmp_name'];
    $originalFileName = $_FILES['image']['name'];

    // Generate a unique filename for the image
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $uniqueFileName = uniqid() . '.' . $fileExtension;

    // Move the uploaded image to the destination directory
    $destinationPath = $imageDirectory . $uniqueFileName;
    move_uploaded_file($tempFilePath, $destinationPath);

    // Get the ID from the POST request
    $id = $_POST['id'];

    // Read the existing JSON file
    $jsonFile = 'res/storage.json';
    $jsonData = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

    // Update the JSON data with the ID and image path
    $jsonData[$id] = $destinationPath;

    // Save the updated JSON data back to the file
    file_put_contents($jsonFile, json_encode($jsonData, JSON_PRETTY_PRINT));

    // Send a response indicating success
    echo json_encode(['message' => 'Image uploaded successfully']);
} else {
    // Send an error response
    echo json_encode(['error' => 'Image upload failed']);
}
?>

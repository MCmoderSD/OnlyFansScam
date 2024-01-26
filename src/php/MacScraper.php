<?php

// Function to read MAC addresses from the file
function readMacAddresses($file) {
    $macAddresses = [];
    if (file_exists($file)) {
        $macAddresses = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    return $macAddresses;
}

// Function to write a new MAC address to the file
function writeMacAddress($file, $macAddress) {
    file_put_contents($file, $macAddress . PHP_EOL, FILE_APPEND | LOCK_EX);
}

// Path to the file storing MAC addresses
$macListFile = '../content/data/mac-addresses.txt'; // Adjust the path based on your directory structure

// Get the client's MAC address from the request (you may need to adapt this depending on your application)
$clientMacAddress = isset($_GET['mac']) ? $_GET['mac'] : null;

if ($clientMacAddress) {
    // Read existing MAC addresses
    $existingMacAddresses = readMacAddresses($macListFile);

    // Check if the client's MAC address already exists
    if (in_array($clientMacAddress, $existingMacAddresses)) {
        echo "MAC address already exists in the list.";
    } else {
        // Write the new MAC address to the file
        writeMacAddress($macListFile, $clientMacAddress);
        echo "MAC address added to the list.";
    }
} else {
    echo "Please provide a MAC address.";
}
?>
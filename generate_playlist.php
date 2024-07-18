<?php
// URL of the source M3U file
$sourceUrl = 'https://rattling-glazes.000webhostapp.com/Bjtech_fancode.m3u';

// Function to fetch content from URL
function fetchM3UContent($url) {
    $content = file_get_contents($url); // You can use cURL as well for more control
    return $content;
}

// Function to parse M3U content and extract URLs
function parseM3U($m3uContent) {
    // Split content into lines
    $lines = explode("\n", $m3uContent);

    // Array to store URLs
    $urls = [];

    // Iterate through lines
    foreach ($lines as $line) {
        $line = trim($line);
        if (!empty($line) && strpos($line, '#') !== 0) { // Ignore comments and empty lines
            $urls[] = $line;
        }
    }

    return $urls;
}

// Function to create new M3U file
function createNewM3UFile($urls) {
    // File path for the new M3U file
    $newM3UFilePath = 'generated_playlist.m3u';

    // Open file for writing (create if not exist)
    $file = fopen($newM3UFilePath, 'w');

    if ($file) {
        // Write each URL to the file
        foreach ($urls as $url) {
            fwrite($file, $url . "\n");
        }
        fclose($file);
        return "New M3U file created successfully: $newM3UFilePath";
    } else {
        return "Error opening file: $newM3UFilePath";
    }
}

// Fetch content from source URL
$m3uContent = fetchM3UContent($sourceUrl);

if ($m3uContent) {
    // Parse M3U content to extract URLs
    $urls = parseM3U($m3uContent);

    // Create new M3U file with extracted URLs
    $result = createNewM3UFile($urls);
    echo $result;
} else {
    echo "Failed to fetch M3U content from $sourceUrl";
}
?>

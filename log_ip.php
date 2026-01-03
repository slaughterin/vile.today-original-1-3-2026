<?php
// Get visitor IP
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

// Optional: basic proxy awareness (safe version)
if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP']; // Cloudflare
} elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
    $ip = $_SERVER['HTTP_X_REAL_IP'];
}

// Log file
$logFile = __DIR__ . '/iplogs.txt';

// Format: date | IP
$entry = date('Y-m-d H:i:s') . " | " . $ip . PHP_EOL;

// Write to file safely
file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

// Return empty response
http_response_code(204);
exit;

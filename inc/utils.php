<?php
// Simple file-append logger for demonstration
function safe_filename($name) {
    return preg_replace('/[^a-z0-9_\-\.]/i', '_', $name);
}

function log_resolution(array $payload): bool {
    $dir = __DIR__ . '/../storage';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $fname = $dir . '/' . date('Y-m-d') . '.log';
    $entry = [
        'ts' => date('c'),
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'ua' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        'payload' => $payload,
    ];
    $line = json_encode($entry, JSON_UNESCAPED_SLASHES) . "\n";
    return (bool) @file_put_contents($fname, $line, FILE_APPEND | LOCK_EX);
}
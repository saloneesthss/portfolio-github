<?php
$dataFile = __DIR__ . '/data/contacts.json';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

$entry = [
    'name' => $name,
    'email' => $email,
    'subject' => $subject,
    'message' => $message,
    'received_at' => date('c'),
];

$dir = dirname($dataFile);
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$existing = [];
if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $existing = json_decode($json, true);
    if (!is_array($existing)) {
        $existing = [];
    }
}

$existing[] = $entry;
file_put_contents($dataFile, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

header('Location: index.html?sent=1');
exit;
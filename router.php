<?php
// Minimal router to make PHP's built-in server work with WordPress pretty permalinks
// Serves existing files directly; otherwise routes requests to index.php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($path !== '/' && file_exists(__DIR__ . $path)) {
    return false; // serve the requested resource as-is
}

require __DIR__ . '/index.php';
<?php

function get_base_path() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
                 || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    $host = $_SERVER['HTTP_HOST'];

    // Auto-detect project root (first folder after domain)
    $path = rtrim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']), '/');
    $parts = explode('/', trim($path, '/'));
    $project = isset($parts[0]) ? '/' . $parts[0] . '/' : '/';

    return $protocol . $host . $project;
}

function get_user_name() {
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}

function get_user_created_date() {
    return isset($_SESSION['created_at']) ? $_SESSION['created_at'] : null;
}

?>

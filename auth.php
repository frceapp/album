<?php
session_start();

$envFile = __DIR__ . '/.env';

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines !== false) {
        foreach ($lines as $line) {
            // Split each line into key and value
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Set the environment variable
            putenv("$key=$value");
        }
    }
} else {
    exit('.env file not found');
}

$password = getenv('PASSWORD');

if (!isset($_POST['type'])) {
    echo(json_encode(array('success' => false)));
    exit();
}

if ($_POST['type'] == 'login') {
    if (isset($_POST['password'])) {
        if ($_POST['password'] == $password) {
            $_SESSION['login'] = true;
            echo(json_encode(array('success' => true)));
            exit();
        }
    }

    echo(json_encode(array('success' => false)));
    exit();
} elseif ($_POST['type'] == 'logout') {
    session_unset();

    session_destroy();
}



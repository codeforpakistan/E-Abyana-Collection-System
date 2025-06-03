<?php

// Secure access with a secret key
if (!isset($_GET['key']) || $_GET['key'] !== 'mySecret123') {
    http_response_code(403);
    die('Forbidden');
}

// Go one directory up to locate the artisan file
$artisan = dirname(__DIR__) . '/artisan';

$commands = [
    'cache:clear',
    'route:clear',
    'config:clear',
    'view:clear',
    'clear-compiled',
    'optimize:clear'
];

echo "<pre>";
foreach ($commands as $command) {
    echo "Running: php artisan {$command}\n";
    $output = shell_exec("php {$artisan} {$command} 2>&1");
    echo $output . "\n-------------------------\n";
}
echo "</pre>";

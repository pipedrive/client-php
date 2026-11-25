<?php

declare(strict_types=1);

// The release tools run on the CI runner without composer install, so they load themselves.
spl_autoload_register(static function (string $class): void {
    $prefix = 'Pipedrive\\Release\\';
    if (str_starts_with($class, $prefix)) {
        require __DIR__ . '/' . substr($class, strlen($prefix)) . '.php';
    }
});

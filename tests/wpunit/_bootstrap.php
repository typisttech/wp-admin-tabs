<?php

declare(strict_types=1);
include __DIR__ . '/../../vendor/autoload.php';

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init(
    [
        'debug' => true,
        'cacheDir' => codecept_root_dir('_output'),
        'includePaths' => [
            codecept_root_dir('src'),
            codecept_root_dir('vendor/typisttech/wp-kses-view/src'),
        ],
        'excludePaths' => [codecept_root_dir('tests')],
    ]
);

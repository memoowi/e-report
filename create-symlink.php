<?php
$targets = [
    '/assets/css' => '/public/css',
    '/assets/js' => '/public/js',
    '/assets/uploads' => '/public/uploads',
];

foreach ($targets as $target => $link) {
    $targetPath = __DIR__ . $target;
    $linkPath = __DIR__ . $link;

    // Check if target directory exists
    if (!is_dir($targetPath)) {
        echo "Target directory '$targetPath' does not exist." . PHP_EOL;
        continue;
    }

    // Check if link directory already exists
    if (is_dir($linkPath) || file_exists($linkPath)) {
        echo "Link directory '$linkPath' already exists." . PHP_EOL;
        continue;
    }

    // Create symlink
    if (symlink($targetPath, $linkPath)) {
        echo "Symlink '$linkPath' created successfully!" . PHP_EOL;
    } else {
        echo "Failed to create symlink '$linkPath'." . PHP_EOL;
    }
}
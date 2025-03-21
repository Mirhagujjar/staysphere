<?php

// --------------------collect the othr route files
$routeFiles = ['faiza.php', 'sidra.php', 'fozia.php'];

foreach ($routeFiles as $file) {
    require __DIR__ . '/' . $file;
}


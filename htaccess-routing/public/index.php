<?php
// Initialize a request (this will be replaced by the router in step 7)
$uri = $_SERVER['REQUEST_URI'];

// Route to appropriate pages based on the URI
switch ($uri) {
    case '/hello':
        include '../src/pages/hello.php';
        break;
    case '/bye':
        include '../src/pages/bye.php';
        break;
    default:
        echo "Page Not Found!";
}

<?php
$name = $_GET['name'] ?? 'World';  // Default to 'World' if no name is provided.
echo "Hello, " . htmlspecialchars($name) . "!";

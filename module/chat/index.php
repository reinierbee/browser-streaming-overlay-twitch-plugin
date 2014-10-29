<?php
$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
var_dump($path);
$elements = explode('/', $path);                // Split path on slashes
var_dump($elements);
if(count($elements) == 0) {                     // No path elements means home
    // No path elements means home
    header('HTTP/1.1 404 Not Found');
    echo "Home not found";
}
else switch(array_shift($elements))             // Pop off first item and switch
{
    case 'api':
        require("module/chat/api/chat.php");
    break;
    default:
        header('HTTP/1.1 404 Not Found');
        echo "Not found here";
}
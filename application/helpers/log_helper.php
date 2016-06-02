<?php
function w2log($array)
{
    $file = 'log.txt';
    // Open the file to get existing content
    $current = file_get_contents($file);
    // Append a new person to the file
    $current .= json_encode($array)."\n";
    // Write the contents back to the file
    file_put_contents($file, $current);
}
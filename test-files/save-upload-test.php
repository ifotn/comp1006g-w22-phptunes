<?php
// reference the uploaded file using the input name from the form
$file = $_FILES['file'];

// even when form includes a file, use POST for all non-file input fields
$description = $_POST['description'];

// file name
echo '<p>Name: '. $file['name'] . '</p>';

// file size in bytes (1 kb = 1024 bytes)
echo '<p>Size: ' . $file['size'] . '</p>';

// temp location in cache
echo '<p>Temp Location: ' . $file['tmp_name'] . '</p>';

// file type. don't use type as it can be spoofed. use mime_content_type() instead
//echo '<p>Type: ' . $file['type'] . '</p>';
echo '<p>Type: ' . mime_content_type($file['tmp_name']) . '</p>';

// save the file to the current directory keeping the original name
// by default will overwrite a previous file with the same name
move_uploaded_file($file['tmp_name'], $file['name']);

?>
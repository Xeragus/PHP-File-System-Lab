<?php

//$directory = opendir("/var/www/html/php-file-system");
//if ($directory) {
//    $file = readdir($directory);
//
//    while($file !== false) {
//        echo "$file\n";
//    }
//
//    closedir($directory);
//}

/**
 * Task 1: Create a directory called 'files' and add 3 .txt files in it. The first file will be named 'first.txt',
 * the second one 'second.txt', the third one will be named 'third.txt'. Then transfer the content from 'first.txt' to 'result.txt', with that that you
 * will replace the '-' with white space. Finally, append the content from 'second.txt' to the 'result.txt'.
 */

// setting file system parameters
$directoryName = "files";
$fileSystemPath = getcwd();
$directory = $fileSystemPath . "/" . $directoryName;

// open a directory if it doesn't already exist
if(!is_dir($directory)) {
    mkdir($directory, 0777);
}

// create 'first.txt'
$filename = "/first.txt";
$firstFile = $directory . $filename;

if(!file_exists($firstFile)) {
    $handle = fopen($firstFile, "w+");
    if (!fwrite($handle, "This is the-content-of the 'first.txt'. Enjoy :)")) {
        die("Could not add content in 'first.txt'. Sorry :(");
    }
    fclose($handle);
}

// create 'second.txt'
$filename = "/second.txt";
$secondFile = $directory . $filename;

if(!file_exists($secondFile)) {
    $handle = fopen($secondFile, "w+");
    if (!fwrite($handle, "This is the content of the 'second.txt'. Enjoy :)")) {
        die("Could not add content in 'second.txt'. Sorry :(");
    }
    fclose($handle);
}

// create 'result.txt' and process data as specified
$filename = "/result.txt";
$file = $directory . $filename;

$handle = fopen($file, "w");
$firstFileHandle = fopen($firstFile, "r");
$secondFileHandle = fopen($secondFile, "r");

$firstFileContent = fread($firstFileHandle, filesize($firstFile));
$content = str_replace('-',' ', $firstFileContent);
if(!fwrite($handle, $content)) {
    die("Could not add processed data from 'first.txt' to 'result.txt' :(");
}
fclose($firstFileHandle);
fclose($handle);

// append data from 'second.txt'
$handle = fopen($file, "a");
$secondFileContent = fread($secondFileHandle,filesize($secondFile));
if(!fwrite($handle, $secondFileContent)) {
    die("Could not append data from 'second.txt' to 'result.txt' :(");
}

fclose($handle);
fclose($secondFileHandle);

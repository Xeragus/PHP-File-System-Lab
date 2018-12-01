<?php

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

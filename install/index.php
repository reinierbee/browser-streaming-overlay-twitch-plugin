<?php
/**
 * Created by IntelliJ IDEA.
 * User: rboon
 * Date: 22-9-2014
 * Time: 2:43 PM
 */

exec('pear install File_Archive',$output);

print_r($output);

//require_once "File/Archive.php";

exec('dir',$output);
print_r($output);

$zip = new ZipArchive();

if ($zip->open('easy-twitch-javascript-api-master.zip') === TRUE) {
    $zip->extractTo('/temp/');
    $zip->close();
    echo 'unzipping done...';
} else {
    echo 'Could not open zip file or was not present';
}
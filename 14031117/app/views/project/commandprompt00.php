<?php
require 'd:/apache24/htdocs/mehrabad/vendor/autoload.php';

use Karriere\PdfMerge\Exceptions\FileNotFoundException;
use Karriere\PdfMerge\Exceptions\NoFilesDefinedException;
use Spatie\Browsershot\Browsershot;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
/**
 * @throws NoFilesDefinedException
 * @throws FileNotFoundException
 * @throws CouldNotTakeBrowsershot
 */

$urll=$argv[1];
$filename=$argv[2];

//print_r($argv);
if(!isset($argv[3]))
    Browsershot::url($urll)->setChromePath("C:/Program Files (x86)/Google/Chrome/Application/chrome.exe")
        ->paperSize(350, 210, 'mm')->scale(0.97)->save('d:/apache24/htdocs/mehrabad/assets/tmp/' . $filename);
else
    Browsershot::url($urll)->setChromePath("C:/Program Files (x86)/Google/Chrome/Application/chrome.exe")
        ->paperSize(220, 297, 'mm')->scale(0.97)->save('d:/apache24/htdocs/mehrabad/assets/tmp/' . $filename);
?>
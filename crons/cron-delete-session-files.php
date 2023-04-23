<?php

// Delete session files
// --------------------
$dir = dirname(__DIR__) . "/writable/session";
$fileSystemIterator = new FilesystemIterator($dir);
$now = time();
$deleted = [];
// $expire = 60 * 60 * 24 * 0; // 0 days 
$expire = 60 * 60 * 24 * 1; // 1 day 
// $expire = 60 * 60 * 24 * 2; // 2 days 
// $expire = 60 * 60 * 24 * 5; // 5 days 

foreach ($fileSystemIterator as $file) {
  if ($now - $file->getCTime() >= $expire) {
    $deleted[] = $file;
    unlink($dir . "/" . $file->getFilename());
  }
}

echo "Deleted " . count($deleted) . " file(s):\n" . implode("\n", $deleted);

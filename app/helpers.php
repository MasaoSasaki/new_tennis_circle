<?php declare(strict_types=1);

if (! function_exists('hello')) {
  /**
   * @return string
   */
  function hello(): string
  {
    return 'Hello World.';
  }

  function getFolderName($album)
  {
    return preg_replace('/\s+|-|:|/', '', strval($album->created_at));
  }

  function getFileName($filePath, $folderName)
  {
    return str_replace([$folderName, '/'], '', $filePath);
  }

  function getFileNameOfFilePath($filePath)
  {
    $fileName = strstr($filePath, '/');
    return str_replace('/', '', $fileName);
  }
}

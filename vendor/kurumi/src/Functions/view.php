<?php

use Kurumi\Handlers\Loads;

/** -----------------
 *  Los
 *  digunakan untuk menampilkan design ke website
 *  
 *  @param string $filename
 *  menentukan nama file
 *  @param array $data
 *  data yang di beri di view ( optional )
 */

function view(string $filename, $data = [])
{
  $dir = "./../storage/framework/views/" . $filename;

  new \Kurumi\Kurumi\Generate();

  try {
    if (!file_exists($dir . '.php') and !file_exists($dir . '.kurumi.php')) {
      throw new Exception('trying to access a file that doesnt exist.');
    } else if (file_exists($dir . '.php')) {
      include $dir . '.php';
    } else if (file_exists($dir . '.kurumi.php')) {
      include $dir . '.kurumi.php';
      new \Kurumi\Kurumi\Layouts($filename, $data);
    }
  } catch (Exception $error) {
    new Loads($error->getTrace(), $filename, $error->getMessage());
  }
}

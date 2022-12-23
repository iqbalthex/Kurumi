<?php

namespace Kurumi\Consoles;

class Kurumi
{
  private $argv;
  private $options;
  private $short_options = 'c:m:';
  private $long_options = [
    'make::Model:',
    'make::Controller:',
  ];

  public function __construct()
  {
    global $argv;
    $this->argv = $argv;
    $this->options = getopt($this->short_options, $this->long_options);

    if ($this->options === [] and @!$this->argv[1]) {
      $this->handleError();
    }

    if (isset($this->options['c']) or isset($this->options['make::Controller'])) {
      $controller = isset($this->options['c']) ?
        $this->options['c'] : $this->options['make::Controller'];
      $this->createController($controller);
    }

    if (isset($this->options['m']) or isset($this->options['make::Model'])) {
      $model = isset($this->options['m']) ?
        $this->options['m'] : $this->options['make::Model'];
      $this->createModel($model);
    }

    if (@$this->argv[1] == 'desah') {
      $this->server();
    }
  }


  /**
   *  handling error when no arguments given
   */
  public function handleError()
  {
    echo "
Welcome to Kurumi Framework

Mini Framework for PHP Native, project open source!!
Lets contribute https://github.com/bydefaultiloveyou/Kurumi.git

If you get this output on your input, that mean your command wrong
please check in bottom for your input

======================== kurumi command list ========================

--make::Controller <NameController>    membuat controller handler
  | -c <NameController>                sama seperti --make::Controller
";
  }


  /**
   * generate random quotes when starting server
   */
  public function randQuotes()
  {
    $quotes = [
      #"sebodoh bodohnya kamu \n  jangan pernah nyoba programming.",
      "jika mereka menolak untuk menerima mu \n    maka aku akan menerimamu apa adanya!.",
      "apapun yang kamu lalukan pastikan \n    itu membuat kamu bahagia.",
      "untuk mencapai tujuan kita \n    kita harus mengejarnya sendiri.",
      "aku ingin memiliki kenangan bersama mu \n    dan juga aku ingin kau juga memiliki kenangan bersamaku."
    ];

    return $quotes[array_rand($quotes)];
  }


  /**
   * creating controller with given name on console
   */
  public function createController(string $controller_name)
  {
    if (file_exists("./app/Controllers/$controller_name.php")) {
      echo "

  Controller `$controller_name` Already Exist!

";
      die;
    }

    try {
      // test;  // matikan komentar untuk tes pesan error
      $newFile = fopen("./app/Controllers/$controller_name.php", 'w');
      $string  = "<?php

namespace App\Controllers;

class $controller_name
{
  // write method in here
}
      ";

      fwrite($newFile, $string);
      fclose($newFile);
      echo "

  Controller `$controller_name` created succesfully!

";
    } catch (\Throwable $th) {
      $last_trace = $th->getTrace()[0];
      echo "
  Cannot Create Controller!

  {$th->getMessage()}

  {$last_trace['file']}
  from `{$last_trace['function']}` in line: {$last_trace['line']}
";
    }
  }


  /**
   * creating model with given name on console
   */
  public function createModel(string $model_name)
  {
    if (file_exists("./app/Models/$model_name.php")) {
      echo "

  Model `$model_name` Already Exist

  ";
      die;
    }

    try {
      // test;  // matikan komentar untuk tes pesan error
      $newFile = fopen("./app/Models/$model_name.php", 'w');
      $string  = "<?php

namespace App\Models;

use Kurumi\Database\DB;

class $model_name
public static function DB()
{
  {
    return new DB();
  }

}";
      fwrite($newFile, $string);
      fclose($newFile);
      echo "

  Model `$model_name` created succesfully!

      ";
    } catch (\Throwable $th) {
      $last_trace = $th->getTrace()[0];
      echo "
  Cannot Create Model!

  {$th->getMessage()}

  {$last_trace['file']}
  from `{$last_trace['function']}` in line: {$last_trace['line']}
";
    }
  }


  /**
   * starting server
   */
  public function server()
  {
    echo "
  Kurumi server is running:

    \033 [0;32m local: http://localhost:3000/
    \033 [0;32m ip: http://127.0.0.1:3000/
    \033 [0;0m

    Tokisaki Kurumi:
    {$this->randQuotes()}

";
    if (PHP_OS === 'Linux') {
      exec('cd public/ && php -S localhost:3000 > /dev/null 2>&1');
      // system('php -S localhost:3000 public/index.php > /dev/null 2>&1');
    } else {
      exec('cd public/ && php -S localhost:3000 > NUL');
      // system('php -S localhost:3000 public/index.php > NUL');
    }
  }


}

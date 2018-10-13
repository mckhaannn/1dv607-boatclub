<?php
namespace model;
require_once "vendor/autoload.php";

class Server {
  function firebase () {  
    return $firebase = new \Firebase\FirebaseLib('https://dv607-da1a3.firebaseio.com', '39ilK1jtYKNyOACuYfAPUDoP7zYZ84LtaMu3RE0h');
  }
}

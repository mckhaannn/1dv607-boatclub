
<?php
require "vendor/autoload.php";

const DEFAULT_URL = 'https://dv607-da1a3.firebaseio.com';
const DEFAULT_TOKEN = '39ilK1jtYKNyOACuYfAPUDoP7zYZ84LtaMu3RE0h';
const DEFAULT_PATH = '/users';

$firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);

// $test = array(
//   "foo" => "bar",
//   "i_love" => "lamp",
//   "id" => 42
// );
// $dateTime = new DateTime();
// $firebase->set(DEFAULT_PATH . '/' . $dateTime->format('c'), $test);
// $firebase->set(DEFAULT_PATH . '/name/contact001', "John Doe");
// $name = $firebase->get(DEFAULT_PATH . '/name/contact001');



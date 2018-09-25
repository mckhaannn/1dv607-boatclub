
<?php
require "vendor/autoload.php";

const DEFAULT_URL = 'https://dv607-da1a3.firebaseio.com';
const DEFAULT_TOKEN = 'AIzaSyA1soNyM6PheAcEXBMome-9MMCKbN9YYEE';
const DEFAULT_PATH = '/firebase/dv607-da1a';


  $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
// --- storing an array ---
$test = array(
    "foo" => "bar",
    "i_love" => "lamp",
    "id" => 42
);
$dateTime = new DateTime();
$firebase->set(DEFAULT_PATH . '/' . $dateTime->format('c'), $test);

// --- storing a string ---
$firebase->set(DEFAULT_PATH . '/name/contact001', "John Doe");

// --- reading the stored string ---
$name = $firebase->get(DEFAULT_PATH . '/name/contact001');



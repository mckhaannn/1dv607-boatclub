
<?php
require_once "vendor/autoload.php";
const DEFAULT_TOKEN = '39ilK1jtYKNyOACuYfAPUDoP7zYZ84LtaMu3RE0h';
const DEFAULT_URL = 'https://dv607-da1a3.firebaseio.com';

// const DEFAULT_PATH = '/users';
if (!defined(DEFAULT_URL)) define(DEFAULT_URL, 'https://dv607-da1a3.firebaseio.com');

if (!defined(DEFAULT_TOKEN)) define(DEFAULT_TOKEN, '39ilK1jtYKNyOACuYfAPUDoP7zYZ84LtaMu3RE0h');
  
$firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);

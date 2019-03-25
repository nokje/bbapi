<?php

// put all configuration in one central file so we can load it from anywhere
require 'conf/config.inc.php';

// get required classes voor mysql (database) and API
require 'inc/mysql.inc.php';
require 'inc/api.inc.php';

// setup the class and pass it's config!
$m = new Mysql($config["database"]);
$api = new Api($config["api"]);

// now we can do something

?>
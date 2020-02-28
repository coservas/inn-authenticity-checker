<?php

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(new \App\Application())->process();

<?php
require 'autoload.php';

$tool = new \App\Tools\Tools('https://www.proficosmetics.ru/catalog/dlya-volos');
$tool->parsePages();

//print_r($tool);
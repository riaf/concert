<?php
require dirname(__FILE__). '/__init__.php';
Rhaco::import('generic.Urls');
Rhaco::import('model.Stage');

$db = new DbUtil(Stage::connection());
$pattern = array(
    '^upload$' => array('class' => 'ConcertView', 'method' => 'upload'),
    '^play/(\d+)$' => array('class' => 'ConcertView', 'method' => 'play'),
    '^$' => array('class' => 'ConcertView', 'method' => 'index'),
);

$parser = Urls::parser($pattern, $db);
$parser->write();

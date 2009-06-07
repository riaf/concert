<?php
require dirname(__FILE__). '/__init__.php';

$id = isset($_GET['stage_id'])? $_GET['stage_id']: null;
if(is_numeric($id)){
    header('location: '. Rhaco::url('play/'). $id);
    exit;
}
header('location: '. Rhaco::url());

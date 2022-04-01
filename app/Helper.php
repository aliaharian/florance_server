<?php

function findObjectByPos($array,$pos , $type='key'){
    foreach ( $array as $element ) {
        if ( $pos == $element->$type ) {
            return $element;
        }
    }
    return false;
}

function enToFa($string) {
    return strtr($string, array('0'=>'۰','1'=>'۱','2'=>'۲','3'=>'۳','4'=>'۴','5'=>'۵','6'=>'۶','7'=>'۷','8'=>'۸','9'=>'۹'));
}

function getMaterialTypes(){
    $types = array();
    $type = new \stdClass();
    $type->name = 'cabin';
    $type->label = 'کابین';
    array_push($types, $type);
    $type = new \stdClass();
    $type->name = 'surface';
    $type->label = 'صفحه';
    array_push($types, $type);
    $type = new \stdClass();
    $type->name = 'bowl';
    $type->label = 'کاسه';
    array_push($types, $type);
    $type = new \stdClass();
    $type->name = 'mirror';
    $type->label = 'آینه';
    array_push($types, $type);
    $type = new \stdClass();
    $type->name = 'drawer';
    $type->label = 'کشو';
    array_push($types, $type);
    return $types;
}




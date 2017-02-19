<?php

define(SMARTY_DIR, __DIR__."/"); // указываем путь до библиотеки Smarty
require_once __DIR__.'/Smarty.class.php';

function appGetTemplate($tpl_name, &$tpl_source, $smarty) {
    $tpl_source = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/" . $tpl_name);
    return true;
}

function appGetTimestamp($tpl_name, &$tpl_timestamp, $smarty) {
    $tpl_timestamp = filemtime ($_SERVER['DOCUMENT_ROOT'] . "/" . $tpl_name);
    return true;
}

function appGetSecure($tpl_name, $smarty) {
    // предполагаем, что шаблоны безопасны
    return true;
}

function appGetTrusted($tpl_name, &$smarty) {
    // не используется для шаблонов
}

/*
function db_sm_get_template($tpl_name, &$tpl_source, $smarty) {
    // выполняем обращение к базе данных для получения шаблона
    $arg = explode('/', $tpl_name);
    if (count($arg) == 1) {
        $arg[1] = $arg[0];
        $arg[0] = 'templates';
    }
    $row = db::selectRow('select * from ' . $arg[0] . ' where id=' . $arg[1]);
    if (!$row) {
        echo "<error> Ошибка, шаблона не существует: $tpl_name </error>";
        return true;
    }
    if ($row['html'] && $row['html'] != '') {
        $tpl_source = $row['html'];
    } else {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/custom/templates/" . $row['src'] . '.tpl')) {
            $tpl_source = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/custom/templates/" . $row['src'] . '.tpl');
            return true;
        } else {
            $tpl_source = "<error> Ошибка! Шаблон не найден {$_SERVER['DOCUMENT_ROOT']}/custom/templates/{$row['src']}.tpl </error>";
            return true;
        }
    }
}

function db_sm_get_timestamp($tpl_name, &$tpl_timestamp, $smarty) {
    $tpl_timestamp = 0;
    return true;
}

function db_sm_get_secure($tpl_name, $smarty) {
    // предполагаем, что шаблоны безопасны
    return true;
}

function db_sm_get_trusted($tpl_name, &$smarty) {
    // не используется для шаблонов
}

//  content



// Engine

function e_sm_get_template($tpl_name, &$tpl_source, $smarty) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/engine/templates/' . $tpl_name . '.tpl')) {
        $tpl_source = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/engine/templates/' . $tpl_name . '.tpl');
    } else {
        $tpl_source = "<error> Шаблон " . $_SERVER['DOCUMENT_ROOT'] . '/engine/templates/' . $tpl_name . '.tpl' . " не найден </error>";
    }
    return true;
}

function e_sm_get_timestamp($tpl_name, &$tpl_timestamp, $smarty) {
    $tpl_timestamp = 0;
    return true;
}

function e_sm_get_secure($tpl_name, $smarty) {
    // предполагаем, что шаблоны безопасны
    return true;
}

function e_sm_get_trusted($tpl_name, &$smarty) {
    // не используется для шаблонов
}
*/
function initSmarty() {

    $sm = new Smarty();
    $sm->template_dir = $_SERVER['DOCUMENT_ROOT'] ;
    $sm->compile_dir = $_SERVER['DOCUMENT_ROOT'] . '/cache/';
    $sm->cache_dir = $_SERVER['DOCUMENT_ROOT'] . '/cache/';
    $sm->caching = false;

    $sm->registerResource("app",[
        "appGetTemplate",
        "appGetTimestamp",
        "appGetSecure",
        "appGetTrusted"
    ]);
    
    /*$sm->registerResource("db", array("db_sm_get_template",
        "db_sm_get_timestamp",
        "db_sm_get_secure",
        "db_sm_get_trusted"));

    $sm->registerResource("cust", array("c_sm_get_template",
        "c_sm_get_timestamp",
        "c_sm_get_secure",
        "c_sm_get_trusted"));

    $sm->registerResource("en", array("e_sm_get_template",
        "e_sm_get_timestamp",
        "e_sm_get_secure",
        "e_sm_get_trusted"));*/

    return $sm;
}

?>
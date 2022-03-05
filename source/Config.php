<?php

/*
* DEFININDO TIMEZONE PADRÃO
*/
date_default_timezone_set('America/Sao_Paulo');

const ROOT = "http://localhost/pretium";

const SITENAME = "Pretium";
const VERSION = "1.0";

/*
* DADOS PARA CONEXÃO COM BANCO DE DADOS
*/
const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "pretium",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
    ],
];

/**
 * CATEGORIAS
 */

CONST CATEGORY = [
    "S/A",
    "LTDA",
    "MEI",
    "ME",
    "EPP"
];
<?php

ob_flush();
session_start();

require __DIR__ . "/vendor/autoload.php";

$router = new \CoffeeCode\Router\Router(ROOT);

$router->namespace("Source\Controllers");

/*
 * GROUP NULL
 */
$router->group(null);
$router->get("/", "Web:home", "web.home");
$router->get("/login", "Web:login", "web.login");
$router->get("/register", "Web:register", "web.register");

/**
 * GROUP AUTH
 */
$router->group(null);
$router->post("/login", "Auth:login", "auth.login");
$router->post("/register", "Auth:register", "auth.register");

/**
 * GROUP APP
 */
$router->group("app");
$router->get("/", "App:home", "app.home");
$router->get("/fornecedores", "App:providers", "app.providers");
$router->get("/produtos", "App:products", "app.products");
$router->post("/produtos", "App:product", "app.product");
$router->get("/cotacoesrecebidas", "App:quotesReceived", "app.quotesreceived");
$router->get("/minhascotacoes", "App:myQuotes", "app.myquotes");
$router->post("/minhascotacoes", "App:newQuote", "app.newQuote");
$router->get("/logout", "App:logout", "app.logout");

/*
 * GROUP ERROR
 */
$router->group("error");
$router->get("/{errcode}", "Web:error", "web.error");

/*
 * ROUTE PROCESS
 */
$router->dispatch();

if($router->error()){
    $router->redirect("web.error", ["errcode" => $router->error()]);
}

ob_end_flush();
<?php

namespace Source\Controllers;

use React\Promise\Deferred;
use Source\Models\Products;
use Source\Models\Provider;
use Source\Models\QuoteProduct;
use Source\Models\Quotes;
use Source\Models\User;

class App extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);

        if (empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])) {
            unset($_SESSION["user"]);
            flash("alert-danger", "Acesso negado. Faça o login primeiro.");
            $this->router->redirect("web.login");

        }
    }

    public function home(): void
    {
        $user = (new User())->findById($_SESSION["user"]);
        echo $this->view->render("dashboard", [
            "title" => "Dashboard | " . SITENAME,
            "router" => $this->router,
            "user" => $user,
        ]);
    }

    public function providers(): void
    {
        $fornecedores = (new Provider())->find()->fetch(true);
        echo $this->view->render("fornecedores", [
            "title" => "Fornecedores | " . SITENAME,
            "router" => $this->router,
            "fornecedores" => $fornecedores,

        ]);
    }

    public function products(): void
    {
        $user = (new User())->find("id = :id", "id={$_SESSION["user"]}", "provider_id")->fetch();
        $products = (new Products())->find("provider_id = :id", "id={$user->provider_id}")->fetch(true);

        echo $this->view->render("produtos", [
            "title" => "Produtos | " . SITENAME,
            "router" => $this->router,
            "products" => $products,
            "provider_id" => $user->provider_id,
        ]);
    }

    public function product(array $data): void
    {
        $user = (new User())->find("id = :id", "id={$_SESSION["user"]}", "provider_id")->fetch();
        $product = (new Products())->findById((empty($data["id"]) ? 0 : $data["id"]));

        if (!$product) {
            $product = new Products();
        }

        $product->product_name = filter_var($data["description"], FILTER_DEFAULT);
        $product->brand = filter_var($data["brand"], FILTER_DEFAULT);
        $product->code = filter_var($data["code"], FILTER_DEFAULT);
        $product->provider_id = $user->provider_id;
        $product->measurement_units_id = filter_var($data["measurementUnit"], FILTER_DEFAULT);
        $product->save();

        $this->router->redirect("app.products");
    }

    public function quotesReceived(): void
    {
        $user = (new User())->find("id = :id", "id={$_SESSION["user"]}", "provider_id")->fetch();
        $quotes = (new Quotes())->find("provider_id = :provider_id", "provider_id={$user->provider_id}")->fetch(true);

        echo $this->view->render("quotesreceived", [
            "title" => "Cotações recebidas | " . SITENAME,
            "router" => $this->router,
            "quotes" => $quotes
        ]);
    }

    public function myQuotes(): void
    {
        $user = (new User())->find("id = :id", "id={$_SESSION["user"]}", "provider_id")->fetch();
        $quotes = (new Quotes())->find("user_id = :user_id", "user_id={$_SESSION["user"]}")->fetch(true);

        echo $this->view->render("myquotes", [
            "title" => "Minhas cotações | " . SITENAME,
            "router" => $this->router,
            "quotes" => $quotes,
            "provider_id" => $user->provider_id,
        ]);
    }

    public function newQuote(array $data): void
    {
        parse_str($data['data'], $output);
        unset($data['data']);
        $data['data'] = $output;

        $user = (new User())->find("id = :id", "id={$_SESSION["user"]}", "id, provider_id")->fetch();
        $provider = (new Provider())->find("social_reason=:name", "name={$data['data']['provider']}", "id")->fetch();

        $quote = (new Quotes());
        $quote->user_id = $user->id;
        $quote->provider_id = $provider->id;
        $quote->status_id = 1;
        $quote->closure_at = $data['data']['closure_at'];
        $quote->save();

        for ($i = 0; $i < count($data['product']); $i++) {

            $product = (new Products())->find("product_name=:product_name", "product_name={$data['product'][$i][0]}",
                "id")->fetch();
            $quoteProduct = new QuoteProduct();
            $quoteProduct->quote_id = $quote->id;
            $quoteProduct->product_id = $product->id;
            $quoteProduct->qtd = $data['product'][$i][1];
            $quoteProduct->save();
        }
    }

    public function logout(): void
    {
        unset($_SESSION["user"]);
        $this->router->redirect("web.login");
    }
}
<?php

namespace Source\Controllers;

use Source\Models\Provider;
use Source\Models\User;

class Auth extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function login(array $data)
    {
        $email = filter_var($data["email"], FILTER_DEFAULT);
        $passwd = filter_var($data["passwd"], FILTER_DEFAULT);

        if (!$email || !$passwd) {
            echo $this->ajaxResponse("message", [
                "type" => "warning",
                "message" => "Informe login e senha para entrar",
            ]);
            return;
        }

        $user = (new User())->find("email = :email",
            ":email={$data["email"]}")->fetch();

        if (!$user) {
            echo $this->ajaxResponse("message", [
                "type" => "danger",
                "message" => "Usuário não cadastrado",
            ]);
            return;
        }
        if (!password_verify($passwd, $user->password)) {
            echo $this->ajaxResponse("message", [
                "type" => "danger",
                "message" => "Login ou senha incorreta",
            ]);
            return;
        }

        $_SESSION["user"] = $user->id;

        echo $this->ajaxResponse("redirect", ["url" => $this->router->route("app.home")]);
    }

    public function register(array $data)
    {
        $nomeCompleto = filter_var($data["fullName"], FILTER_DEFAULT);
        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $emailBusiness = filter_var($data["businessEmail"], FILTER_VALIDATE_EMAIL);
        $telefone = filter_var($data["phoneNumber"], FILTER_DEFAULT);
        $socialReason = filter_var($data["socialReason"], FILTER_DEFAULT);
        $cnpj = filter_var($data["cnpj"], FILTER_DEFAULT);
        $address = filter_var($data["address"], FILTER_DEFAULT);
        $passwd = filter_var($data["passwd"], FILTER_DEFAULT);
        $confirmPasswd = filter_var($data["confirmPasswd"], FILTER_DEFAULT);

        if (!$nomeCompleto && !$email && !$emailBusiness && !$telefone && !$socialReason && !$cnpj && !$address && !$passwd && !$confirmPasswd) {
            echo $this->ajaxResponse("message", [
                "type" => "warning",
                "message" => "Preencha todos os campos",
            ]);
            return;
        }

        $user = (new User())->find("email = :email",
            ":email={$email}")->fetch();

        if ($user) {
            echo $this->ajaxResponse("message", [
                "type" => "danger",
                "message" => "Esse endereço de e-mail já está em uso",
            ]);
            return;
        }

        if ($passwd != $confirmPasswd) {
            echo $this->ajaxResponse("message", [
                "type" => "danger",
                "message" => "As senhas digitadas não coincidem",
            ]);
            return;
        }

        $provider = new Provider();
        $provider->social_reason = $socialReason;
        $provider->cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        $provider->address = $address;
        $provider->email = $emailBusiness;
        $provider->phonenumber = preg_replace('/[^0-9]/', '', $telefone);
        $provider->save();

        $user = new User();
        $user->username = $nomeCompleto;
        $user->email = $email;
        $user->password = password_hash($passwd, PASSWORD_DEFAULT);
        $user->provider_id = $provider->id;
        $user->save();

        $_SESSION["user"] = $user->id;

        echo $this->ajaxResponse("redirect", ["url" => $this->router->route("app.home")]);
    }
}
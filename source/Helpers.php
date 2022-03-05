<?php

function url(string $uri = null): string
{
    if ($uri) {
        return ROOT . "/" . $uri;
    }

    return ROOT;
}

function asset(string $path): string
{
    return ROOT . "/assets/" . $path;
}

function flash(string $type = null, string $message = null): ?string
{
    if ($type && $message) {
        $_SESSION["flash"] = [
            "type" => $type,
            "message" => $message,
        ];

        return null;
    }

    if (!empty($_SESSION["flash"]) && $flash = $_SESSION["flash"]) {
        unset($_SESSION["flash"]);
        return "<div class='alert {$flash["type"]}'>{$flash["message"]}</div>";
    }
    return null;
}

function mask($maskType, $value)
{
    $mask = null;
    if ($maskType == 'telephone') {
        $mask = "(" . substr($value, 0, 2) . ") " . substr($value, 2, -4) . "-" . substr($value, -4);
    } elseif ($maskType == 'cnpj') {
        $mask = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $value);;
    }
    return $mask;
}
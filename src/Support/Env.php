<?php

namespace App\Support;

class Env {
    public static function get($key, $default = null) {
        return $_ENV[$key] ?? $default;
    }
}
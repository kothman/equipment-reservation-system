<?php
namespace Kothman\Twig;

use \Twig\Extension\AbstractExtension;
use \Twig\TwigFunction;
use \Dotenv\Dotenv;

class Extension extends AbstractExtension {
    public function getFunctions() {
        return [
            new TwigFunction('_debug_globals', [$this, '_debug_get_globals']),
            new TwigFunction('_debug_var_dump', [$this, '_debug_var_dump']),
            new TwigFunction('env', [$this, 'env']),
            new TwigFunction('is_array', [$this, 'is_array']),
        ];
    }

    public function _debug_get_globals() {
        return $GLOBALS;
    }
    public function _debug_var_dump($any) {
        return print_r($any, true);
    }
    public function env() {
        $env = Dotenv::createImmutable(__DIR__ . '/../../../');
        $env->load();
        return $_ENV;
    }
    public function is_array($arr) {
        return is_array($arr);
    }
}

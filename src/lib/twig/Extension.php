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
            new TwigFunction('array_length', [$this, 'array_length']),
            new TwigFunction('gettype', [$this, 'gettype']),
            new TwigFunction('str_replace', [$this, 'str_replace']),
        ];
    }

    public function _debug_get_globals() {
        return $GLOBALS;
    }
    public function _debug_var_dump($any) {
        return print_r($any, true);
    }
    public function env(string $key = '') {
        $env = Dotenv::createImmutable(__DIR__ . '/../../../');
        $env->load();
        if ($key === '')
            return $_ENV;
        return $_ENV[$key];
    }
    public function is_array($arr) {
        return is_array($arr);
    }
    public function array_length($arr) {
        return count($arr);
    }
    public function gettype($any) {
        return gettype($any);
    }
    public function str_replace(string $search, string $replace, string $subject) {
        return str_replace($search, $replace, $subject);
    }
}

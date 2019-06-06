<?php
namespace Example_Plugin;

final class Loader
{

    public function init() {
        return $this;
    }

    private function load_files() {

    }

    public function add( $n1, $n2 ) {
        return $n1 + $n2;
    }

    public function subtract($n1, $n2) {
        return $n1 - $n2;
    }
}
<?php


namespace App\Services;


abstract class AbstractJsonView {
    protected $success;

    protected $item;

    public function setView($success, $item)
    {
        $this->success = $success;
        $this->item = $item;
    }
    abstract public function view();
}

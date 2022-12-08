<?php


namespace App\Services;


class JsonView extends AbstractJsonView
{

    public function view()
    {
        return [
            "item" => $this->item,
            "success" => $this->success
        ];
    }
}

<?php


namespace App\Services;


use Symfony\Component\HttpFoundation\Request;

interface CrudServiceInterface
{
    public function create(Request $request);

    public function edit(Request $request, $idItem);

    public function delete($idItem);
}

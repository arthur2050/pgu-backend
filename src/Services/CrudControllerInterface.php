<?php


namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface CrudControllerInterface
 * @package App\Services
 */
interface CrudControllerInterface
{
    public function add(Request $request);

    public function edit(Request $request, $idItem);

    public function delete($idItem);

}

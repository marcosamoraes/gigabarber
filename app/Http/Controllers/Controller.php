<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function storageFile($file, $location)
    {
        if ($file->isValid()) {
            $name = $file->hashName();

            if (!$file->storeAs("public/$location", $name))
                throw new Exception("Falha ao salvar arquivo", 1);

            return "/storage/$location/$name";
        }
    }
}

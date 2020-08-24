<?php

namespace App\Services\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ModelTrait
{
    /*
     *
     */

    private function getDataFromModelByMap($model, $modelName)
    {
        return $model->map( function ($item) use($modelName) {
            $item->string = mb_strtolower($modelName) .'-' . $item->id;
            return $item;
        })->pluck('email', 'string')->toArray();
    }


}

<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store;

abstract class StoreBaseController extends Controller
{
    protected function getStore(): Store
    {
        $store = auth()->user()->managedStore();
        if (!$store) {
            $store = auth()->user()->stores()->first();
        }
        if (!$store) {
            abort(403, 'Mağaza atamanız bulunmuyor.');
        }
        return $store;
    }
}

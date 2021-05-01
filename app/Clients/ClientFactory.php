<?php

namespace App\Clients;

use App\Models\Retailer;
use App\Clients\ClientException; 
use Illuminate\Support\Str;

class ClientFactory {
    public static function make(Retailer $retailer): Client {
        
        $className = '\\App\Clients\\' . Str::studly($retailer->name);

        if (!class_exists($className)) {
            throw new ClientException('Unknown Client. Tracking not possible');
        }

        return new $className;
    }
}
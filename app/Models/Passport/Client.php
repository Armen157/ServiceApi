<?php

namespace App\Models\Passport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Client AS BaseClient;

class Client extends BaseClient
{
    /**
     * @return bool
     */
    public function skipsAuthorization()
    {
        return TRUE;
    }
}

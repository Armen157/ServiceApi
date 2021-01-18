<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phoneBook extends Model
{
    use HasFactory;

    protected $table = "phone_books";

    protected $fillable = [
        "first_name",
        "last_name",
        "phone_number",
        "country_code",
        "timezone_name"
    ];
}

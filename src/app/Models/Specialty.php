<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    // rename the id column, not mandatory
    protected $primaryKey = 'id';

    // tell Eloquent that uuid is a string, not an integer
    protected $keyType = 'string';
}

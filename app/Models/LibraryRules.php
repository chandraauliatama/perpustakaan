<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryRules extends Model
{
    use HasFactory;
    protected $fillable = ['day_limit', 'fine'];
}

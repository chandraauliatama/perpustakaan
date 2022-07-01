<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const IS_ADMIN = 1;

    public const IS_PIMPINAN = 2;

    public const IS_OPERATOR = 3;

    public const IS_ANGGOTA = 4;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

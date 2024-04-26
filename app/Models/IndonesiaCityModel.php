<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaCityModel extends Model
{
    use HasFactory;
    protected $table = "indonesia_cities";
    protected $guarded = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'province_code',
        'name',
        'meta'
    ];
}

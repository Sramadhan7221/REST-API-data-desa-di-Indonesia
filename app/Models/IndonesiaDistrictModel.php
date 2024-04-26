<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaDistrictModel extends Model
{
    use HasFactory;
    protected $table = "indonesia_districts";
    protected $guarded = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'city_code',
        'name',
        'meta'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaVillageModel extends Model
{
    use HasFactory;
    protected $table = "indonesia_villages";
    protected $guarded = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'district_code',
        'name',
        'meta'
    ];
}

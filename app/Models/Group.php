<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'area_name','is_active'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_name');

    }


}

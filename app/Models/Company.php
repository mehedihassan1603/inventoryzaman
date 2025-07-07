<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name','group_id','area_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);

    }
    public function area()
    {
        return $this->belongsTo(Area::class);

    }




}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPerson extends Model
{
    use HasFactory;
    protected $fillable=['idperson','nombre','apellido','dni'];
    protected $table="tperson";
    protected $primaryKey="idperson";
    public $keyType="string";
    public $timestamps = true;
    public $incrementing=false;
}

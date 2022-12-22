<?php

namespace App\Models;

use App\Traits\LogsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeSolicitation extends Model
{
    use HasFactory, LogsTrait, SoftDeletes;

    protected $table = 'type_solicitation';

    protected $fillable = ['name'];
}

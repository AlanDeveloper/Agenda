<?php

namespace App\Models;

use App\Traits\LogsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, LogsTrait, SoftDeletes;

    protected $table = 'schedule';

    protected $fillable = ['solicitation_id', 'employee_id', 'date'];
}

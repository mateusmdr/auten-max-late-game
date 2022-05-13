<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{

    protected $fillable = [
        'link_url',
        'begin_at',
        'end_at',
        'price',
        'img_filename',
        'company_name'
    ];
}

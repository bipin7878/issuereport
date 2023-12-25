<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issuerecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'issuetitle',
        'description',
        'attached_files',
        'priority',
        'reportedname',
        'email',
    ];

    protected $casts = [
        'attached_files' => 'json',
    ];
}

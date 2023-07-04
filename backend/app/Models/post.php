<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{

    protected $fillable = [
        'title',
        'full_img',
        'video',
        'detail',
        'tags'
    ];

    use HasFactory;
    protected $primary_key='post_id';

    function get_comments(){

        return $this->hasMany('App\Models\comments','post_id');

    }

}

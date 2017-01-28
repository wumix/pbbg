<?php

namespace Medusa\App;

use Illuminate\Database\Eloquent\Model;

class Characters extends Model
{
    
    public $fillable = [
        'cid'
    ];
    
    public static function getCharacters()
    {
        return Characters::orderby('id', 'DESC')->where('uid', '=', user()->id)->get();
    }
}

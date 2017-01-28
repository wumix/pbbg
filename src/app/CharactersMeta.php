<?php

namespace Medusa\App;

use Illuminate\Database\Eloquent\Model;

class CharactersMeta extends Model
{

    public $fillable = [
        'cid', 'key'
    ];

    public static function set($meta, $value = null)
    {
        
        dd(cid());
        
        // If array then loop and create
        if(is_array($meta))
        {
            foreach ($meta as $key => $value)
            {

                $m = CharactersMeta::firstOrNew([
                    'cid'   =>  cid(),
                    'key'   =>  $key
                ]);
                $m->value = $value;
                $m->save();
            }
        }
        else
        {
            //If not an array then just set one attribute
            $m = CharactersMeta::firstOrNew([
                'cid'   =>  cid(),
                'key'   =>  $meta
            ]);
            $m->value = $value;
            $m->save();
        }
    }
}

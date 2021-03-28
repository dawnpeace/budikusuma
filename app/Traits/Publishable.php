<?php

namespace App\Traits;

use App\Exceptions\NaturalIdUsedExceptions;
use Illuminate\Support\Facades\DB;

trait Publishable 
{
    use CheckNaturalId;

    protected $publishExcept = ['user_id'];

    public function publish()
    {
        $clazz = __CLASS__;
        if ( property_exists($clazz, 'selfIdName') && property_exists($clazz, 'publishIdName') && method_exists($clazz, 'getTargetClass')) {
            return DB::transaction(function() use ($clazz){
                $id = $this->{static::$selfIdName};
                if( !static::hasTaken($id) ) {
                    $items = $this->toArray();
                    $items[self::$publishIdName] = $items[self::$selfIdName];

                    if(property_exists($clazz, 'publishExcept')) {
                        if(is_array($this->publishExcept)) {
                            foreach($this->publishExcept as $except) {
                                unset($items[$except]);
                            }
                        } else {
                            unset($items[$this->publishExcept]);
                        }
                    }
                    call_user_func_array(array(self::getTargetClass(), 'create'), [$items]);
    
                    $this->published_at = now();
                    $this->save();

                } else {
                    throw new NaturalIdUsedExceptions($id);
                }
            });
        } else {
            throw new \Exception('Required methods or properties doesn\'t exist');
        }

    }
}
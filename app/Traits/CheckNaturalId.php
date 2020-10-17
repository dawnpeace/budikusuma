<?php

namespace App\Traits;

trait CheckNaturalId {
    

    /**
     * @param String id
     * @return bool
     */
    public static function hasTaken($id)
    {
        $clazz = __CLASS__;
        if (property_exists($clazz, 'selfIdName') && property_exists($clazz, 'publishIdName') && method_exists($clazz, 'getTargetClass')) {
            $targetClass = call_user_func(array($clazz, 'getTargetClass'));
            return $targetClass::query()
                ->where(static::$publishIdName, $id)
                ->count() > 0;
        }
    }

}
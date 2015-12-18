<?php
/**
 * Created by PhpStorm.
 * User: Сапрыкин А_Ю
 * Date: 18.12.15
 * Time: 13:12
 */

namespace app\models;


class ArrayGenerator
{
    public static function  generateHash($collection, $fieldIdName, $fieldValueName)
    {
        $hash = array();
        foreach($collection as $item)
        {
            $hash[$item->$fieldIdName] = $item->$fieldValueName;
        }

        return $hash;
    }
} 
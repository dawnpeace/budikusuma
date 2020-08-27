<?php

namespace App\Element;


class Button {

    public static function deleteButton($routeUrl)
    {
        return '<button onclick="' . 'helper.deleteRow(\'' . $routeUrl . '\')' . '" class="btn btn-sm btn-danger mx-1">Hapus</button>';
    }

    public static function editButton($routeUrl)
    {
        return '<button onclick="' . 'helper.goToUrl(\'' . $routeUrl . '\')' . '" class="btn btn-sm btn-secondary mx-1">Edit</button>';
    }

    public static function checkButton($routeUrl)
    {
        return '<button onclick="' . 'helper.goToUrl(\'' . $routeUrl . '\')' . '" class="btn btn-sm btn-secondary mx-1">Periksa</button>';
    }
 
}
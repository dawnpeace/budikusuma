<?php

namespace App\Element;


class Button {

    public static function deleteButton($routeUrl)
    {
        return '<button data-delete-url="'. $routeUrl .'" class="btn btn-sm btn-danger mx-1 dt-btn-del">Hapus</button>';
    }

    public static function editButton($routeUrl)
    {
        return '<button data-forward-url="' . $routeUrl . '" class="btn btn-sm btn-secondary mx-1">Edit</button>';
    }

    public static function checkButton($routeUrl)
    {
        return '<button data-forward-url="' . $routeUrl . '" class="btn btn-sm btn-secondary mx-1 dt-btn-forward">Periksa</button>';
    }
 
}
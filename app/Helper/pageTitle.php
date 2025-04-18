<?php
namespace App\Helper;

use Illuminate\Support\Facades\View;

function pageTitle($title)
{
    return View::getSections()[$title];
}

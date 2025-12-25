<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct()
    {
        $color = Color::first();
        View:: share([
            "color" => $color,
        ]);
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
// use App\Http\Middleware\Closure;

class VerifyCsrfToken extends Middleware
{

    protected $except = [

    ];
}

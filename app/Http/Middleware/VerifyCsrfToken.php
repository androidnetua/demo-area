<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    protected function availableAt($delay = 0)
    {
        $config = config('session');

        if ($config['expire_on_close'])
            return 0;
        else
            return parent::availableAt($delay);
    }
}

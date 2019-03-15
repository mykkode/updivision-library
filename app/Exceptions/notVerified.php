<?php

namespace App\Exceptions;

use Exception;

class notVerified extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->view('notVerified');
    }
}

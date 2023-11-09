<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AfterCartController extends Controller
{
    public function success()
    {
        return redirect('http://127.0.0.1:8000');
    }

    public function failure()
    {
        return redirect('http://127.0.0.1:8000');
    }
}

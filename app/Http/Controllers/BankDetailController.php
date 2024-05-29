<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BANKDetailController extends Controller
{
    public function show()
    {
        $banks = Bank::all();

        return view('welcome', [
            'banks' => $banks
        ]);
    }

    public function detail($id)
    {
        $bank = Bank::find($id);
        return view('detail', compact('bank'));
    }
    public function contact()
    {
        return view('contact');
    }
}

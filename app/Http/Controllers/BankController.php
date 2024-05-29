<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();
        return view('banks.index', [
            'banks' => $banks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank = new Bank();
        $bank->namabank = $request->namabank;
        $bank->alamat = $request->alamat;
        $bank->jam_operasional = $request->jam_operasional;
        $bank->call_center = $request->call_center;
        $bank->longitude = $request->longitude;
        $bank->latitude = $request->latitude;
        $bank->save();

        return redirect()->route('banks.index')
            ->with('success_message', 'Berhasil menambah data baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $bank = Bank::findOrFail($id);
        return view('banks.show', [
            'bank' => $bank
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::find($id);
        return view('banks.edit', compact('bank'));

        // if ($id === null) {
        //     // Handle case where no $id is provided, maybe show an error or redirect
        //     // For example, you might redirect to the index page.
        //     return redirect()->route('banks.index')->with('error', 'Invalid request.');
        // }

        // $bank = Bank::findOrFail($id);
        // return view('edit', [
        //     'bank' => $bank
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bank = Bank::findOrFail($id);
        $bank->namabank = $request->namabank;
        $bank->alamat = $request->alamat;
        $bank->jam_operasional = $request->jam_operasional;
        $bank->call_center = $request->call_center;
        $bank->longitude = $request->longitude;
        $bank->latitude = $request->latitude;
        $bank->save();

        return redirect()->route('banks.index')->with('success_message', 'BANK updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();

        return redirect()->route('banks.index')->with('success_message', 'BANK deleted successfully!');
    }

    public function welcome()
    {
        $banks = Bank::all();
        return view('welcome', [
            'banks' => $banks
        ]);
    }
}

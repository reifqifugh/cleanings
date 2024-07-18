<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Menampilkan daftar semua metode pembayaran.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('payment_methods.index', compact('paymentMethods'));
    }

    /**
     * Menampilkan formulir untuk membuat metode pembayaran baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment_methods.create');
    }

    /**
     * Menyimpan metode pembayaran yang baru dibuat ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'details' => 'nullable|string',
        ]);

        PaymentMethod::create($request->all());

        return redirect()->route('payment_methods.index')
                         ->with('success', 'Payment Method created successfully.');
    }

    /**
     * Menampilkan detail dari suatu metode pembayaran.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('payment_methods.show', compact('paymentMethod'));
    }

    /**
     * Menampilkan formulir untuk mengedit metode pembayaran yang ada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('payment_methods.edit', compact('paymentMethod'));
    }

    /**
     * Memperbarui metode pembayaran yang ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'details' => 'nullable|string',
        ]);

        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->update($request->all());

        return redirect()->route('payment_methods.index')
                         ->with('success', 'Payment Method updated successfully.');
    }

    /**
     * Menghapus metode pembayaran dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();

        return redirect()->route('payment_methods.index')
                         ->with('success', 'Payment Method deleted successfully.');
    }
}

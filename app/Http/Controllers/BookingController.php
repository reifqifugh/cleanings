<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Category;
use App\Models\RoomSize;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function index()
    {
        $bookings =  $bookings = Booking::all();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $categories = Category::all();
        $roomSizes = RoomSize::all();
        $paymentMethods = PaymentMethod::all();
    
        return view('bookings.create', compact('categories', 'roomSizes', 'paymentMethods'));
    }
    

    

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'size' => 'required|numeric|min:1',
            'room_size_id' => 'required',
            'address' => 'required|string',
            'phone' => 'required|string',
            'booking_date' => 'required|date',
            'payment_method_id' => 'required',
            'payment_proof' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
        ]);
    
        // Upload file payment_proof if exists
        $path = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $fileName = 'payment_proof_' . auth()->user()->id . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/payment_proofs', $fileName);
        }
    
        // Calculate total price based on category and room size
        $category = Category::findOrFail($request->category_id);
        $roomSize = RoomSize::findOrFail($request->room_size_id);
        $totalPrice = ($category->price + $roomSize->price_per_meter) * $request->size;
    
        // Create new Booking instance
        $booking = new Booking();
        $booking->category_id = $request->category_id;
        $booking->size = $request->size;
        $booking->room_size_id = $request->room_size_id;
        $booking->user_id = auth()->user()->id;
        $booking->address = $request->address;
        $booking->phone = $request->phone;
        $booking->booking_date = $request->booking_date;
        $booking->total_price = $totalPrice;
        $booking->payment_method_id = $request->payment_method_id;
        $booking->payment_proof = $path;
    
        // Generate booking code and save it
        $booking->booking_code = 'BOOK-' . strtoupper(Str::random(8));
        $booking->save();
    
        return redirect()->route('client.home')->with('success', 'Booking created successfully.');
    }
    

    

    
    
public function verify($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = Booking::STATUS_VERIFIED;
        $booking->save();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking verified successfully.');
    }


    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $categories = Category::all();
        $paymentMethods = PaymentMethod::all();
        $roomSizes = RoomSize::all();
        return view('bookings.edit', compact('booking', 'categories', 'paymentMethods', 'roomSizes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'address' => 'required',
            'phone' => 'required',
            'booking_date' => 'required|date',
            'size' => 'nullable|numeric',
            'room_size_id' => 'nullable|exists:room_sizes,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'payment_proof' => 'nullable'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($validated);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
   
    public function search(Request $request)
    {
        $booking_kode = $request->input('booking_kode');
    
        if (empty($booking_kode)) {
            return redirect()->back()->with('error', 'Please enter a booking code.');
        }
    
        $booking = Booking::where('booking_code', $booking_kode)->first();
    
        if (!$booking) {
            Log::debug('Booking not found for booking_code: ' . $booking_kode);
            return redirect()->back()->with('error', 'Booking not found');
        }
    
        return redirect()->route('bookings.show', $booking->id);
    }
    
    


    public function show($id)
    {
        $booking = Booking::with(['category', 'user', 'roomSize', 'paymentMethod'])->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }
    
}

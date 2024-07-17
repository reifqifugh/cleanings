<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomSize;
use App\Models\Category; // Import model Category jika belum diimport

class RoomSizeController extends Controller
{
    // Menampilkan semua data room_sizes
    public function index()
    {
        $roomSizes = RoomSize::all();
        return view('room_sizes.index', compact('roomSizes'));
    }

    // Menampilkan form untuk membuat room_size baru
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('room_sizes.create', compact('categories'));
    }

    // Menyimpan room_size baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        RoomSize::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('room_sizes.index')->with('success', 'Room created successfully.');
    }

    // Menampilkan form untuk mengedit room_size
    public function edit(RoomSize $roomSize)
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('room_sizes.edit', compact('roomSize', 'categories'));
    }

    public function update(Request $request, RoomSize $room)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);
    
        // Update room size data
        $room->category_id = $request->category_id;
        $room->name = $request->name;
        $room->price = $request->price;
        $room->save();
    
        return redirect()->route('room_sizes.index')->with('success', 'Room updated successfully.');
    }
    
    // Menghapus room_size dari database
    public function destroy(RoomSize $roomSize)
    {
        $roomSize->delete();

        return redirect()->route('room_sizes.index')
            ->with('success', 'Room Size deleted successfully.');
    }
}

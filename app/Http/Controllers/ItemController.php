<?php
namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $items = Item::when($query, function ($queryBuilder, $query) {
            return $queryBuilder->where('code', 'like', '%' . $query . '%');
        })->get();

        return view('items.index', compact('items', 'query'));
    }

    public function admin(Request $request)
    {
        $items = Item::all();
        return view('items.admin', compact('items'));
    }

    public function search(Request $request)
    {
        $code = $request->input('code');
        
        if (!$code) {
            return redirect()->route('items.index')->with('error', 'Kode tidak boleh kosong');
        }

        // Cari item berdasarkan kode
        $item = Item::where('code', $code)->first();
        
        if ($item) {
            // Jika item ditemukan, tampilkan pesan dan data item
            $message = $item->message ?? 'Pesan khusus untukmu!';
            return view('items.search', compact('message', 'item'));
        } else {
            // Jika item tidak ditemukan
            return view('items.search');
        }
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'code' => 'required|exists:items,code',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $item = Item::where('code', $request->code)->first();
        
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($item->photo && Storage::disk('public')->exists($item->photo)) {
                Storage::disk('public')->delete($item->photo);
            }
            
            // Upload foto baru
            $photoPath = $request->file('photo')->store('photos', 'public');
            $item->update(['photo' => $photoPath]);
            
            return redirect()->back()->with('success', 'Foto berhasil diupload!');
        }
        
        return redirect()->back()->with('error', 'Gagal mengupload foto');
    }
}
<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Comment;
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
        $allComments = Comment::orderBy('created_at', 'desc')->get();
        return view('items.admin', compact('items', 'allComments'));
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
            
            // Fetch comments for this item
            $comments = Comment::where('item_code', $code)->orderBy('created_at', 'desc')->get();
            
            return view('items.search', compact('message', 'item', 'comments'));
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

    public function addComment(Request $request)
    {
        $request->validate([
            'commenter_name' => 'required|string|max:255',
            'comment_text' => 'required|string|max:1000',
            'item_code' => 'required|string',
            'item_name' => 'required|string'
        ]);

        try {
            Comment::create([
                'commenter_name' => $request->commenter_name,
                'comment_text' => $request->comment_text,
                'item_code' => $request->item_code,
                'item_name' => $request->item_name
            ]);

            return redirect()->back()->with('comment_success', 'Komentar berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('comment_error', 'Gagal menambahkan komentar. Silakan coba lagi.');
        }
    }
}
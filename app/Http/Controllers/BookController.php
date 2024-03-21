<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = Book::all();
        $categories = Category::all();
        return view('user.landing', compact('book', 'categories'));
    }
    public function book()
    {
        $book = Book::all();
        $categories = Category::all();
        return view('admin.book', compact('book', 'categories'));
    }
    public function pinjam()
    {
        $book = Book::all();
        return view('admin.pinjam', compact('book'));
    }

    public function pinjamUser() {
        $pinjams = Pinjam::all();
        return view('user.pinjam', compact('pinjams'));
    }
    public function collection()
    {
        return view('user.collection');
    }
    public function review()
    {
        return view('user.review');
    }


    public function error()
    {
        return view('user.error');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function createBook(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'synopsis' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg',
            'category' => 'required',
            'writer' => 'required',
        ]);
        $image = $request->file('image');
        $imgName = time() . rand() . '.' . $image->extension();

        if (!file_exists(public_path('/assets/img/' . $image->getClientOriginalName()))) {
            $destinationPath = public_path('/assets/img/');
            $image->move($destinationPath, $imgName);
            $uploaded = $imgName;
        } else {
            $uploaded = $image->getClientOriginalName();
        };
        Book::create([
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'synopsis' => $request->synopsis,
            'image' => $uploaded,
            'category' => $request->category,
            'writer' => $request->writer,
            'done_time' => \Carbon\carbon::now(),
            'status' => 0,
        ]);
        return redirect()->back();
    }

    public function updatePeminjam($id)
    {
        $book = Book::find($id);

        if ($book) {
            $updateData = [
                'status' => 1,
                'done_time' => \Carbon\Carbon::now(),
            ];

            $updateData1 = [
                'status' => 0,
                'done_time' => \Carbon\Carbon::now(),
            ];

            if ($book->status == 0) {
                $book->update($updateData);
                return redirect()->back()->with('done', 'Buku sedang dikerjakan');
            } elseif ($book->status == 1) {
                $book->update($updateData1);
                return redirect()->back()->with('done', 'Buku sedang dikerjakan');
            }
        }
    }

    /// Category
    public function category()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function createCategory(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);
        Category::create([
            'category' => $request->category,
        ]);
        return redirect()->back()->with('doneCate', 'Category berhasil ditambahkan');
    }

    public function deleteCategory($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('donedelete', 'data berhasil di delete');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'synopsis' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg',
            'category' => 'required',
            'writer' => 'required',
        ]);
        $image = $request->file('image');
        $imgName = time() . rand() . '.' . $image->extension();

        if (!file_exists(public_path('/assets/img/' . $image->getClientOriginalName()))) {
            $destinationPath = public_path('/assets/img/');
            $image->move($destinationPath, $imgName);
            $uploaded = $imgName;
        } else {
            $uploaded = $image->getClientOriginalName();
        };
        Book::where('id', $id)->update([
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'synopsis' => $request->synopsis,
            'image' => $uploaded,
            'category' => $request->category,
            'writer' => $request->writer,
            'done_time' => \Carbon\carbon::now(),
            'status' => 0,
        ]);
        return redirect()->back();
    }

    public function borrowBook($id)
{
    $user = auth()->user(); // Mendapatkan user yang sedang login
    $book = Book::findOrFail($id); // Mendapatkan informasi buku berdasarkan ID

    // Simpan informasi peminjaman ke dalam tabel pinjams
    $pinjam = new Pinjam();
    $pinjam->username = $user->username;
    $pinjam->judul = $book->judul;
    $pinjam->tanggalPeminjaman = now();
    $pinjam->tanggalPengembalian = now()->addDays(7); // Contoh: Pengembalian dalam 7 hari
    $pinjam->statusPeminjaman = 'Belum dikembalikan';
    $pinjam->save();

    return redirect('/borrow')->with('success', 'Buku berhasil dipinjam.');
}

public function pengembalian(Pinjam $pinjam)
{
    // Memperbarui status peminjaman menjadi 'Sudah Dikembalikan'
    $pinjam->statusPeminjaman = 'Sudah Dikembalikan';
    $pinjam->save();

    // Redirect kembali ke halaman peminjaman dengan pesan sukses
    return redirect()->back()->with('success', 'Buku telah berhasil dikembalikan.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Book::find($id)->delete();
        return redirect('/dashboard/book');
    }
}

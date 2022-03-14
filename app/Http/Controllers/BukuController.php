<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $no = Buku::paginate(15);
        $pagination = 5;
        $bukus = Buku::all();
        $buku = Buku::when($request->keyword, function ($query) use ($request) {
            $query
            ->where('judul', 'like', "%{$request->keyword}%");
        })->orderBy('judul')->paginate($pagination);
    
        $buku->appends($request->only('keyword'));
    
        return view('index', ['bukus' => $bukus, 'judul' => 'buku'])->with('i', ($request->input('page', 1) - 1) * $pagination);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $input = $request->all();
        $buku = Buku::create([
            'id' => $input['id'],
            'judul' => $input['judul'],
            'author' => $input['author'],
            'penerbit' => $input['penerbit'],
            'sinopsis' => $input['sinopsis']
        ]);
        return redirect()->route('buku.index')->with('success', 'Data buku telah berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bukus = Buku::all();
        return view('index', ['bukus' => $bukus]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('modals.edit', ['buku' => $buku]);
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
        $request->validate([
            'id' => 'required',
            'judul' => 'required',
            'author' => 'required',
            'penerbit' => 'required',
            'sinopsis' => 'required'
        ]);

        $buku = Buku::find($id)->update($request->all());
        return redirect()->route('buku.index')->with('success', "Data telah berhasil diperbaharui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return back()->with('success', 'Penghapusan data telah berhasil');
    }

    public function tambah()
    {
        return view('modals.tambah');
    }

    public function search(Request $request){
        $keywords = $request->search();
        $buku = Buku::where('judul', 'like', '%'. $keywords . '%')->orderBy('judul', 'desc')->paginate(5);
        return view('index', compact('buku'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function showData($id)
    {
        $buku = Buku::findOrFail($id);
        return $buku;
    }
}

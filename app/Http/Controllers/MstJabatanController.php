<?php

namespace App\Http\Controllers;

use App\Models\MstJabatan;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class MstJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*********************************************
     * method untuk menampilkan tabel.
     * menggunakan view index.blade.php
     * di dalam folder \views\mst-jabatan
     * @return \Illuminate\Http\Response
     ********************************************/
    public function index()
    {
        //variabel pecarian
        $search = \Request::get('search');
        $p = MstJabatan::paginate(); //mangatur tampil perhalaman

        //menjalankan query builder
        $mstJabatan = \DB::table('mst_jabatan')
            ->where('nama_jabatan', 'LIKE', '%' . $search . '%')
            ->paginate($p->perPage());

        //memanggil view dan menyertakan hasil quey
        return view('mst-jabatan.index', compact('mstJabatan'))
            ->with('i', (request()->input('page', 1) - 1) *
                $p->perPage());
    }

    /***********************************************
     * method menjalankan masukan menggunakan form.
     * menggunakan view create.blade.php, form.blade.php
     * search.blade.php
     * di dalam folder \views\mst-jabatan
     * @return \Illuminate\Http\Response
     ***********************************************/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mstJabatan = new MstJabatan();
        return view('mst-jabatan.create', compact('mstJabatan'));
    }

    /********************************************************
     * method store(), untuk menyimpan, masukan dari create()
     * ke tabel mst_jabatan
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *******************************************************/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //cek validasi masukan
        request()->validate(MstJabatan::$rules);
        // echo $request->nama_jabatan.$request->tunjangan;
        //mulai transaksi
        \DB::beginTransaction();
        try {
            //menyimpan ke tabel mst_jabatan 
            $jabatan = new MstJabatan();
            $jabatan->nama_jabatan = $request->nama_jabatan;
            $jabatan->tunjangan = $request->tunjangan;
            $jabatan->save();
            //jika tidak ada kesalahan commit/simpan
            \DB::commit();
            // mengembalikan tampilan ke view index (halaman sebelumnya)
            return redirect()->route('mst-jabatan.index')
                ->with('success', 'MstJabatan telah berhasil disimpan.');
        } catch (\Throwable $e) {
            //jika terjadi kesalahan batalkan semua
            \DB::rollback();
            return redirect()->route('mst-jabatan.index')
                ->with('success', 'Penyimpanan dibatalkan semua, ada kesalahan...');
        }
    }

    /**************************************************
     * Menampilkan 1 rekaman secara detail dengan.
     * pencarian kunci primer $id
     * ditampilkan ke view\mst-jabatan\show.blade.php
     * @param int $id
     * @return \Illuminate\Http\Response
     ************************************************/
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mstJabatan = MstJabatan::find($id);
        //menampikan ke view show
        return view('mst-jabatan.show', compact('mstJabatan'));
    }

    /***********************************************
     * Method untuk mengubah 1 rekaman
     * menggunakan view\mst-jabatan\edit.blade.php
     * @param int $id
     * @return \Illuminate\Http\Response
     ***********************************************/
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mstJabatan = MstJabatan::find($id);
        //menampikan 1 rekaman ke view edit
        return view('mst-jabatan.edit', compact('mstJabatan'));
    }

    /******************************************************
     * Metho update(), untuk menyimpan kembali
     * ke tabel mst_jabatan dari edit()
     *
     * @param \Illuminate\Http\Request $request
     * @param MstJabatan $mstJabatan
     * @return \Illuminate\Http\Response
     *******************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate(MstJabatan::$rules);
        //mulai transaksi
        \DB::beginTransaction();
        try {

            $jabatan = MstJabatan::find($id);
            $jabatan->nama_jabatan = $request->nama_jabatan;
            $jabatan->tunjangan = $request->tunjangan;
            $jabatan->save();
            \DB::commit();
            //mengembalikan tampilan ke view index (halaman sebelumnya)
            return redirect()->route('mst-jabatan.index')
                ->with('success', 'MstJabatan berhasil diubah');
        } catch (\Throwable $e) {
            //jika terjadi kesalahan batalkan semua
            \DB::rollback();
            return redirect()->route('mst-jabatan.index')
                ->with('success', 'MstJabatan batal diubah, ada kesalahan');
        }
    }

    /***************************************************
     * method untuk menghapus 1 rekaman
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     **************************************************/
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //mulai transaksi
        \DB::beginTransaction();
        try {
            //menghapus 1 rekaman tabel mst_jabatan
            $mstJabatan = MstJabatan::find($id)->delete();
            \DB::commit();
            // mengembalikan tampilan ke view index (halaman sebelumnya)
            return redirect()->route('mst-jabatan.index')
                ->with('success', 'MstJabatan berhasil dihapus');
        } catch (\Throwable $e) {
            //jika terjadi kesalahan batalkan semua
            \DB::rollback();
            return redirect()->route('mst-jabatan.index')
                ->with(
                    'success',
                    'MstJabatan ada kesalahan hapus batal... '
                );
        }
    }
}

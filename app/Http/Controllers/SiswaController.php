<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;  // 1. Import Log facade
use App\Models\Siswa;

class SiswaController extends Controller
{
    // Menampilkan daftar siswa
    public function index()
    {
        try {
            return Siswa::all();
        } catch (\Exception $e) {
            // 2. Menambahkan logging untuk error
            Log::error('Error: ' . $e->getMessage(), [
                'exception' => $e,
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['error' => 'Gagal mengambil data siswa.'], 500);
        }
    }

    // Menyimpan data siswa
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama' => ['sometimes', 'required', 'string', 'regex:/^[a-zA-Z\s]+$/'], // hanya huruf dan spasi
            'kelas' => ['sometimes', 'required', 'string', 'regex:/^XII\sMIPA\s[1-9]$/'], // format "XII MIPA 1"
            'umur' => ['sometimes', 'required', 'integer', 'between:7,25'], // rentang umur 7 hingga 25 tahun
        ]);

        try {
            // Menyimpan data siswa
            $siswa = Siswa::create([
                'nama' => $validated['nama'],
                'kelas' => $validated['kelas'],
                'umur' => $validated['umur'],
            ]);

            return response()->json([
                'message' => 'Siswa berhasil ditambahkan!',
                'data' => $siswa
            ], 201);
        } catch (\Exception $e) {
            // 3. Menambahkan logging untuk error
            Log::error('Error: ' . $e->getMessage(), [
                'exception' => $e,
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['error' => 'Gagal menyimpan data siswa.'], 500);
        }
    }

    // Menampilkan detail siswa
    public function show($id)
    {
        try {
            return Siswa::findOrFail($id);
        } catch (\Exception $e) {
            // 4. Menambahkan logging untuk error
            Log::error('Error: ' . $e->getMessage(), [
                'exception' => $e,
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['error' => 'Siswa tidak ditemukan.'], 404);
        }
    }

    // Mengupdate data siswa
    public function update(Request $request, $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);

            // Validasi data
            $validated = $request->validate([
                'nama' => ['sometimes', 'required', 'string', 'regex:/^[a-zA-Z\s]+$/'], // hanya huruf dan spasi
                'kelas' => ['sometimes', 'required', 'string', 'regex:/^XII\sMIPA\s[1-9]$/'], // format "XII MIPA 1"
                'umur' => ['sometimes', 'required', 'integer', 'between:7,25'], // rentang umur 7 hingga 25 tahun
            ]);

            $siswa->update([
                'nama' => $validated['nama'],
                'kelas' => $validated['kelas'],
                'umur' => $validated['umur'],
            ]);

            return response()->json([
                'message' => 'Data siswa berhasil diupdate!',
                'data' => $siswa
            ]);
        } catch (\Exception $e) {
            // 5. Menambahkan logging untuk error
            Log::error('Error: ' . $e->getMessage(), [
                'exception' => $e,
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['error' => 'Gagal memperbarui data siswa.'], 500);
        }
    }

    // Menghapus data siswa
    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            // 6. Menambahkan logging untuk error
            Log::error('Error: ' . $e->getMessage(), [
                'exception' => $e,
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['error' => 'Gagal menghapus data siswa.'], 500);
        }
    }
}

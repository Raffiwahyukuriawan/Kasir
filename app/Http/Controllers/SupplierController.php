<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;

class SupplierController
{
    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'desc')->paginate(25);

        return view('supplier', [
            'title' => 'Supplier',
            'suppliers' => $suppliers,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier' => 'required|string|unique:suppliers,supplier',
            'no_telp' => 'required|regex:/^[0-9]{10,15}$/|unique:suppliers,no_telp'
        ]);

        try {
            Supplier::create([
                'supplier' => $request->supplier,
                'no_telp' => $request->no_telp,
            ]);
            return redirect()->route('supplier')->with([
                'status' => 'success',
                'message' => 'Supplier berhasil ditambahkan.',
            ]);
        } catch (\Exception) {
            return redirect()->route('supplier')->with([
                'status' => 'error',
                'message' => 'Gagal menambahkan Supplier.',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'supplier' => 'required|string',
            'no_telp' => 'required|regex:/^[0-9]{10,15}$/'
        ]);

        try {
            $supplier = Supplier::findOrFail($id);        
            $cek = $supplier->update([
                'supplier' => $request->supplier,
                'no_telp' => $request->no_telp,
            ]);
            return redirect()->route('supplier')->with([
                'status' => 'success',
                'message' => 'Supplier berhasil diupdate.',
            ]);
        } catch (Exception) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Supplier Gagal diupdate.',
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
            return redirect()->route('supplier')->with([
                'status' => 'success',
                'message' => 'Supplier berhasil dihapus.',
            ]);
        } catch (Exception) {
            return redirect()->route('supplier')->with([
                'status' => 'error',
                'message' => 'Supplier berhasil dihapus.',
            ]);
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $suppliers = Supplier::where('supplier','LIKE',"%{$keyword}%")
        ->orWhere('no_telp','LIKE',"%{$keyword}%")
        ->get();

        return response()->json($suppliers);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        // 1. Feature Live Search Real-time
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('contact_person', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 2. Feature Filter Performance / Sorting
        if ($request->has('sort') && $request->sort == 'high') {
            $query->orderBy('name', 'asc');
        } else {
            $query->latest();
        }

        $suppliers = $query->get();

        // Jika dipanggil via AJAX untuk live search
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'suppliers' => $suppliers
            ]);
        }

        return view('suppliers', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone'          => 'nullable|string|max:50',
            'email'          => 'nullable|email|max:255',
            'address'        => 'nullable|string',
        ]);

        $supplier = Supplier::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Supplier berhasil ditambahkan!',
                'data'    => $supplier
            ]);
        }

        return redirect()->back()->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Supplier berhasil dihapus!'
        ]);
    }
}
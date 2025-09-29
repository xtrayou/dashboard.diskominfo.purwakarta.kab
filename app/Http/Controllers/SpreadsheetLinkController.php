<?php

namespace App\Http\Controllers;

use App\Models\SpreadsheetLink;
use Illuminate\Http\Request;

class SpreadsheetLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $links = SpreadsheetLink::orderBy('created_at', 'desc')->get();
        return view('admin.spreadsheet-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.spreadsheet-links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'range' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Extract sheet ID from URL
        if (preg_match('/\/spreadsheets\/d\/([a-zA-Z0-9-_]+)/', $request->url, $matches)) {
            $data['sheet_id'] = $matches[1];
        }

        SpreadsheetLink::create($data);

        return redirect()->route('admin.spreadsheet-links.index')
            ->with('success', 'Link spreadsheet berhasil ditambahkan!');
    }

    public function show(SpreadsheetLink $spreadsheetLink)
    {
        return view('admin.spreadsheet-links.show', compact('spreadsheetLink'));
    }

    public function edit(SpreadsheetLink $spreadsheetLink)
    {
        return view('admin.spreadsheet-links.edit', compact('spreadsheetLink'));
    }

    public function update(Request $request, SpreadsheetLink $spreadsheetLink)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'range' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Extract sheet ID from URL
        if (preg_match('/\/spreadsheets\/d\/([a-zA-Z0-9-_]+)/', $request->url, $matches)) {
            $data['sheet_id'] = $matches[1];
        }

        $spreadsheetLink->update($data);

        return redirect()->route('admin.spreadsheet-links.index')
            ->with('success', 'Link spreadsheet berhasil diupdate!');
    }

    public function destroy(SpreadsheetLink $spreadsheetLink)
    {
        $spreadsheetLink->delete();

        return redirect()->route('admin.spreadsheet-links.index')
            ->with('success', 'Link spreadsheet berhasil dihapus!');
    }

    public function testConnection(SpreadsheetLink $spreadsheetLink)
    {
        try {
            $data = $spreadsheetLink->getGoogleSheetsData();
            return response()->json([
                'success' => true,
                'message' => 'Koneksi berhasil!',
                'data_count' => count($data['opd_data'] ?? [])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Koneksi gagal: ' . $e->getMessage()
            ], 400);
        }
    }
}

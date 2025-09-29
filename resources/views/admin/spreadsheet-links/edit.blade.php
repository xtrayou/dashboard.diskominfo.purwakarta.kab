<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Link Spreadsheet - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    @include('layouts.navbar')

    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Edit Link Spreadsheet</h1>
            <p class="text-gray-600">Perbarui informasi link Google Sheets</p>
        </div>

        <div class="max-w-2xl bg-white rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('admin.spreadsheet-links.update', $spreadsheetLink) }}">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Deskripsi</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $spreadsheetLink->name) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Data OPD Purwakarta 2025" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-2">URL Google Sheets</label>
                    <input type="url" id="url" name="url" value="{{ old('url', $spreadsheetLink->url) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="https://docs.google.com/spreadsheets/d/..." required>
                    @if($spreadsheetLink->sheet_id)
                    <p class="text-sm text-gray-500 mt-1">
                        Sheet ID Terdeteksi: <code class="bg-gray-100 px-1 rounded">{{ $spreadsheetLink->sheet_id }}</code>
                    </p>
                    @endif
                    @error('url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="range" class="block text-sm font-medium text-gray-700 mb-2">Range Data</label>
                    <input type="text" id="range" name="range" value="{{ old('range', $spreadsheetLink->range) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="A:Z">
                    <p class="text-sm text-gray-500 mt-1">
                        Contoh: A:Z (semua kolom), A1:D100 (range spesifik)
                    </p>
                    @error('range')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Deskripsi singkat tentang data ini...">{{ old('description', $spreadsheetLink->description) }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $spreadsheetLink->is_active) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Aktifkan link ini</span>
                    </label>
                    <p class="text-sm text-gray-500 mt-1">
                        Mengaktifkan link ini akan menonaktifkan link lainnya
                    </p>
                </div>

                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                        Update Link
                    </button>
                    <a href="{{ route('admin.spreadsheet-links.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Information Section -->
        <div class="max-w-2xl mt-8 bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Link</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Dibuat:</span>
                    <span class="font-medium">{{ $spreadsheetLink->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Terakhir Update:</span>
                    <span class="font-medium">{{ $spreadsheetLink->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Link Spreadsheet - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    @include('layouts.navbar')

    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Link Spreadsheet</h1>
            <p class="text-gray-600">Tambahkan sumber data Google Sheets baru untuk dashboard</p>
        </div>

        <div class="max-w-2xl bg-white rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('admin.spreadsheet-links.store') }}">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Deskripsi</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Data OPD Purwakarta 2025" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-2">URL Google Sheets</label>
                    <input type="url" id="url" name="url" value="{{ old('url') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="https://docs.google.com/spreadsheets/d/..." required>
                    <p class="text-sm text-gray-500 mt-1">
                        Pastikan Google Sheets dapat diakses publik atau memiliki izin yang sesuai
                    </p>
                    @error('url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="range" class="block text-sm font-medium text-gray-700 mb-2">Range Data (Opsional)</label>
                    <input type="text" id="range" name="range" value="{{ old('range', 'A:Z') }}"
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
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Deskripsi singkat tentang data ini...">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Aktifkan link ini</span>
                    </label>
                    <p class="text-sm text-gray-500 mt-1">
                        Hanya satu link yang dapat aktif dalam satu waktu
                    </p>
                </div>

                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                        Simpan Link
                    </button>
                    <a href="{{ route('admin.spreadsheet-links.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="max-w-2xl mt-8 bg-blue-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">Panduan Menggunakan Google Sheets</h3>
            <ol class="list-decimal list-inside space-y-2 text-sm text-blue-700">
                <li>Buka Google Sheets yang berisi data OPD dan subdomain</li>
                <li>Klik "Bagikan" di pojok kanan atas</li>
                <li>Ubah izin akses menjadi "Siapa saja dengan link dapat melihat"</li>
                <li>Salin URL yang dibagikan dan tempel di form di atas</li>
                <li>Pastikan struktur data sesuai dengan format yang diharapkan dashboard</li>
            </ol>
        </div>
    </div>
</body>

</html>
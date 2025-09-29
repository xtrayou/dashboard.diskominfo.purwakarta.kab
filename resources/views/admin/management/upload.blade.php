<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upload Data Spreadsheet
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Upload File CSV
                            </label>
                            <input type="file" name="file" accept=".csv" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-sm text-gray-500 mt-1">
                                Format yang didukung: .csv (Max: 2MB)
                            </p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Format Kolom Excel:</h4>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• <strong>nama_opd:</strong> Nama OPD (Required)</li>
                                <li>• <strong>kecamatan:</strong> Nama Kecamatan (Optional)</li>
                                <li>• <strong>domain:</strong> Nama Domain (Required)</li>
                                <li>• <strong>subdomain:</strong> Nama Subdomain (Optional)</li>
                                <li>• <strong>status:</strong> aktif/tidak_aktif (Optional)</li>
                                <li>• <strong>backup_date:</strong> Format: YYYY-MM-DD (Optional)</li>
                                <li>• <strong>completion_date:</strong> Format: YYYY-MM-DD (Optional)</li>
                            </ul>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Import Data
                            </button>

                            <a href="{{ route('admin.index') }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
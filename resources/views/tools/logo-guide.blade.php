<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Upload Logo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">🖼️ Panduan Menambahkan Logo PNG</h1>

        <!-- Step 1 -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-blue-600 mb-4">📁 Step 1: Upload Logo ke Folder</h2>
            <div class="bg-gray-50 p-4 rounded-lg mb-4">
                <p class="font-medium text-gray-800 mb-2">Lokasi folder untuk logo:</p>
                <code class="bg-gray-800 text-green-400 px-3 py-1 rounded">
                    public/images/logos/
                </code>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="border-2 border-dashed border-gray-300 p-6 text-center rounded-lg">
                    <div class="text-4xl mb-2">📁</div>
                    <p class="text-gray-600">Copy file PNG Anda ke:</p>
                    <p class="font-mono text-sm bg-gray-100 p-2 rounded mt-2">
                        C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\public\images\logos\
                    </p>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-blue-800 mb-2">Contoh nama file:</h3>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• logo-purwakarta.png</li>
                        <li>• logo-diskominfo.png</li>
                        <li>• logo-pemkab.png</li>
                        <li>• favicon.png</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-green-600 mb-4">🔧 Step 2: Update Code</h2>

            <div class="mb-4">
                <p class="text-gray-700 mb-2">Logo sudah otomatis terupdate di navbar dengan kode:</p>
                <div class="bg-gray-900 text-gray-100 p-4 rounded-lg overflow-x-auto">
                    <pre><code>&lt;img src="{{ asset('images/logos/logo-purwakarta.png') }}" 
     alt="Logo Purwakarta" 
     class="w-12 h-12 object-contain"&gt;</code></pre>
                </div>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <p class="text-yellow-800">
                    <strong>Catatan:</strong> Jika file logo tidak ditemukan, sistem akan otomatis menggunakan logo default dari internet sebagai fallback.
                </p>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-purple-600 mb-4">🎨 Step 3: Ukuran Logo yang Disarankan</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-gray-50 rounded">
                    <div class="w-8 h-8 bg-blue-500 rounded mx-auto mb-2"></div>
                    <p class="text-sm font-medium">Navbar Small</p>
                    <p class="text-xs text-gray-600">32x32px</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded">
                    <div class="w-12 h-12 bg-green-500 rounded mx-auto mb-2"></div>
                    <p class="text-sm font-medium">Navbar Normal</p>
                    <p class="text-xs text-gray-600">48x48px</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded">
                    <div class="w-16 h-16 bg-red-500 rounded mx-auto mb-2"></div>
                    <p class="text-sm font-medium">Header Large</p>
                    <p class="text-xs text-gray-600">64x64px</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded">
                    <div class="w-20 h-20 bg-yellow-500 rounded mx-auto mb-2"></div>
                    <p class="text-sm font-medium">Login Page</p>
                    <p class="text-xs text-gray-600">80x80px</p>
                </div>
            </div>
        </div>

        <!-- Current Status -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">📊 Status Saat Ini</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold text-gray-700 mb-2">Logo Navbar:</h3>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/logos/logo-purwakarta.png') }}"
                            alt="Logo Test"
                            class="w-8 h-8 object-contain"
                            onerror="this.src='https://via.placeholder.com/32x32/3B82F6/FFFFFF?text=LOGO';">
                        <span class="text-sm text-gray-600">logo-purwakarta.png</span>
                    </div>
                </div>

                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold text-gray-700 mb-2">Logo Diskominfo:</h3>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/logos/logo-diskominfo.png') }}"
                            alt="Logo Diskominfo Test"
                            class="w-8 h-8 object-contain"
                            onerror="this.src='https://via.placeholder.com/32x32/10B981/FFFFFF?text=DISKO';">
                        <span class="text-sm text-gray-600">logo-diskominfo.png</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="font-semibold text-blue-800 mb-2">✅ Checklist:</h3>
                <ul class="text-blue-700 space-y-1">
                    <li>□ Upload logo-purwakarta.png ke folder public/images/logos/</li>
                    <li>□ Upload logo-diskominfo.png ke folder public/images/logos/</li>
                    <li>□ Refresh halaman untuk melihat logo baru</li>
                    <li>□ Test di berbagai ukuran layar (mobile/desktop)</li>
                </ul>
            </div>
        </div>

        <!-- Back to Dashboard -->
        <div class="text-center mt-8">
            <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>

</html>
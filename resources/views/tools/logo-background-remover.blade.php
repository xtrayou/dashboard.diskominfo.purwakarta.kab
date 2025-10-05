<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo Background Remover - Diskominfo Tool</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .logo-no-bg {
            mix-blend-mode: multiply;
            filter: contrast(1.2) brightness(1.1);
        }

        .logo-transparent {
            background: transparent !important;
            mix-blend-mode: darken;
        }

        .remove-white-bg {
            filter: contrast(1.2) brightness(1.1) saturate(1.1);
            mix-blend-mode: multiply;
            background-color: transparent;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen p-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">🎨 Logo Background Remover</h1>
                <p class="text-gray-600">Tool untuk menghilangkan background putih dari logo Diskominfo</p>
            </div>

            <!-- Logo Preview Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Original Logo -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📸 Logo Original (dengan background)</h3>
                    <div class="bg-white p-8 rounded-lg border-2 border-dashed border-gray-300 text-center">
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Upload logo Diskominfo di sini:</p>
                            <input type="file" id="logoUpload" accept="image/*" class="hidden">
                            <button onclick="document.getElementById('logoUpload').click()"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                Pilih File PNG
                            </button>
                        </div>
                        <img id="originalLogo" src="" alt="Logo Original" class="mx-auto max-w-full h-32 object-contain hidden">
                    </div>
                </div>

                <!-- Processed Logo -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">✨ Logo Tanpa Background</h3>
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-8 rounded-lg text-center">
                        <img id="processedLogo" src="" alt="Logo Processed" class="mx-auto max-w-full h-32 object-contain hidden logo-no-bg">
                        <p id="placeholder" class="text-white text-sm">Preview akan muncul setelah upload</p>
                    </div>
                </div>
            </div>

            <!-- Logo Tests -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">🧪 Test Logo di Berbagai Background</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- White Background -->
                    <div class="bg-white p-4 rounded-lg border text-center">
                        <p class="text-xs text-gray-600 mb-2">White BG</p>
                        <img id="testLogo1" src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}"
                            alt="Test Logo" class="mx-auto w-16 h-16 object-contain">
                    </div>

                    <!-- Blue Background -->
                    <div class="bg-blue-500 p-4 rounded-lg text-center">
                        <p class="text-xs text-white mb-2">Blue BG</p>
                        <img id="testLogo2" src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}"
                            alt="Test Logo" class="mx-auto w-16 h-16 object-contain">
                    </div>

                    <!-- Dark Background -->
                    <div class="bg-gray-800 p-4 rounded-lg text-center">
                        <p class="text-xs text-white mb-2">Dark BG</p>
                        <img id="testLogo3" src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}"
                            alt="Test Logo" class="mx-auto w-16 h-16 object-contain">
                    </div>

                    <!-- Gradient Background -->
                    <div class="bg-gradient-to-br from-green-400 to-blue-500 p-4 rounded-lg text-center">
                        <p class="text-xs text-white mb-2">Gradient BG</p>
                        <img id="testLogo4" src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}"
                            alt="Test Logo" class="mx-auto w-16 h-16 object-contain">
                    </div>
                </div>
            </div>

            <!-- CSS Methods -->
            <div class="bg-yellow-50 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-yellow-800 mb-4">🎨 CSS Methods untuk Remove Background</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800 mb-2">Method 1: Mix Blend</h4>
                        <code class="text-xs bg-gray-100 p-2 rounded block">
                            mix-blend-mode: multiply;<br>
                            filter: contrast(1.2);
                        </code>
                        <div class="mt-2 p-2 bg-blue-500 rounded">
                            <img src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}"
                                class="w-8 h-8 mx-auto logo-no-bg">
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800 mb-2">Method 2: Transparent</h4>
                        <code class="text-xs bg-gray-100 p-2 rounded block">
                            background: transparent;<br>
                            mix-blend-mode: darken;
                        </code>
                        <div class="mt-2 p-2 bg-green-500 rounded">
                            <img src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}"
                                class="w-8 h-8 mx-auto logo-transparent">
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800 mb-2">Method 3: Filter</h4>
                        <code class="text-xs bg-gray-100 p-2 rounded block">
                            filter: contrast(1.2)<br>
                            brightness(1.1);
                        </code>
                        <div class="mt-2 p-2 bg-purple-500 rounded">
                            <img src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}"
                                class="w-8 h-8 mx-auto remove-white-bg">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Implementation -->
            <div class="bg-green-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-green-800 mb-4">✅ Current Implementation</h3>
                <div class="bg-white p-4 rounded-lg">
                    <p class="text-gray-700 mb-3">Logo Diskominfo sudah diimplementasikan di navbar dengan format SVG (tanpa background):</p>
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4 rounded-lg">
                        <div class="flex items-center space-x-4 text-white">
                            <img src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}"
                                alt="Logo Test" class="w-12 h-12 object-contain">
                            <div>
                                <h4 class="font-bold">DASHBOARD DATA SUBDOMAIN</h4>
                                <p class="text-sm opacity-90">Dinas Komunikasi dan Informatika</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-semibold text-blue-800 mb-2">📁 File Location:</h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• <code>public/images/logos/logo-diskominfo.svg</code> - Logo lengkap dengan teks</li>
                        <li>• <code>public/images/logos/logo-diskominfo-purwakarta.jpg</code> - Hanya icon untuk navbar</li>
                        <li>• <code>public/css/logo-transparent.css</code> - CSS untuk remove background PNG</li>
                    </ul>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-8">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium mr-4">
                    ← Kembali ke Dashboard
                </a>
                <a href="{{ route('logo.guide') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-lg font-medium">
                    Panduan Logo
                </a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('logoUpload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const originalLogo = document.getElementById('originalLogo');
                    const processedLogo = document.getElementById('processedLogo');
                    const placeholder = document.getElementById('placeholder');

                    originalLogo.src = e.target.result;
                    processedLogo.src = e.target.result;

                    originalLogo.classList.remove('hidden');
                    processedLogo.classList.remove('hidden');
                    placeholder.classList.add('hidden');

                    // Update test logos
                    for (let i = 1; i <= 4; i++) {
                        document.getElementById('testLogo' + i).src = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
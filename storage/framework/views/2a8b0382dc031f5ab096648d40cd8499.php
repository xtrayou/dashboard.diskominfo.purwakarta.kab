<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Link Spreadsheet - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen"
      style="background: radial-gradient(ellipse at top, #f0f9ff, #e0f2fe), linear-gradient(to bottom, #f8fafc, #f1f5f9);">
    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kelola Link Spreadsheet</h1>
                <p class="text-gray-600">Manajemen sumber data spreadsheet untuk dashboard monitoring</p>
            </div>
            <a href="<?php echo e(route('admin.spreadsheet-links.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                Tambah Link Baru
            </a>
        </div>

        <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Link Spreadsheet</h2>
            </div>

            <?php if($links->count() > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo e($link->name); ?></div>
                                <?php if($link->description): ?>
                                <div class="text-sm text-gray-500"><?php echo e(Str::limit($link->description, 50)); ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900"><?php echo e(Str::limit($link->url, 50)); ?></div>
                                <?php if($link->sheet_id): ?>
                                <div class="text-xs text-gray-500">ID: <?php echo e($link->sheet_id); ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($link->is_active): ?>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                                <?php else: ?>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Tidak Aktif
                                </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo e($link->created_at->format('d/m/Y H:i')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="testConnection(<?php echo e($link->id); ?>)" class="text-blue-600 hover:text-blue-900">
                                        Test
                                    </button>
                                    <a href="<?php echo e(route('admin.spreadsheet-links.show', $link)); ?>" class="text-green-600 hover:text-green-900">
                                        Lihat
                                    </a>
                                    <a href="<?php echo e(route('admin.spreadsheet-links.edit', $link)); ?>" class="text-yellow-600 hover:text-yellow-900">
                                        Edit
                                    </a>
                                    <form method="POST" action="<?php echo e(route('admin.spreadsheet-links.destroy', $link)); ?>" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="px-6 py-12 text-center">
                <div class="text-gray-400 mb-4">
                    <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada link spreadsheet</h3>
                <p class="text-gray-500 mb-4">Tambahkan link Google Sheets untuk mengimpor data ke dashboard</p>
                <a href="<?php echo e(route('admin.spreadsheet-links.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                    Tambah Link Pertama
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function testConnection(linkId) {
            fetch(`/admin/spreadsheet-links/${linkId}/test`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Koneksi berhasil! Ditemukan ${data.data_count} data.`);
                    } else {
                        alert(`Koneksi gagal: ${data.message}`);
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan saat testing koneksi');
                });
        }
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/admin/spreadsheet-links/index.blade.php ENDPATH**/ ?>
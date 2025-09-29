<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Link Spreadsheet - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen"
      style="background: radial-gradient(ellipse at top, #f0f9ff, #e0f2fe), linear-gradient(to bottom, #f8fafc, #f1f5f9);">
    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Edit Link Spreadsheet</h1>
            <p class="text-gray-600">Perbarui informasi link Google Sheets</p>
        </div>

        <div class="max-w-2xl bg-white rounded-lg shadow-lg p-8">
            <form method="POST" action="<?php echo e(route('admin.spreadsheet-links.update', $spreadsheetLink)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Deskripsi</label>
                    <input type="text" id="name" name="name" value="<?php echo e(old('name', $spreadsheetLink->name)); ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Data OPD Purwakarta 2025" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-6">
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-2">URL Google Sheets</label>
                    <input type="url" id="url" name="url" value="<?php echo e(old('url', $spreadsheetLink->url)); ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="https://docs.google.com/spreadsheets/d/..." required>
                    <?php if($spreadsheetLink->sheet_id): ?>
                    <p class="text-sm text-gray-500 mt-1">
                        Sheet ID Terdeteksi: <code class="bg-gray-100 px-1 rounded"><?php echo e($spreadsheetLink->sheet_id); ?></code>
                    </p>
                    <?php endif; ?>
                    <?php $__errorArgs = ['url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-6">
                    <label for="range" class="block text-sm font-medium text-gray-700 mb-2">Range Data</label>
                    <input type="text" id="range" name="range" value="<?php echo e(old('range', $spreadsheetLink->range)); ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="A:Z">
                    <p class="text-sm text-gray-500 mt-1">
                        Contoh: A:Z (semua kolom), A1:D100 (range spesifik)
                    </p>
                    <?php $__errorArgs = ['range'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Deskripsi singkat tentang data ini..."><?php echo e(old('description', $spreadsheetLink->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $spreadsheetLink->is_active) ? 'checked' : ''); ?>

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
                    <a href="<?php echo e(route('admin.spreadsheet-links.index')); ?>" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg font-medium">
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
                    <span class="font-medium"><?php echo e($spreadsheetLink->created_at->format('d/m/Y H:i')); ?></span>
                </div>
                <div>
                    <span class="text-gray-600">Terakhir Update:</span>
                    <span class="font-medium"><?php echo e($spreadsheetLink->updated_at->format('d/m/Y H:i')); ?></span>
                </div>
            </div>
        </div>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/admin/spreadsheet-links/edit.blade.php ENDPATH**/ ?>
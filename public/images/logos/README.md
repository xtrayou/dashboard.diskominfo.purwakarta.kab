# Cara Menambahkan Logo PNG ke Dashboard

## 📁 Lokasi File Logo

Simpan file logo PNG Anda di folder:

```
public/images/logos/
```

Contoh struktur folder:

```
public/
├── images/
│   ├── logos/
│   │   ├── logo-purwakarta.png
│   │   ├── logo-diskominfo.png
│   │   └── logo-pemkab.png
│   └── icons/
└── css/
```

## 🖼️ Cara Menggunakan Logo di View

### 1. Di Navbar (Header)

Ganti logo yang ada di `resources/views/layouts/navbar.blade.php`:

```php
<!-- Ganti dari URL external -->
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Lambang_Kabupaten_Purwakarta.svg/200px-Lambang_Kabupaten_Purwakarta.svg.png"
     alt="Logo Diskominfo" class="w-12 h-12">

<!-- Menjadi logo lokal -->
<img src="{{ asset('images/logos/logo-purwakarta.png') }}"
     alt="Logo Purwakarta" class="w-12 h-12 object-contain">
```

### 2. Di Dashboard Utama

```php
<div class="flex items-center space-x-4">
    <img src="{{ asset('images/logos/logo-diskominfo.png') }}"
         alt="Logo Diskominfo" class="w-16 h-16 object-contain">
    <div>
        <h1 class="text-2xl font-bold">Dashboard Title</h1>
    </div>
</div>
```

### 3. Di Login Page

```php
<div class="text-center mb-8">
    <img src="{{ asset('images/logos/logo-pemkab.png') }}"
         alt="Logo Pemkab Purwakarta" class="mx-auto w-20 h-20 mb-4">
    <h2 class="text-2xl font-bold">Login Dashboard</h2>
</div>
```

## 🎨 CSS Classes untuk Logo

### Ukuran Logo

```css
.logo-small {
    width: 32px;
    height: 32px;
} /* 8x8 in Tailwind: w-8 h-8 */
.logo-medium {
    width: 48px;
    height: 48px;
} /* 12x12 in Tailwind: w-12 h-12 */
.logo-large {
    width: 64px;
    height: 64px;
} /* 16x16 in Tailwind: w-16 h-16 */
.logo-xl {
    width: 80px;
    height: 80px;
} /* 20x20 in Tailwind: w-20 h-20 */
```

### Styling Logo

```css
/* Mempertahankan aspect ratio */
object-contain

/* Logo bulat */
rounded-full

/* Logo dengan shadow */
drop-shadow-lg

/* Logo dengan border */
border-2 border-white
```

## 📱 Logo Responsif

```php
<!-- Logo yang berubah ukuran berdasarkan screen size -->
<img src="{{ asset('images/logos/logo-purwakarta.png') }}"
     alt="Logo Purwakarta"
     class="w-8 h-8 md:w-12 md:h-12 lg:w-16 lg:h-16 object-contain">
```

## 🔄 Logo dengan Fallback

```php
<!-- Jika logo lokal gagal load, gunakan logo default -->
<img src="{{ asset('images/logos/logo-purwakarta.png') }}"
     alt="Logo Purwakarta"
     class="w-12 h-12 object-contain"
     onerror="this.src='{{ asset('images/logos/default-logo.png') }}';">
```

## 🎯 Contoh Implementasi Lengkap

### Navbar dengan Multiple Logo

```php
<div class="flex items-center space-x-4">
    <!-- Logo Utama -->
    <img src="{{ asset('images/logos/logo-purwakarta.png') }}"
         alt="Logo Purwakarta" class="w-12 h-12 object-contain">

    <!-- Logo Diskominfo -->
    <img src="{{ asset('images/logos/logo-diskominfo.png') }}"
         alt="Logo Diskominfo" class="w-10 h-10 object-contain">

    <div>
        <h1 class="text-2xl font-bold">DASHBOARD DATA SUBDOMAIN</h1>
        <p class="text-blue-100">Dinas Komunikasi dan Informatika</p>
    </div>
</div>
```

## 📋 Tips dan Best Practices

1. **Format File**: Gunakan PNG untuk transparansi, JPG untuk file size kecil
2. **Ukuran File**: Optimasi gambar agar loading cepat (max 200KB)
3. **Resolusi**: Siapkan logo dalam berbagai ukuran (32x32, 64x64, 128x128)
4. **Nama File**: Gunakan nama yang deskriptif (`logo-purwakarta.png`, bukan `logo1.png`)
5. **Alt Text**: Selalu berikan alt text yang bermakna untuk accessibility

## 🚀 Quick Setup

1. Copy file logo PNG ke `public/images/logos/`
2. Edit `resources/views/layouts/navbar.blade.php`
3. Ganti src dari URL external ke `{{ asset('images/logos/nama-file.png') }}`
4. Test di browser dengan refresh hard (Ctrl+F5)

## 🔍 Troubleshooting

-   **Logo tidak muncul**: Cek path file dan permission folder
-   **Logo pecah**: Gunakan `object-contain` atau `object-cover`
-   **Loading lambat**: Compress gambar atau gunakan WebP format
-   **Cache issue**: Clear browser cache atau run `php artisan config:clear`

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class RandomProjectSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Aplikasi Perpustakaan Digital',
            'Sistem Informasi Akademik',
            'Aplikasi Kasir UMKM',
            'Sistem Booking Wisata',
            'Aplikasi Catatan Harian',
            'Sistem Informasi Sekolah',
            'Aplikasi Manajemen Keuangan',
            'Website Toko Online',
            'Aplikasi Pengingat Tugas',
            'Sistem Reservasi Hotel',
            'Aplikasi Belajar Bahasa',
            'Sistem Informasi Desa',
            'Aplikasi Inventaris Barang',
            'Website Portofolio Kreatif',
            'Aplikasi Pengelolaan Event',
            'Sistem Manajemen Kursus',
            'Aplikasi Pemesanan Makanan',
            'Sistem Informasi Klinik',
            'Aplikasi Manajemen Gudang',
            'Website Company Profile',
            'Aplikasi Absensi Digital',
            'Sistem Pengelolaan Donasi',
            'Aplikasi Jadwal Kuliah',
            'Sistem Informasi Alumni',
            'Aplikasi Manajemen Proyek',
        ];

        foreach ($titles as $title) {
            Project::create([
                'title' => $title,
                'description' => 'Project contoh untuk latihan pagination, pencarian, dan pengelolaan data.',
                'status' => 'draft',
            ]);
        }
    }
}

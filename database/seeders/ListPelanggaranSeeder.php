<?php

namespace Database\Seeders;

use App\Models\ListPelanggaran;
use Illuminate\Database\Seeder;

class ListPelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // KELAKUAN
        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Melawan Guru/Karyawan secara langsung (fisik)',
            'point' => 300
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Mengedarkan, Menyimpan dan Memakai Narkoba/Miras',
            'point' => 300
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Menikah legal/illegal selama menjadi siswa',
            'point' => 300
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Tawuran di lingkungan maupun di luar sekolah',
            'point' => 300
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Menjadi anggota perkumpulan anak-anak nakal/organisasi terlarang',
            'point' => 300
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Peserta didik putri yang hamil dan peserta didik laki-laki yang menghamili',
            'point' => 300
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Menjadi terdakwa dalam perkara tindak pidana kriminal',
            'point' => 300
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Peserta didik laki-laki yang ditindik',
            'point' => 200
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Peserta didik perempuan yang ditindik tidak wajar',
            'point' => 200
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Bertato',
            'point' => 200
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Membawa senjata tajam/api',
            'point' => 150
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Melakukan tindakan/perbuatan asusila, berkelahi, berjudi, dan perbuatan tercela lainnya (terutama di sekolah)',
            'point' => 150
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Mengambil uang/barang orang lain atau barang sekolah (mencuri)',
            'point' => 150
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Membawa dan merokok di lingkungan sekolah',
            'point' => 100
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Membawa buku, majalah , kaset, gambar dan film porno dan sejenisnya (termasuk di laptop, memory/ponsel)',
            'point' => 100
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Meminta paksa barang orang lain (palak)',
            'point' => 75
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Memalsu Raport dan Dokumen negara lainnya',
            'point' => 75
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Melawan/mengancam/melecehkan Guru/Karyawan secara tidak langsung (termasuk melalui media)',
            'point' => 50
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Merusak nama baik sekolah di lingkungan masyarakat dan dunia usaha/industri',
            'point' => 50
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Memalsukan surat atau tandatangan Orangtua/wali',
            'point' => 40
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Tidak mengikuti sholat Jumat (bagi muslim)',
            'point' => 40
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Membohongi Guru',
            'point' => 30
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Menyontek Saat Ulangan',
            'point' => 25
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Menggunakan Hand Phone (HP) tanpa izin selama KBM',
            'point' => 20
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Melompat pagar',
            'point' => 20
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Mengganggu proses belajar',
            'point' => 15
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Mencoret-coret buku perpustakaan, meja, kursi dan tempat lainnya',
            'point' => 15
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Memakai perhiasan berlebihan, Kuku dicat/kuku panjang',
            'point' => 10
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Membuang sampah sembarangan, Tidak melaksanakan tugas piket',
            'point' => 10
        ]);

        ListPelanggaran::create([
            'kategori' => 'kelakuan',
            'pelanggaran' => 'Tidak menyampaikan surat dari sekolah kepada orangtua',
            'point' => 10
        ]);

        // KERAJINAN
        ListPelanggaran::create([
            'kategori' => 'kerajinan',
            'pelanggaran' => 'Tidak hadir tanpa keterangan/alpha, membolos',
            'point' => 10
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerajinan',
            'pelanggaran' => 'Berada di luar kelas saat jam belajar tanpa se izin guru piket/guru yang bersangkutan',
            'point' => 10
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerajinan',
            'pelanggaran' => 'Tidak ikut upacara tanpa alasan',
            'point' => 10
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerajinan',
            'pelanggaran' => 'Tidak membawa buku, alat tulis, perlengkapan belajar, tidak mengerjakan tugas',
            'point' => 10
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerajinan',
            'pelanggaran' => 'Terlambat ke sekolah, terlambat masuk kelas pada pergantian jam pelajaran tanpa se izin guru ',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerajinan',
            'pelanggaran' => 'Meninggalkan buku pelajaran di kelas',
            'point' => 5
        ]);


        // KERAPIHAN
        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Baju dikeluarkan',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Tidak menggunakan ikat pinggang warna hitam atau sepatu warna hitam jenis Kets',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Rambut panjang/gondrong bagi siswa laki-laki',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Pakaian ketat, celana pensil, rok/celana di atas mata kaki',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Baju, celana, topi dicoret-coret, memakai topi bebas di lingkungan sekolah ',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Memakai sepatu diinjak/dilipat bagian belakang, sepatu sandal, memakai jaket',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Berpakaian dengan atribut tidak lengkap (tidak memakai badge OSIS, singlet, baju olahraga, dasi, name page)',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Memakai gelang, kalung, anting bagi laki-laki',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Tidak memakai kaos kaki warna putih sampai betis (kaos kaki pendek khusus Siswi)',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Mewarnai rambut atau bibir',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Tidak memakai sepatu warna hitam jenis kets',
            'point' => 5
        ]);

        ListPelanggaran::create([
            'kategori' => 'kerapihan',
            'pelanggaran' => 'Pakaian jilbab tidak sesuai peraturan Agama Islam',
            'point' => 5
        ]);
    }
}

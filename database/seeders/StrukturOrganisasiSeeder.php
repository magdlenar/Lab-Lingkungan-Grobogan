<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StrukturOrganisasi;

class StrukturOrganisasiSeeder extends Seeder
{
    public function run(): void
    {
        StrukturOrganisasi::query()->delete();

        // TOP
        $top = StrukturOrganisasi::create([
            'jabatan' => 'Manajer Puncak',
            'nama'    => 'Drs. Mokamat, M.Si.',
            'urutan'  => 1,
            'parent_id' => null,
        ]);

        // LEVEL 2 (di bawah TOP) -> urutan kiri ke kanan
        $mutu = StrukturOrganisasi::create([
            'jabatan' => 'Manajer Mutu',
            'nama'    => 'Riwan Triono, S.Hut., M.Si.',
            'urutan'  => 1,
            'parent_id' => $top->id,
        ]);

        $teknis = StrukturOrganisasi::create([
            'jabatan' => 'Manajer Teknis',
            'nama'    => 'Ita Puspitasari, S.T., M.M.',
            'urutan'  => 2,
            'parent_id' => $top->id,
        ]);

        $admin = StrukturOrganisasi::create([
            'jabatan' => 'Manajer Administrasi',
            'nama'    => 'Suprihno, S.Sos.',
            'urutan'  => 3,
            'parent_id' => $top->id,
        ]);

        // LEVEL 3
        StrukturOrganisasi::create([
            'jabatan' => 'Staf Mutu',
            'nama'    => 'Syahidun Najih Me, S.T.',
            'urutan'  => 1,
            'parent_id' => $mutu->id,
        ]);

        $penyelia = StrukturOrganisasi::create([
            'jabatan' => 'Penyelia',
            'nama'    => 'M. Ajib Ubaidillah, S.Si.',
            'urutan'  => 1,
            'parent_id' => $teknis->id,
        ]);

        StrukturOrganisasi::create([
            'jabatan' => 'Petugas K3L',
            'nama'    => 'Eko Triyono.',
            'urutan'  => 2,
            'parent_id' => $teknis->id,
        ]);

        // Admin bawah Manajer Administrasi
        StrukturOrganisasi::create([
            'jabatan' => 'Penerima Contoh Uji',
            'nama'    => 'Dara Ayu K.',
            'urutan'  => 1,
            'parent_id' => $admin->id,
        ]);

        StrukturOrganisasi::create([
            'jabatan' => 'Penerima Contoh Uji',
            'nama'    => 'Dian Ernawati.',
            'urutan'  => 2,
            'parent_id' => $admin->id,
        ]);

        StrukturOrganisasi::create([
            'jabatan' => 'Staf Administrasi',
            'nama'    => 'Eka Ismiatul A, S.T.',
            'urutan'  => 3,
            'parent_id' => $admin->id,
        ]);

        // LEVEL 4 (bawahan Penyelia)
        StrukturOrganisasi::create([
            'jabatan' => 'Analis',
            'nama'    => 'Nurul Izzaty, S.T.',
            'urutan'  => 1,
            'parent_id' => $penyelia->id,
        ]);

        StrukturOrganisasi::create([
            'jabatan' => 'Petugas Sampling',
            'nama'    => 'Eko Triyono.',
            'urutan'  => 2,
            'parent_id' => $penyelia->id,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScpkSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate tables to prevent duplicates when running multiple times
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("skor_alternatif")->truncate();
        DB::table("alternatif")->truncate();
        DB::table("sub_kriteria")->truncate();
        DB::table("kriteria_bobot")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        // 1. Kriteria
        $kriteria = [
            ["id" => 1, "kriteria" => "Nilai Tes Tulis", "bobot" => 40, "tipe" => "benefit"],
            ["id" => 2, "kriteria" => "Nilai Wawancara", "bobot" => 30, "tipe" => "benefit"],
            ["id" => 3, "kriteria" => "Pengalaman Kerja", "bobot" => 20, "tipe" => "benefit"],
            ["id" => 4, "kriteria" => "Jarak Domisili", "bobot" => 10, "tipe" => "cost"],
        ];
        DB::table("kriteria_bobot")->insert($kriteria);

        // 2. Sub Kriteria
        $subKriteria = [
            // Sub Tes Tulis
            ["id" => 1, "id_kriteria" => 1, "rate" => 5, "desc" => "> 90"],
            ["id" => 2, "id_kriteria" => 1, "rate" => 4, "desc" => "80 - 90"],
            ["id" => 3, "id_kriteria" => 1, "rate" => 3, "desc" => "70 - 79"],
            ["id" => 4, "id_kriteria" => 1, "rate" => 2, "desc" => "60 - 69"],
            ["id" => 5, "id_kriteria" => 1, "rate" => 1, "desc" => "< 60"],
            
            // Sub Wawancara
            ["id" => 6, "id_kriteria" => 2, "rate" => 5, "desc" => "Sangat Baik"],
            ["id" => 7, "id_kriteria" => 2, "rate" => 4, "desc" => "Baik"],
            ["id" => 8, "id_kriteria" => 2, "rate" => 3, "desc" => "Cukup"],
            ["id" => 9, "id_kriteria" => 2, "rate" => 2, "desc" => "Kurang"],
            ["id" => 10, "id_kriteria" => 2, "rate" => 1, "desc" => "Sangat Kurang"],

            // Sub Pengalaman
            ["id" => 11, "id_kriteria" => 3, "rate" => 5, "desc" => "> 5 Tahun"],
            ["id" => 12, "id_kriteria" => 3, "rate" => 4, "desc" => "3 - 5 Tahun"],
            ["id" => 13, "id_kriteria" => 3, "rate" => 3, "desc" => "1 - 2 Tahun"],
            ["id" => 14, "id_kriteria" => 3, "rate" => 2, "desc" => "< 1 Tahun"],
            ["id" => 15, "id_kriteria" => 3, "rate" => 1, "desc" => "Fresh Graduate"],

            // Sub Jarak
            ["id" => 16, "id_kriteria" => 4, "rate" => 5, "desc" => "< 5 Km"],
            ["id" => 17, "id_kriteria" => 4, "rate" => 4, "desc" => "5 - 10 Km"],
            ["id" => 18, "id_kriteria" => 4, "rate" => 3, "desc" => "11 - 20 Km"],
            ["id" => 19, "id_kriteria" => 4, "rate" => 2, "desc" => "21 - 50 Km"],
            ["id" => 20, "id_kriteria" => 4, "rate" => 1, "desc" => "> 50 Km"],
        ];
        DB::table("sub_kriteria")->insert($subKriteria);

        // 3. Alternatif (25 Data)
        $alternatifNames = [
            "Andi Wijaya", "Budi Santoso", "Citra Lestari", "Dewi Sartika", "Eko Prasetyo",
            "Fajar Nugroho", "Gita Gutawa", "Hadi Kusuma", "Indah Permatasari", "Joko Susanto",
            "Kiki Amalia", "Lukman Hakim", "Maya Wulan", "Nina Marlina", "Okan Kornelius",
            "Putri Ayu", "Qori Akbar", "Rina Nose", "Siti Aminah", "Tono Sudarso",
            "Umar Wirahadi", "Vina Panduwinata", "Wawan Hendrawan", "Xena Aprilia", "Yudi Pratama"
        ];

        $alternatif = [];
        $skor = [];

        foreach ($alternatifNames as $index => $name) {
            $id_alternatif = $index + 1;
            $alternatif[] = ["id" => $id_alternatif, "name" => $name];

            // Skor Acak untuk masing-masing kriteria
            $skor[] = ["id_alternatif" => $id_alternatif, "id_kriteria" => 1, "id_sub_kriteria" => rand(1, 5)];
            $skor[] = ["id_alternatif" => $id_alternatif, "id_kriteria" => 2, "id_sub_kriteria" => rand(6, 10)];
            $skor[] = ["id_alternatif" => $id_alternatif, "id_kriteria" => 3, "id_sub_kriteria" => rand(11, 15)];
            $skor[] = ["id_alternatif" => $id_alternatif, "id_kriteria" => 4, "id_sub_kriteria" => rand(16, 20)];
        }

        DB::table("alternatif")->insert($alternatif);
        DB::table("skor_alternatif")->insert($skor);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\KriteriaBobot;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $kriteria_bobot = KriteriaBobot::all();
        $jumlah_kriteria = $kriteria_bobot->count();
        $jumlah_sub_kriteria = SubKriteria::count();
        $jumlah_alternatif = Alternatif::count();

        $alternatif = Alternatif::with(['skor_alternatif.kriteria', 'skor_alternatif.sub_kriteria'])->get();
        $kriteria = KriteriaBobot::all();

        $vektor_s = [];
        foreach ($alternatif as $a) {
            $nilai_s = 1;

            foreach ($kriteria as $k) {
                $skor = $a->skor_alternatif->firstWhere('id_kriteria', $k->id);
                $rate = $skor->sub_kriteria->rate;

                $bobot_relatif = $k->bobot / $kriteria->sum('bobot');
                
                if (strtolower($k->tipe) === 'cost') {
                    // Invers nilai rate untuk cost (karena di seeder rate 5 = terdekat/terbaik)
                    $nilai_hitungan = 6 - $rate; 
                    $nilai_s *= pow($nilai_hitungan, -$bobot_relatif);
                } else {
                    $nilai_s *= pow($rate, $bobot_relatif);
                }
            }

            $vektor_s[$a->id] = $nilai_s;
        }

        $total_s = array_sum($vektor_s);

        $vektor_v = [];
        foreach ($vektor_s as $id => $s) {
            $vektor_v[$id] = $s / $total_s;
        }

        foreach ($alternatif as $a) {
            $status = 'Lulus';

            foreach ($kriteria as $k) {
                $skor = $a->skor_alternatif->firstWhere('id_kriteria', $k->id);
                $rate = $skor->sub_kriteria->rate ?? 0;

                if (strtolower($k->kriteria) === 'kehadiran') {
                    if ($rate < 3) {
                        $status = 'Tidak Lulus';
                        break;
                    }
                } else {
                    if ($rate < 2) {
                        $status = 'Tidak Lulus';
                        break;
                    }
                }
            }

            $a->status = $status;
            $a->nilai_v = $vektor_v[$a->id];
        }

        // Urutkan berdasarkan Status (Lulus di atas) lalu nilai V (descending)
        $sorted_alternatif = $alternatif->sort(function ($a, $b) {
            if ($a->status === $b->status) {
                return $b->nilai_v <=> $a->nilai_v;
            }
            return $a->status === 'Lulus' ? -1 : 1;
        })->values()->take(5);

        return view('dashboard', compact('kriteria_bobot', 'jumlah_kriteria', 'jumlah_sub_kriteria', 'jumlah_alternatif', 'sorted_alternatif', 'vektor_v'));
    }
}

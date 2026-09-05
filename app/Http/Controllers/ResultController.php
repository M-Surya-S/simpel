<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\KriteriaBobot;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function matrix()
    {
        $alternatif = Alternatif::with(['skor_alternatif.kriteria', 'skor_alternatif.sub_kriteria'])->get();
        $kriteria = KriteriaBobot::all();
        $jumlah_kriteria = $kriteria->count();

        // Hitung S_i untuk setiap alternatif
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

        // Hitung total semua S_i
        $total_s = array_sum($vektor_s);

        // Hitung V_i = S_i / total S
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
        }

        return view('result.matrix', compact('alternatif', 'kriteria', 'jumlah_kriteria', 'vektor_v', 'vektor_s'));
    }

    public function ranking()
    {
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

        $sorted_alternatif = $alternatif->sort(function ($a, $b) {
            // Jika statusnya sama, urutkan berdasarkan nilai V (descending)
            if ($a->status === $b->status) {
                return $b->nilai_v <=> $a->nilai_v;
            }
            // Jika beda, Lulus di atas Tidak Lulus
            return $a->status === 'Lulus' ? -1 : 1;
        })->values();

        $alternatif_lulus = $sorted_alternatif->where('status', 'Lulus')->values();
        $alternatif_tidak_lulus = $sorted_alternatif->where('status', 'Tidak Lulus')->values();

        return view('result.ranking', [
            'alternatif_lulus' => $alternatif_lulus,
            'alternatif_tidak_lulus' => $alternatif_tidak_lulus,
            'vektor_v' => $vektor_v,
        ]);
    }
}

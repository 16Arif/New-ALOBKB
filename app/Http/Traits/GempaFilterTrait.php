<?php

namespace App\Http\Traits;

use App\Models\GempaBumi;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait GempaFilterTrait
{
    /**
     * Menerapkan filter gempa bumi berdasarkan parameter request.
     * Mendukung filter: tanggal, provinsi (spatial), kab/kota (spatial), dan pencarian teks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyGempaFilters(Request $request): Builder
    {
        return GempaBumi::query()
            ->when($request->filled('filter_start') && $request->filled('filter_end'), function ($q) use ($request) {
                return $q->whereBetween('tanggal', [$request->filter_start, $request->filter_end]);
            })
            ->when($request->filled('filter_provinsi'), function ($q) use ($request) {
                $prov = $request->filter_provinsi;

                $provMap = [
                    'KALBAR' => '61',
                    'KALTENG' => '62',
                    'KALSEL' => '63',
                    'KALTIM' => '64',
                    'KALTARA' => '65',
                ];

                if (isset($provMap[$prov])) {
                    $kodeProv = $provMap[$prov];
                    return $q->whereRaw("ST_Contains(
                        (SELECT geom FROM provinsi_borders WHERE kode_prov = ? LIMIT 1),
                        ST_GeomFromText(CONCAT('POINT(', CAST(bujur AS DOUBLE), ' ', CAST(lintang AS DOUBLE), ')'))
                    )", [$kodeProv]);
                } elseif ($prov === 'LAINNYA') {
                    return $q->whereRaw("NOT EXISTS (
                        SELECT 1 FROM provinsi_borders 
                        WHERE ST_Contains(
                            provinsi_borders.geom,
                            ST_GeomFromText(CONCAT('POINT(', CAST(gempa_bumis.bujur AS DOUBLE), ' ', CAST(gempa_bumis.lintang AS DOUBLE), ')'))
                        )
                    )");
                }
            })
            ->when($request->filled('filter_kab_kota'), function ($q) use ($request) {
                $kodeKk = $request->filter_kab_kota;
                return $q->whereRaw("ST_Contains(
                    (SELECT geom FROM kab_kota_borders WHERE kode_kk = ? LIMIT 1),
                    ST_GeomFromText(CONCAT('POINT(', CAST(bujur AS DOUBLE), ' ', CAST(lintang AS DOUBLE), ')'))
                )", [$kodeKk]);
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                return $q->where('jarak', 'like', '%' . $request->search . '%');
            });
    }

    /**
     * Menerapkan sorting pada query builder gempa bumi.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyGempaSorting(Builder $query, Request $request): Builder
    {
        switch ($request->get('sort')) {
            case 'tanggal_asc':
                $query->orderBy('tanggal', 'asc')->orderBy('waktu', 'asc');
                break;
            case 'tanggal_desc':
                $query->orderBy('tanggal', 'desc')->orderBy('waktu', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
        }

        return $query;
    }
}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Data Logbook Peralatan</title>
    <style>
        /* Reset dan Font Global */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            color: #333;
            background-color: #f9f9f9;
        }

        h4,
        h5 {
            text-align: center;
            margin: 0;
            color: #222;
        }

        h4 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        h5 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #555;
        }

        h6 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 10px;
            font-size: 14px;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
            text-align: center;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #note td {
            background-color: #fff5e6;
            font-style: italic;
        }

        /* Bagian tanda tangan */
        .signature {
            text-align: right;
            margin-top: 20px;
        }

        .signature p {
            margin: 0;
        }

        .signature .nama {
            margin-top: 50px;
            font-weight: bold;
            text-decoration: underline;
        }

        /* Footer */
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    {{-- <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset('img/lbperalatan-kop.png') }}" alt="Kop Logbook Peralatan"
            style="width: 100%; max-width: 800px;">
    </div> --}}

    <!-- Header -->
    <img src="img\kop-peralatan.png" alt="Logo" style="height: 100px; width: 100%">

    <table>
        <tr>
            <td>Tanggal Dinas</td>
            <td>{{ $logbookperalatan->tanggal }}</td>
        </tr>
        <tr>
            <td>Jam Dinas</td>
            <td>{{ $logbookperalatan->jam }} WITA</td>
        </tr>
        <tr>
            <td>Pegawai Dinas</td>
            <td>
                <ol>
                    <li>{{ $logbookperalatan->onduty1 }}</li>
                    <li>{{ $logbookperalatan->onduty2 }}</li>
                    <li>{{ $logbookperalatan->onduty3 }}</li>
                </ol>
            </td>
        </tr>
    </table>

    <h6>Informasi Peralatan</h6>
    <table>
        <tr>
            <td>Fingerprint</td>
            <td>{{ $logbookperalatan->fingerprint }}</td>
            <td>TDS</td>
            <td>{{ $logbookperalatan->tds }}</td>
        </tr>
        <tr>
            <td>NexStorm</td>
            <td>{{ $logbookperalatan->nexstorm }}</td>
            <td>Obs NexStorm</td>
            <td>{{ $logbookperalatan->obs_nexstorm }}</td>
        </tr>
        <tr>
            <td>CMSS</td>
            <td>{{ $logbookperalatan->cmss }}</td>
            <td>Monitoring Sensor</td>
            <td>{{ $logbookperalatan->monitoring }}</td>
        </tr>
        <tr>
            <td>Accelerograph</td>
            <td>{{ $logbookperalatan->acc }}</td>
            <td>WRS NG</td>
            <td>{{ $logbookperalatan->wrsng }}</td>
        </tr>
        <tr>
            <td>Intergrasi Data</td>
            <td>{{ $logbookperalatan->integrasi_data }}</td>
            <td>Seiscomp4</td>
            <td>{{ $logbookperalatan->seiscomp4 }}</td>
        </tr>
        <tr>
            <td>PC Magnet</td>
            <td>{{ $logbookperalatan->pc_magnet }}</td>
            <td>Monitor Zoom</td>
            <td>{{ $logbookperalatan->monitor_zoom }}</td>
        </tr>
        <tr>
            <td>Internet Operasional Lintasarta</td>
            <td>{{ $logbookperalatan->internet_ops }}</td>
            <td>Internet Lokal SG4-Balikpapan</td>
            <td>{{ $logbookperalatan->internet_lokal }}</td>
        </tr>
        <tr>
            <td>Shakemap</td>
            <td>{{ $logbookperalatan->shakemap }}</td>
            <td>Seiscomp Regional</td>
            <td>{{ $logbookperalatan->seiscomp_reg }}</td>
        </tr>
        <tr>
            <td>PC QC Seiscomp</td>
            <td>{{ $logbookperalatan->qc_seiscomp }}</td>
            <td>Monitor SIMAP</td>
            <td>{{ $logbookperalatan->monitor_simap }}</td>
        </tr>
        <tr>
            <td>PC WorkStation SIMAP</td>
            <td>{{ $logbookperalatan->ws_simap }}</td>
            <td>BKB Server</td>
            <td>{{ $logbookperalatan->bkb_server }}</td>
        </tr>
        <tr>
            <td>Penakar Hujan</td>
            <td>{{ $logbookperalatan->penakar_hujan }}</td>
            <td>Radio SSB</td>
            <td>{{ $logbookperalatan->radio_ssb }}</td>
        </tr>

        <!-- Tambahkan data lainnya -->
    </table>

    <h6>Catatan </h6>
    <p>{!! $logbookperalatan->note !!}</p>

    {{-- <!-- Tanda Tangan -->
    <div class="signature">
        <p>Mengetahui,</p>
        <p>Kepala Stasiun Geofisika Balikpapan</p>
        <p class="nama">Rasmid, M.Si</p>
    </div> --}}
    <table>
        <tr>
            <th></th>
            <th>Kepala UPT</th>
            <th style="width: 30%">Koordinator OPS</th>
        </tr>
        <tr>
            <td>Paraf</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td></td>
            <td></td>
        </tr>
    </table>


</body>

</html>

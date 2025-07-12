<!DOCTYPE html>
<html>

<head>
    <title>Preview Data Logbook Petir</title>
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
    <img src="img\kop-petir.png" alt="Logo" style="height: 120px; width: 100%">
    <table>
        <tr>
            <td>1. Tanggal Dinas</td>
            <td>{{ $logbookpetir->tanggal }}</td>
        </tr>
        <tr>
            <td>2. Jam Dinas</td>
            <td>{{ $logbookpetir->jam }} WITA</td>
        </tr>
        <tr>
            <td>3. On Duty</td>
            <td>
                <ol>
                    <li>{{ $logbookpetir->onduty1 }}</li>
                    <li>{{ $logbookpetir->onduty2 }}</li>
                    <li>{{ $logbookpetir->onduty3 }}</li>
                </ol>
            </td>
        </tr>

        <tr>
            <td>5. Pengamatan</td>
            <td>
                <ul>
                    <li>{{ $logbookpetir->pengamatan1 }}</li>
                    <li>{{ $logbookpetir->pengamatan2 }}</li>
                    <li>{{ $logbookpetir->pengamatan3 }}</li>
                    <li>{{ $logbookpetir->pengamatan4 }}</li>
                    <li>{{ $logbookpetir->pengamatan5 }}</li>
                    <li>{{ $logbookpetir->pengamatan6 }}</li>
                    <li>{{ $logbookpetir->pengamatan7 }}</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>6. Catatan</td>
            <td>
                <article>
                    {!! $logbookpetir->note !!}
            </td>
            </article>
        </tr>
    </table>
    {{-- <p id="mengetahui">Mengetahui,</p>
    <p id="kpg">Kepala Stasiun Geofisika Balikpapan</p>
    <p id="nama-kpg">Rasmid, M.Si</p> --}}

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

<!DOCTYPE html>
<html>

<head>
    <title>Preview Data Logbook Gempabumi</title>
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
    <img src="img\kop-gempa.png" alt="Logo" style="height: 120px; width: 100%">
    <table>
        <tr>
            <td>Hari, Tanggal Dinas</td>
            <td>{{ \Carbon\Carbon::parse($logbookgempa->tanggal)->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
            <td>Jam Dinas</td>
            @php
                use Carbon\Carbon;

                $start = Carbon::createFromFormat('H.i', $logbookgempa->jam);
                $end = $start->copy()->addHours(7)->addMinutes(30);
            @endphp
            <td>{{ $start->format('H.i') }} - {{ $end->format('H.i') }} WITA</td>
        </tr>
        <tr>
            <td>On Duty</td>
            <td>
                <ol>
                    <li>{{ $logbookgempa->onduty1 }}</li>
                    <li>{{ $logbookgempa->onduty2 }}</li>
                    <li>{{ $logbookgempa->onduty3 }}</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td>Aktifitas</td>
            <td>
                <ul>
                    <li>{{ $logbookgempa->kegiatan1 }}</li>
                    <li>{{ $logbookgempa->kegiatan2 }}</li>
                    <li>{{ $logbookgempa->monitoring1 }}</li>
                    <li>{{ $logbookgempa->berita1 }}</li>
                    <li>{{ $logbookgempa->monitoring2 }}</li>
                    <li>{{ $logbookgempa->berita2 }}</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>Tugas Tambahan</td>
            <td>
                <article>
                    {!! $logbookgempa->note !!}
            </td>
            </article>
        </tr>
    </table>


</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <title>Preview Data Logbook Petir</title>
    <style>
        h4 {
            font-family: verdana;
            text-align: center;
        }

        h5 {
            font-size: 100%;
            font-family: verdana;
            text-align: center;
        }

        p {
            font-family: courier;
        }

        table {
            font-family: arial, sans-serif;
            width: 40%;
        }

        td {
            /* border: 1px solid #dddddd; */
            text-align: left;
            width: 120%;
            padding: 8px;
        }

        #mengetahui {
            font-family: arial, sans-serif;
            text-align: right;
            margin-top: 100px;
            margin-right: 90px;
        }

        #kpg {
            font-family: arial, sans-serif;
            text-align: right;
            margin-right: 10px;
        }

        #nama-kpg {
            font-family: arial, sans-serif;
            text-align: right;
            margin-top: 100px;
            margin-right: 90px;
        }
    </style>
</head>

<body>

    <h4>Data Logbook Petir</h4>
    <h5>Operasional Stasiun Geofisika Balikpapan</h5>
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
            <td>4. Kehadiran</td>
            <td>{{ $logbookpetir->kehadiran }}</td>
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
                </ul>
            </td>
        </tr>
        <tr>
            <td>6. Kondisi</td>
            <td>{{ $logbookpetir->kondisi }}</td>
        </tr>
        <tr>
            <td>7. Catatan</td>
            <td>
                <article>
                    {!! $logbookpetir->note !!}
            </td>
            </article>
        </tr>
    </table>
    <p id="mengetahui">Mengetahui,</p>
    <p id="kpg">Kepala Stasiun Geofisika Balikpapan</p>
    <p id="nama-kpg">Rasmid, M.Si</p>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <title>Preview Data Logbook Petir</title>
    <style>
        h4 {
            margin-top: 100px;
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
            margin-top: 50px;
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
            margin-bottom: 100px;
        }
    </style>
</head>

<body>

    @foreach ($logbookpetirs as $lbp)
        <h4>Data Logbook Petir</h4>
        <h5>Operasional Stasiun Geofisika Balikpapan</h5>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente dolorem fuga, vitae ad error recusandae
            excepturi quas odio tempora esse iure ullam numquam deleniti voluptatum!
        </p>
        <div class="table">
            <table class="table-striped table">
                <thead>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1. Tanggal</td>
                        <td>{{ $lbp->tanggal }}</td>
                    </tr>
                    <tr>
                        <td>2. Jam Dinas</td>
                        <td>{{ $lbp->jam }} WITA</td>
                    </tr>
                    <tr>
                        <td>3. On Duty</td>
                        <td>{{ $lbp->onduty1 }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $lbp->onduty2 ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $lbp->onduty3 ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>5. Pengamatan</td>
                        <td>{{ $lbp->pengamatan1 }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $lbp->pengamatan2 }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $lbp->pengamatan3 }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $lbp->pengamatan4 }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $lbp->pengamatan5 }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $lbp->pengamatan6 }}</td>
                    </tr>
                    <tr>
                        <td>6. Kondisi</td>
                        <td>{{ $lbp->kondisi }}</td>
                    </tr>
                    <tr>
                        <td>7. Catatan</td>
                        <td>{!! $lbp->note !!}</td>
                    </tr>
                    </tr>
                    <hr>
                </tbody>
            </table>
        </div>
        <p id="mengetahui">Mengetahui,</p>
        <p id="kpg">Kepala Stasiun Geofisika Balikpapan</p>
        <p id="nama-kpg">Rasmid, M.Si</p>
    @endforeach
</body>

</html>

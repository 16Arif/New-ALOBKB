<!DOCTYPE html>
<html lang="DOCTYPE">

<head>
    <title>Preview Data Logbook peralatan</title>
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

        table {
            margin-top: 100px;
        }

        #id {
            margin-top: 100px;
        }
    </style>
</head>

<body>

    <h4>Data Logbook Peralatan</h4>
    <h5>Operasional Stasiun Geofisika Balikpapan</h5>
    <table>
        <th></th>
        <tr>
            <td>1. Tanggal Dinas</td>
            <td>{{ $logbookperalatan->tanggal }}</td>
        </tr>
        <tr>
            <td>2. Jam Dinas</td>
            <td>{{ $logbookperalatan->jam }} WITA</td>
        </tr>
        <tr>
            <td>3. On Duty</td>
            <td>
                <ol>
                    <li>{{ $logbookperalatan->onduty1 }}</li>
                    <li>{{ $logbookperalatan->onduty2 }}</li>
                    <li>{{ $logbookperalatan->onduty3 }}</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td>4. Kehadiran</td>
            <td>{{ $logbookperalatan->kehadiran }}</td>
        </tr>
        <tr>
            <td>5. Fingerprint</td>
            <td>
                {{ $logbookperalatan->fingerprint }}
            </td>
        </tr>
        <tr>
            <td>6. TDS</td>
            <td>
                {{ $logbookperalatan->tds }}
            </td>
        </tr>
        <tr>
            <td>7. TDS</td>
            <td>
                {{ $logbookperalatan->nexstorm }}
            </td>
        </tr>
        <tr>
            <td>8. TDS</td>
            <td>
                {{ $logbookperalatan->obs_nexstorm }}
            </td>
        </tr>
        <tr>
            <td>9. TDS</td>
            <td>
                {{ $logbookperalatan->cmss }}
            </td>
        </tr>
        <tr>
            <td>10. TDS</td>
            <td>
                {{ $logbookperalatan->monitoring }}
            </td>
        </tr>
        <tr>
            <td>11. Accelerograph</td>
            <td>
                {{ $logbookperalatan->acc }}
            </td>
        </tr>
        <tr>
            <td>12. WRS NG</td>
            <td>
                {{ $logbookperalatan->wrsng }}
            </td>
        </tr>
        <tr>
            <td>13. Integrsi Data</td>
            <td>
                {{ $logbookperalatan->integrasi_data }}
            </td>
        </tr>
        <tr>
            <td>14. Seiscomp4</td>
            <td>
                {{ $logbookperalatan->seiscomp4 }}
            </td>
        </tr>
        <tr>
            <td>15. PC Magnet</td>
            <td>
                {{ $logbookperalatan->pc_magnet }}
            </td>
        </tr>
        <tr>
            <td>16. Monitor ZOOM</td>
            <td>
                {{ $logbookperalatan->monitor_zoom }}
            </td>
        </tr>
        <tr>
            <td>17. Internet Operasional Lintasarta</td>
            <td>
                {{ $logbookperalatan->internet_ops }}
            </td>
        </tr>
        <tr>
            <td>18. Internet Lokal SG4-Balikpapan</td>
            <td>
                {{ $logbookperalatan->internet_lokal }}
            </td>
        </tr>
        <tr>
            <td>19. BKB Server</td>
            <td>
                {{ $logbookperalatan->bkb_server }}
            </td>
        </tr>
        <tr>
            <td>20. Penakar Hujan</td>
            <td>
                {{ $logbookperalatan->penakar_hujan }}
            </td>
        </tr>
        <tr>
            <td>21. Radio SSB</td>
            <td>
                {{ $logbookperalatan->radio_ssb }}
            </td>
        </tr>
        <tr id="note">
            <td> Catatan</td>
            <td>
                <article>
                    {!! $logbookperalatan->note !!}
            </td>
            </article>
        </tr>
    </table>
    <p id="mengetahui">Mengetahui,</p>
    <p id="kpg">Kepala Stasiun Geofisika Balikpapan</p>
    <p id="nama-kpg">Rasmid, M.Si</p>
</body>

</html>

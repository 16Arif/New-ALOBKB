@php
    // Mendapatkan waktu saat ini
    $currentTime = now()->timezone('Asia/Makassar');
    // Menentukan batas waktu hingga jam 14:00 WITA
    $cutoffTime1 = now()->timezone('Asia/Makassar')->setHour(14)->setMinute(0)->setSecond(0);
    $cutoffTime2 = now()->timezone('Asia/Makassar')->setHour(20)->setMinute(0)->setSecond(0);
@endphp

@if ($currentTime->lessThan($cutoffTime1))
    @php
        $timeRangeStart = \Carbon\Carbon::createFromTime(8, 0, 0, 'Asia/Makassar');
        $timeRangeEnd = \Carbon\Carbon::createFromTime(14, 0, 0, 'Asia/Makassar');
        $dataInRange = false;

        // Periksa apakah ada data antara pukul 22.38 dan 22.45 WITA
        foreach ($logbookpetirs as $logbookpetir) {
            if ($logbookpetir->created_at->between($timeRangeStart, $timeRangeEnd)) {
                $dataInRange = true;
                break;
            }
        }
    @endphp

    @if ($dataInRange)
        {{-- Tampilkan data yang ada dalam rentang waktu --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tipe Logbook</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">On Duty</th>
                    <th scope="col">Kehadiran</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Logbook Petir</th>
                    <td>{{ $logbookpetirs[0]->tanggal }}</td>
                    <td>
                        <ul>
                            <li>{{ $logbookpetirs[0]->onduty1 }}</li>
                            <li>{{ $logbookpetirs[0]->onduty2 }}</li>
                            <li>{{ $logbookpetirs[0]->onduty3 }}</li>
                        </ul>
                    </td>
                    <td>{{ $logbookpetirs[0]->kehadiran }}</td>
                    <td>{{ $logbookpetirs[0]->created_at->diffForHumans() }}</td>
                </tr>
            </tbody>
        </table>
    @else
        {{-- Tampilkan pesan bahwa belum ada data --}}
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status"></div>
        </div>
        <p class="text-center">Data Logbook Petir Belum Diisi Shift Pagi</p>
    @endif
@elseif ($currentTime->lessThan($cutoffTime2))
    {{-- Tampilkan data sebelum pukul 20.00 WITA --}}
    @php
        $timeRangeStart = \Carbon\Carbon::createFromTime(14, 0, 0, 'Asia/Makassar');
        $timeRangeEnd = \Carbon\Carbon::createFromTime(20, 0, 0, 'Asia/Makassar');
        $dataInRange = false;

        // Periksa apakah ada data antara pukul 22.38 dan 22.45 WITA
        foreach ($logbookpetirs as $logbookpetir) {
            if ($logbookpetir->created_at->between($timeRangeStart, $timeRangeEnd)) {
                $dataInRange = true;
                break;
            }
        }
    @endphp

    @if ($dataInRange)
        {{-- Tampilkan data yang ada dalam rentang waktu --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tipe Logbook</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">On Duty</th>
                    <th scope="col">Kehadiran</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Logbook Petir</th>
                    <td>{{ $logbookpetirs[0]->tanggal }}</td>
                    <td>
                        <ul>
                            <li>{{ $logbookpetirs[0]->onduty1 }}</li>
                            <li>{{ $logbookpetirs[0]->onduty2 }}</li>
                            <li>{{ $logbookpetirs[0]->onduty3 }}</li>
                        </ul>
                    </td>
                    <td>{{ $logbookpetirs[0]->kehadiran }}</td>
                    <td>{{ $logbookpetirs[0]->created_at->diffForHumans() }}</td>
                </tr>
            </tbody>
        </table>
    @else
        {{-- Tampilkan pesan bahwa belum ada data --}}
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status"></div>
        </div>
        <p class="text-center">Data Logbook Petir Belum Diisi Shift Siang</p>
    @endif
@else
    @php
        $timeRangeStart = \Carbon\Carbon::createFromTime(20, 0, 0, 'Asia/Makassar');
        $timeRangeEnd = \Carbon\Carbon::createFromTime(8, 0, 0, 'Asia/Makassar');
        // Check if $timeRangeEnd is before $timeRangeStart
        if ($timeRangeEnd->lt($timeRangeStart)) {
            // If $timeRangeEnd is before $timeRangeStart, add one day
            $timeRangeEnd->addDay();
        }
        $dataInRange = false;

        // Periksa apakah ada data antara pukul 22.38 dan 22.45 WITA
        foreach ($logbookpetirs as $logbookpetir) {
            if ($logbookpetir->created_at->between($timeRangeStart, $timeRangeEnd)) {
                $dataInRange = true;
                break;
            }
        }
    @endphp

    @if ($dataInRange)
        {{-- Tampilkan data yang ada dalam rentang waktu --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tipe Logbook</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">On Duty</th>
                    <th scope="col">Kehadiran</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Logbook Petir</th>
                    <td>{{ $logbookpetirs[0]->tanggal }}</td>
                    <td>
                        <ul>
                            <li>{{ $logbookpetirs[0]->onduty1 }}</li>
                            <li>{{ $logbookpetirs[0]->onduty2 }}</li>
                            <li>{{ $logbookpetirs[0]->onduty3 }}</li>
                        </ul>
                    </td>
                    <td>{{ $logbookpetirs[0]->kehadiran }}</td>
                    <td>{{ $logbookpetirs[0]->created_at->diffForHumans() }}</td>
                </tr>
            </tbody>
        </table>
    @else
        {{-- Tampilkan pesan bahwa belum ada data --}}
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status"></div>
        </div>
        <p class="text-center">Data Logbook Petir Belum Diisi Shift Malam</p>
    @endif
@endif

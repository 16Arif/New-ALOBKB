@extends('layouts.app')

@section('title', 'Data Aloptama')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
            </div>
        </div>

        <section class="section">
            <div class="section-header">
                <h1>Data Aloptama</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Aloptama</div>
                    <div class="breadcrumb-item">Data Peralatan</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Peralatan Operasional Utama (Aloptama)</h2>
                <p class="section-lead">Manajemen inventaris dan spesifikasi sensor Seismograph, Accelerograph Non Colocated, Lightning Detector, WRS New Generation, serta Magnet Prekursor.</p>

                <!-- Tabs Navigation Header -->
                @include('pages.aloptama.partials.tabs-header')

                <!-- Tabs Content Panels -->
                <div class="tab-content" id="aloptamaTabContent">
                    <!-- Tab 1: Seismograph -->
                    <div class="tab-pane fade show active" id="tab-seismo" role="tabpanel" aria-labelledby="seismo-tab">
                        @include('pages.aloptama.partials.tables.seismograph-table')
                    </div>

                    <!-- Tab 2: Accelerograph -->
                    <div class="tab-pane fade" id="tab-acc" role="tabpanel" aria-labelledby="acc-tab">
                        @include('pages.aloptama.partials.tables.accelerograph-table')
                    </div>

                    <!-- Tab 3: Lightning Detector -->
                    <div class="tab-pane fade" id="tab-ld" role="tabpanel" aria-labelledby="ld-tab">
                        @include('pages.aloptama.partials.tables.lightning-detector-table')
                    </div>

                    <!-- Tab 4: WRS New Generation -->
                    <div class="tab-pane fade" id="tab-wrs" role="tabpanel" aria-labelledby="wrs-tab">
                        @include('pages.aloptama.partials.tables.wrs-ng-table')
                    </div>

                    <!-- Tab 5: Magnet Prekursor -->
                    <div class="tab-pane fade" id="tab-magnet" role="tabpanel" aria-labelledby="magnet-tab">
                        @include('pages.aloptama.partials.tables.magnet-prekursor-table')
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modals for all Aloptama -->
    @include('pages.aloptama.partials.modals.seismograph-modal')
    @include('pages.aloptama.partials.modals.accelerograph-modal')
    @include('pages.aloptama.partials.modals.lightning-detector-modal')
    @include('pages.aloptama.partials.modals.wrs-ng-modal')
    @include('pages.aloptama.partials.modals.magnet-prekursor-modal')
@endsection

@push('scripts')
    @include('pages.aloptama.partials.scripts')
@endpush

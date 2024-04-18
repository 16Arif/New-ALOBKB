@extends('layouts.app')

@section('title', 'Bantuan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Bantuan</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Info</a></div>
                    <div class="breadcrumb-item">Bantuan</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Info Bantuan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="accordion">
                                            <div class="accordion">
                                                <div class="accordion-header" role="button" data-toggle="collapse"
                                                    data-target="#panel-body-1" aria-expanded="true">
                                                    <h4>Memperbarui Data User</h4>
                                                </div>
                                                <div class="accordion-body collapse show" id="panel-body-1"
                                                    data-parent="#accordion">
                                                    <p class="mb-0">Masing-masing user dapat update data pribadi maupun
                                                        foto profil dengan cara berikut:</p>
                                                    <ol>
                                                        <li>Klik nama user pada bagian kanan atas</li>
                                                        <li>Pilih menu profil</li>
                                                        <li>Untuk memperbarui data user, lansung dapat edit data pada form
                                                            yang telah disediakan</li>
                                                        <li>Untuk memperbarui foto profil, dapat klik foto lalu memilih foto
                                                            yang diinginkan</li>
                                                        <li>User juga dapat menghapus foto profil dan kembali menggunakan
                                                            foto default</li>
                                                    </ol>
                                                    <p>Pengelolaan data user lainnya dapat menghubungi teknisi Stageof
                                                        Balikpapan</p>
                                                </div>
                                            </div>
                                            <div class="accordion">
                                                <div class="accordion-header" role="button" data-toggle="collapse"
                                                    data-target="#panel-body-2">
                                                    <h4>Menambahkan Data Logbook</h4>
                                                </div>
                                                <div class="accordion-body collapse" id="panel-body-2"
                                                    data-parent="#accordion">
                                                    <p class="mb-0">Bagi user yang mau menambahkan data Logbook dapat
                                                        dilakukan dengan data berikut : </p>
                                                    <ol>
                                                        <li>
                                                            User Dapat memilih menu yang sesuai.(LogbookGempabumi, Logbook
                                                            Petir,
                                                            Logbook Peralatan)
                                                        </li>
                                                        <li>Pada menu terkait, klik "Tambah Data"</li>
                                                        <li>Selanjutnya user dapat menambahkan data baru</li>
                                                        <li>Klik Submit untuk menyimpan data baru</li>
                                                    </ol>
                                                </div>
                                            </div>
                                            <div class="accordion">
                                                <div class="accordion-header" role="button" data-toggle="collapse"
                                                    data-target="#panel-body-3">
                                                    <h4>Memperbarui Data Logbook</h4>
                                                </div>
                                                <div class="accordion-body collapse" id="panel-body-3"
                                                    data-parent="#accordion">
                                                    <p class="mb-0">Bagi user yang mau menambahkan data Logbook dapat
                                                        dilakukan dengan data berikut :</p>
                                                    <ol>
                                                        <li>
                                                            User Dapat memilih menu yang sesuai.(LogbookGempabumi, Logbook
                                                            Petir,
                                                            Logbook Peralatan)
                                                        </li>
                                                        <li>Pada menu terkait, scroll ke bagian paling kanan lalu klik icon
                                                            edit <i class="fas fa-edit"></i></li>
                                                        <li>Selanjutnya user dapat memperbarui data logbook</li>
                                                        <li>Klik Submit untuk menyimpan data baru</li>
                                                    </ol>
                                                </div>
                                            </div>
                                            <div class="accordion">
                                                <div class="accordion-header" role="button" data-toggle="collapse"
                                                    data-target="#panel-body-4">
                                                    <h4>Menghapus Data Logbook</h4>
                                                </div>
                                                <div class="accordion-body collapse" id="panel-body-4"
                                                    data-parent="#accordion">
                                                    <p class="mb-0">Bagi user yang mau menghapus data Logbook dapat
                                                        dilakukan dengan data berikut :</p>
                                                    <ol>
                                                        <li>
                                                            User Dapat memilih menu yang sesuai.(LogbookGempabumi, Logbook
                                                            Petir,
                                                            Logbook Peralatan)
                                                        </li>
                                                        <li>Pada menu terkait, scroll ke bagian paling kanan lalu klik icon
                                                            hapus <i class="fas fa-trash"></i></li>
                                                        <li>Dengan klik icon ini, maka akan muncul peringatan apakah user
                                                            yakin untuk menghapus data</li>
                                                        <li>Klik Ok untuk menghapus data</li>
                                                    </ol>
                                                </div>
                                            </div>
                                            <div class="accordion">
                                                <div class="accordion-header" role="button" data-toggle="collapse"
                                                    data-target="#panel-body-5">
                                                    <h4>Download Data Logbook</h4>
                                                </div>
                                                <div class="accordion-body collapse" id="panel-body-5"
                                                    data-parent="#accordion">
                                                    <p class="mb-0">User dapat download semua data logbook maupun data
                                                        masing-masing logbook</p>
                                                    <br>
                                                    <p>Bagi user yang mau download semua data Logbook dapat
                                                        dilakukan dengan data berikut :</p>
                                                    <ol>
                                                        <li>
                                                            User Dapat memilih menu yang sesuai.(LogbookGempabumi, Logbook
                                                            Petir,
                                                            Logbook Peralatan)
                                                        </li>
                                                        <li>Klik tombol Download Semua Data, dengan begitu semua data
                                                            logbook akan tersimpan dalam bentuk fiel excel</li>
                                                    </ol>
                                                    <br>
                                                    <p>Bagi user yang mau download data Logbook tertentu dapat
                                                        dilakukan dengan data berikut :</p>
                                                    <ol>
                                                        <li>
                                                            User Dapat memilih menu yang sesuai.(LogbookGempabumi, Logbook
                                                            Petir,
                                                            Logbook Peralatan)
                                                        </li>
                                                        <li>Pada menu terkait, scroll ke bagian paling kanan lalu klik icon
                                                            pdf <i class="fas fa-pdf"></i></li>
                                                        <li>Dengan klik icon ini, maka data logbook terkait akan tersimpan
                                                            dalam bentuk file pdf</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush

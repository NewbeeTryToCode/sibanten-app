@extends('dashboard.layouts.main')
@section('container')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <img src="https://source.unsplash.com/400x500/?website" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 mb-4">
                        {{-- Deskripsi Detail --}}
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <h4 class="text-primary">Banten Pejati</h4>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-6 col-sm-6">
                                <h6 class="text-primary">Kategori Banten</h6>
                                <h6>Alit</h6>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <h6 class="text-primary">Kategori Yadnya</h6>
                                <h6>Manusa Yadnya</h6>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-xs-6 col-sm-6">
                                <h6 class="text-primary">Unsur Banten</h6>
                                <h6>Mataya Yadnya</h6>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <h6 class="text-primary">Sifat Yadnya</h6>
                                <h6>Naimitika Yadnya</h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-6 col-sm-6">
                                <h6 class="text-primary">Alas Banten</h6>
                                <h6>Ceper</h6>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <h6 class="text-primary">Nama Yadnya</h6>
                                <h6>Mebayuh Oton</h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-6 col-sm-6">
                                <h6 class="text-primary">Tempat Diaturkan</h6>
                                <h6>Merajan</h6>
                            </div>
                        </div>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <button class="nav-link active" id="nav-deskripsi-tab" data-bs-toggle="tab" data-bs-target="#nav-deskripsi" type="button" role="tab" aria-controls="nav-deskripsi" >Deskripsi</button>
                              <button class="nav-link" id="nav-komposisi-tab" data-bs-toggle="tab" data-bs-target="#nav-komposisi" type="button" role="tab" aria-controls="nav-komposisi" aria-selected="false">Komposisi</button>

                            </div>
                          </nav>
                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <p class="text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel nobis quos facere a quae? Quas, animi ducimus. Eos odit sequi minus, et sint deleniti neque.</p>
                            </div>
                            <div class="tab-pane fade" id="nav-komposisi" role="tabpanel" aria-labelledby="nav-komposisi-tab">
                                <p class="text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel nobis quos facere a quae? Quas, animi ducimus. Eos odit sequi minus, et sint deleniti neque.</p>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
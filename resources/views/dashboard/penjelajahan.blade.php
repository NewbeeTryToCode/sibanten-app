@extends('dashboard.layouts.main')
@section('container')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="post" class="row mb-4">
                        <div class="form-group col-sm-6 my-2">
                            <select class="custom-select" id="kategori_banten">
                                <option selected>Kategori Yadnya</option>
                                <option value="manusa_yadnya">Manusa Yadnya</option>
                                <option value="dewa_yadnya">Dewa Yadnya</option>                            
                                <option value="bhuta_yadnya">Bhuta Yadnya</option>
                                <option value="rsi_yadnya">Rsi Yadnya</option>
                                <option value="pitraa_yadnya">Pitra Yadnya</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6 my-2">
                        </div>
                        <div class="form-group col-sm-6 my-2">
                            <button type="submit" class="btn  float-right btn-primary px-4">Cari</button>
                        </div>
                    </form>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header py-3 bg-primary text-light">
                            <h6 class="m-0 text-light text-center">Hasil Pencarian</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover mb-4">
                                        <img src="https://source.unsplash.com/325x200/?website" style="opacity: 0.8" alt="">
                                        <div class="card-body">
                                            <a href="/item/slug" class="text-decoration-none text-secondary"><h5 class="text-center">Card title</h5></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover mb-4">
                                        <img src="https://source.unsplash.com/325x200/?website" style="opacity: 0.8" alt="">
                                        <div class="card-body">
                                            <a href="/item/slug" class="text-decoration-none text-secondary"><h5 class="text-center">Card title</h5></a>
                                        </div>
                                    </div>
                                </div>                   
                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover mb-4">
                                        <img src="https://source.unsplash.com/325x200/?website" style="opacity: 0.8" alt="">
                                        <div class="card-body">
                                            <a href="/item/slug" class="text-decoration-none text-secondary"><h5 class="text-center">Card title</h5></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover mb-4">
                                        <img src="https://source.unsplash.com/325x200/?website" style="opacity: 0.8" alt="">
                                        <div class="card-body">
                                            <a href="/item/slug" class="text-decoration-none text-secondary"><h5 class="text-center">Card title</h5></a>
                                        </div>
                                    </div>
                                </div>
                             </div>
                             <div class="d-flex justify-content-center">
                                <h6>Pagination</h6>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
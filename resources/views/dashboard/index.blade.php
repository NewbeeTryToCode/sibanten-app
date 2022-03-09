@extends('dashboard.layouts.main')
@section('container')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>
    {{-- overview --}}
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">
            <!-- Project Card Example -->
            <div class="card card-hover shadow mb-4">
                <div class="card-body">
                    <h4 class="small font-weight-bold">Manusa Yadnya <span
                            class="float-right">30</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Bhuta Yadnya <span
                            class="float-right">30</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%"
                            aria-valuenow=" 30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Dewa Yadnya <span
                            class="float-right">19</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 19%"
                            aria-valuenow="19" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Rsi Yadnya <span
                            class="float-right">15</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 15%"
                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Pitra Yadnya <span
                            class="float-right">10</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 10%"
                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="row">
                <div class="col-xl-6 col-sm-6 mb-4">
                    <div class="card card-hover border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Kategori Banten</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-sm-6 mb-4">
                    <div class="card card-hover border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Kategori Yadnya</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-sm-6 mb-4">
                    <div class="card card-hover border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success  text-uppercase mb-1">
                                        Jumlah Banten</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">60</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-sm-6 mb-4">
                    <div class="card card-hover border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah Upacara</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">20</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
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
@endsection
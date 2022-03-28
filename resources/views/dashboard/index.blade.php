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
                            class="float-right">{{ $tipeUpacara['ManusaYadnya'] }}</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{  $tipeUpacara['ManusaYadnya']/$totalTipeUpacara * 100 }}%"
                            aria-valuenow="{{ $tipeUpacara['ManusaYadnya'] }}" aria-valuemin="0" aria-valuemax="{{ $totalTipeUpacara }}"></div>
                    </div>
                    <h4 class="small font-weight-bold">Bhuta Yadnya <span
                            class="float-right">{{ $tipeUpacara['BhutaYadnya'] }}</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{  $tipeUpacara['BhutaYadnya']/$totalTipeUpacara * 100 }}%"
                            aria-valuenow="{{ $tipeUpacara['BhutaYadnya'] }}" aria-valuemin="0" aria-valuemax="{{ $totalTipeUpacara }}"></div>
                    </div>
                    <h4 class="small font-weight-bold">Dewa Yadnya <span
                            class="float-right">{{ $tipeUpacara['DewaYadnya'] }}</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{  $tipeUpacara['DewaYadnya']/$totalTipeUpacara * 100 }}%"
                            aria-valuenow="{{ $tipeUpacara['DewaYadnya'] }}" aria-valuemin="0" aria-valuemax="{{ $totalTipeUpacara }}"></div>
                    </div>
                    <h4 class="small font-weight-bold">Rsi Yadnya <span
                            class="float-right">{{ $tipeUpacara['RsiYadnya'] }}</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: {{  $tipeUpacara['RsiYadnya']/$totalTipeUpacara * 100 }}%"
                            aria-valuenow="{{ $tipeUpacara['RsiYadnya'] }}" aria-valuemin="0" aria-valuemax="{{ $totalTipeUpacara }}"></div>
                    </div>
                    <h4 class="small font-weight-bold">Pitra Yadnya <span
                            class="float-right">{{ $tipeUpacara['PitraYadnya'] }}</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{  $tipeUpacara['PitraYadnya']/$totalTipeUpacara * 100 }}%"
                            aria-valuenow="{{ $tipeUpacara['PitraYadnya'] }}" aria-valuemin="0" aria-valuemax="{{ $totalTipeUpacara }}"></div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count }}</div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countupacara }}</div>
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
                            @foreach ($banten as $b)
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-hover mx-1 mb-4">
                                    <img src="assets/images/banten/{{ $b['gambar'] }}" style="opacity: 0.8; width:100%; height:160px" alt="{{ $b['gambar'] }}">
                                    <div class="card-body">
                                        <a href="/dashboard/detail/{{ $b['nama_banten'] }}" class="text-decoration-none text-secondary"><h5 class="text-center">{{ str_replace('_',' ',$b['nama_banten']) }}</h5   ></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $banten->links() }}
                        </div>
                    </div>
                </div> 
            </div>   
    </div>
@endsection
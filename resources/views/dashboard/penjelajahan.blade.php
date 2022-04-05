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
                    <form action="" class="row mb-4">
                        <div class="form-group col-sm-6 my-2">
                            <select class="custom-select" name="kategoriYadnya" id="kategoriYadnya">
                                <option value="">Kategori Yadnya</option>
                                @foreach ($data['kategoriYadnya'] as $item)
                                @if($data['namaKategori']!=null && $data['namaKategori'][1]['namaKategori']==$item['kategoriYadnya'] || isset($_GET['kategoriYadnya']) &&$_GET['kategoriYadnya']==$item['kategoriYadnya'])
                                    <option selected value="{{ $item['kategoriYadnya'] }}">{{ preg_replace('/(?<!\ )[A-Z]/', ' $0', $item['kategoriYadnya']) }}</option>
                                @else
                                    <option value="{{ $item['kategoriYadnya'] }}">{{ preg_replace('/(?<!\ )[A-Z]/', ' $0', $item['kategoriYadnya']) }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6 my-2">
                        </div>
                        <div class="form-group col-sm-6 my-2">
                            <a href="/dashboard/penjelajahan" class="btn float-right btn-warning px-4 ml-2">Reset</a>
                            <button type="submit" name="penjelajahanBanten" class="btn  float-right btn-primary px-4">Jelajah</button>
                        </div>
                    </form>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header py-3 bg-primary text-light">
                            <h6 class="m-0 text-light text-center">Hasil Penjelajahan</h6>
                        </div>
                        <div class="card-body">
                            @if(isset($_GET['NamaYadnya']))
                                @if($data['resp']==0)
                                    <h4 class="small font-weight-bold">Belum terdapat penjelajahan data<span> </h4>
                                @elseif($data['resp']==1&&$data['jumlahBanten']==0)
                                    <h4 class="small font-weight-bold">Data tidak ditemukan</h4>
                                @else
                                    <div class="row" id="hasilSearching">

                                        @foreach ($data['listBanten'] as $item)
                                            <div class="col-md-6 col-lg-3">
                                                <div class="card card-hover mb-4">
                                                    <img src="assets/images/banten/{{ $item['gambar'] }}" style="opacity: 0.8; width:100%; height:160px" alt="{{ $item['namaBanten'] }}">
                                                    <div class="card-body">
                                                        <a href="/dashboard/detail/{{ $item['namaBanten'] }}" class="text-decoration-none text-secondary"><h5 class="text-center">{{ str_replace("_"," ",$item['namaBanten']) }}</h5></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                 <div class="d-flex justify-content-center">
                                @if($data['jumlahBanten']>12)
                                    {{ $data['listBanten']->links()}}  
                                @endif
                            @else
                                @if($data['resp']==0)
                                    <h4 class="small font-weight-bold">Belum terdapat penjelajahan data<span> </h4>
                                @elseif($data['resp']==1&&$data['jumlahYadnya']==0)
                                    <h4 class="small font-weight-bold">Data tidak ditemukan</h4>
                                @else
                                    <div class="row" id="hasilSearching">

                                        @foreach ($data['resultNamaYadnya'] as $item)
                                            <div class="col-md-6 col-lg-3">
                                                <div class="card card-hover mb-4">
                                                    <img src="{{ asset('assets/images/upacara/'.$item['gambar'].'') }}" style="opacity: 0.8; width:100%; height:160px" alt="{{ $item['gambar'] }}">
                                                    <div class="card-body">
                                                        <a href="/dashboard/penjelajahan?NamaYadnya={{ $item['namaUpacara'] }}" class="text-decoration-none text-secondary"><h5 class="text-center">{{ str_replace("_"," ",$item['namaUpacara']) }}</h5></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                 <div class="d-flex justify-content-center">
                                @if($data['jumlahYadnya']>12)
                                    {{ $data['hasilSearching']->links()}}  
                                @endif
                            @endif
                                
                        </div>  
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
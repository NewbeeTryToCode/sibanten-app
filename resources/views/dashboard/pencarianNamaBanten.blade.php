@extends('dashboard.layouts.main')
@section('container')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>
    {{-- form card --}}
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <form action="" class="row mb-4"> 
                        <div class="col-md-6">
                            <div class="form-group col-md-12 my-2">
                                <input required type="text" class="form-control" placeholder="Cari nama Banten" value="{{ isset($_GET['cari_namaBanten'])? $_GET['cari_namaBanten'] : '' }}" id="cari_namaBanten" name="cari_namaBanten">
                            </div>
                            <div class="form-group col-sm-12 my-2">
                                <a href="/dashboard/pencarianNamaBanten" class="btn float-right btn-warning px-4 ml-2">Reset</a>
                                <button type="submit" id="cari_banten" name="cari_banten" class="btn float-right btn-primary px-4">Cari</button>
                            </div>
                        </div>
                        @if($sql!=='')
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                  SPARQL Query
                                </div>
                                <div class="card-body">
                                    <p>{{ $sql }}</p>
                                </div>
                              </div>
                        </div>
                        @endif
                    </form>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header py-3  bg-primary rounded">
                            <h6 class="m-0 text-light text-center">Hasil Pencarian</h6>
                        </div>
                        <div class="card-body">
                            @if($data['resp']==0)
                                <h4 class="small font-weight-bold">Belum terdapat pencarian data<span> </h4>
                            @elseif($data['resp']==1&&$data['jumlahBanten']==0)
                                <h4 class="small font-weight-bold">Data tidak ditemukan</h4>
                            @else
                                <div class="row" id="hasilSearching">
                                    @foreach ($data['hasilSearching'] as $item)
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card card-hover mb-4">
                                                <img src="{{ asset('assets/images/banten/'.$item['gambar'].'') }}" style="opacity: 0.8; width:100%; height:160px" alt="{{ $item['nama'] }}">
                                                <div class="card-body">
                                                    <a href="/dashboard/detail/{{ $item['nama'] }}" class="text-decoration-none text-secondary"><h5 class="text-center">{{ str_replace("_"," ",$item['nama']) }}</h5></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="d-flex justify-content-center">
                                @if($data['jumlahBanten']>12)
                                    {{ $data['hasilSearching']->links()}}  
                               @endif
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
@endsection
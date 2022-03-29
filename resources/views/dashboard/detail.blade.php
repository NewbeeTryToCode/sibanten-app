<?php
use App\Http\Controllers\DetailController;
?>
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
                    <div class="col-lg-6 mb-4 text-center">
                        <img src="https://source.unsplash.com/400x500/?website" class="img-fluid " alt="">
                    </div>
                    <div class="col-lg-6 mb-4">
                        {{-- Deskripsi Detail --}}
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <?php
                                $index = 'namaBanten'
                                ?>
                                @foreach (DetailController::sameAs($detailBanten,$index) as $item)
                                <h4 class="text-primary">{{ str_replace('_',' ',$item) }}</h4>
                                @endforeach
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-6 col-sm-6">
                                <?php
                                $index = 'tingkatanBanten'
                                ?>
                                <h6 class="text-primary">Tingkatan Banten</h6>
                                @foreach(DetailController::sameAs($detailBanten,$index) as $item)
                                @if($item =='Alit'||$item=='Madya'||$item=='Utama')
                                <h6>{{ $item }}</h6>
                                @endif
                                @endforeach
                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <?php
                                $index = 'kategoriYadnya'
                                ?>
                                <h6 class="text-primary">Kategori Yadnya</h6>
                                @foreach (DetailController::sameAs($detailYadnya,$index) as $item)
                                @if($item =='ManusaYadnya'||$item=='DewaYadnya'||$item=='RsiYadnya'
                                ||$item=='BhutaYadnya'||$item=='PitraYadnya')
                                <h6>{{ preg_replace('/(?<!\ )[A-Z]/', ' $0', $item) }}</h6>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-6 col-sm-6">
                                <?php
                                $index = 'unsurBanten';
                                $unsurBanten = '';
                                ?>
                                <h6 class="text-primary">Unsur Banten</h6>
                                @foreach (DetailController::sameAs($detailBanten,$index) as $item)
                                @if($item =='Mataya'||$item=='Mantiga'||$item=='Maharya')
                                <?php
                                $unsurBanten = $unsurBanten.' '.$item;
                                ?>
                                @endif
                                @endforeach
                                <h6>{{ $unsurBanten }}</h6>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <h6 class="text-primary">Sifat Yadnya</h6>
                                <?php
                                $index = 'periodeYadnya';
                                ?>
                                @foreach (DetailController::sameAs($detailYadnya,$index) as $item)
                                @if($item =='Nitya_Yadnya'||$item=='Naimitika_Yadnya')
                                <h6>{{ str_replace('_',' ',$item )}}</h6>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-6 col-sm-6">
                                <?php
                                $index = 'alasBanten';
                                ?>
                                <h6 class="text-primary">Alas Banten</h6>
                                @foreach (DetailController::sameAs($detailBanten,$index) as $item)
                                <h6>{{ str_replace('_',' ',$item )}}</h6>
                                @endforeach
                                </div>
                            <div class="col-xs-6 col-sm-6">
                                <?php
                                $index = 'namaUpacara';
                                ?>
                                <h6 class="text-primary">Nama Upacara</h6>
                                @foreach (DetailController::sameAs($detailYadnya,$index) as $item)
                                <h6>{{ str_replace('_',' ',$item )}}</h6>
                                @endforeach                            
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-6 col-sm-6">
                                <?php
                                $index = 'tempatDiaturkan';
                                ?>
                                <h6 class="text-primary">Tempat Diaturkan</h6>
                                @foreach (DetailController::sameAs($detailBanten,$index) as $item)
                                <h6>{{ str_replace('_',' ',$item )}}</h6>
                                @endforeach
                          </div>
                        </div>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <button class="nav-link active" id="nav-deskripsi-tab" data-bs-toggle="tab" data-bs-target="#nav-deskripsi" type="button" role="tab" aria-controls="nav-deskripsi" >Deskripsi</button>
                              <button class="nav-link" id="nav-komponen-tab" data-bs-toggle="tab" data-bs-target="#nav-komponen" type="button" role="tab" aria-controls="nav-komponen" aria-selected="false">Komponen</button>

                            </div>
                          </nav>
                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-deskripsi" role="tabpanel" aria-labelledby="nav-deskripsi-tab">
                                <?php
                                $index = 'deskripsi';
                                ?>
                                @foreach (DetailController::sameAs($detailBanten,$index) as $item)
                                {{ $item }}
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="nav-komponen" role="tabpanel" aria-labelledby="nav-komponen-tab">
                                <?php
                                $index = 'komponen';
                                ?>
                                @foreach (DetailController::sameAs($detailBanten,$index) as $item)
                                <a class="text-decoration-nonne text-secondary" href="/dashboard/detail/{{ $item }}">{{ str_replace('_',' ',$item.',') }}
                                    </a>
                                @endforeach
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
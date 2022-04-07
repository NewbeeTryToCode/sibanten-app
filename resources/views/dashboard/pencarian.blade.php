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
                        <div class="form-group col-sm-6 my-2">
                           <select class="custom-select"id="cari_kategoriTingkatanBanten" name="cari_kategoriTingkatanBanten">
                                <option value="">Kategori Banten</option>
                                @foreach ($data['listKategoriTingkatanBanten'] as $item)
                                @if(isset($_GET['cari_kategoriTingkatanBanten']) &&$_GET['cari_kategoriTingkatanBanten']==$item['kategoriTingkatanBanten'])
                                <option selected value="{{ $item['kategoriTingkatanBanten'] }}">{{ $item['kategoriTingkatanBanten'] }}</option>
                                @else
                                <option value="{{ $item['kategoriTingkatanBanten'] }}">{{ $item['kategoriTingkatanBanten'] }}</option>
                                @endif
                                @endforeach
                            </select>
                       </div>   
                        <div class="form-group col-sm-6 my-2">
                            <select class="custom-select" id="cari_kategoriYadnya" name="cari_kategoriYadnya">
                                 <option value="">Kategori Yadnya</option>
                                 @foreach ($data['listKategoriYadnya'] as $item)
                                 @if(isset($_GET['cari_kategoriYadnya']) &&$_GET['cari_kategoriYadnya']==$item['kategoriYadnya'])
                                 <option selected value="{{ $item['kategoriYadnya'] }}">{{ preg_replace('/(?<!\ )[A-Z]/', ' $0', $item['kategoriYadnya']) }}</option>
                                 @else
                                 <option value="{{ $item['kategoriYadnya'] }}">{{ preg_replace('/(?<!\ )[A-Z]/', ' $0', $item['kategoriYadnya']) }}</option>
                                 @endif
                            @endforeach
                             </select>
                        </div>
                        <div class="form-group col-sm-6 my-2">
                            <select class="custom-select" id="cari_kategoriUnsurBanten" name="cari_kategoriUnsurBanten">
                                <option value="">Unsur Banten</option>                            
                                @foreach ($data['listKategoriUnsurBanten'] as $item)
                                @if(isset($_GET['cari_kategoriUnsurBanten']) &&$_GET['cari_kategoriUnsurBanten']==$item['kategoriUnsurBanten'])
                                <option selected value="{{ $item['kategoriUnsurBanten'] }}">{{ $item['kategoriUnsurBanten'] }}</option>
                                @else
                                <option value="{{ $item['kategoriUnsurBanten'] }}">{{ $item['kategoriUnsurBanten'] }}</option>
                                @endif                            
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6 my-2">
                            <select class="custom-select" id="cari_kategoriPeriodeYadnya" name="cari_kategoriPeriodeYadnya">
                                 <option value="">Periode Yadnya</option>
                                 @foreach ($data['listKategoriPeriodeYadnya'] as $item)
                                 @if(isset($_GET['cari_kategoriPeriodeYadnya']) &&$_GET['cari_kategoriPeriodeYadnya']==$item['kategoriPeriodeYadnya'])
                                 <option selected value="{{ $item['kategoriPeriodeYadnya'] }}">{{ str_replace('_'," ",$item['kategoriPeriodeYadnya']) }}</option>
                                 @else
                                 <option value="{{ $item['kategoriPeriodeYadnya'] }}">{{ str_replace('_'," ",$item['kategoriPeriodeYadnya']) }}</option>
                                 @endif
                            @endforeach                            
                             </select>
                        </div> 
                        <div class="form-group col-sm-6 my-2">
                            <select class="custom-select" id="cari_kategoriAlasBanten" name="cari_kategoriAlasBanten">
                                <option value="">Alas Banten</option>                            
                                @foreach ($data['listKategoriAlasBanten'] as $item)
                                @if(isset($_GET['cari_kategoriAlasBanten']) &&$_GET['cari_kategoriAlasBanten']==$item['kategoriAlasBanten'])
                                <option selected value="{{ $item['kategoriAlasBanten'] }}">{{ $item['kategoriAlasBanten'] }}</option>
                                @else
                                <option value="{{ $item['kategoriAlasBanten'] }}">{{ str_replace('_'," ",$item['kategoriAlasBanten']) }}</option>
                                @endif                            
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6 my-2">
                            <select class="form-control selectpicker border multi-select-filter" placeholder="Komponen Banten"  id="cari_kategoriKomponenBanten"  multiple name="cari_kategoriKomponenBanten[]">
                                @foreach ($data['listKategoriKomponenBanten'] as $item)
                                <option value="{{ $item['kategoriKomponenBanten'] }}">{{ str_replace('_'," ",$item['kategoriKomponenBanten']) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-12 my-2">
                            <a href="/dashboard/pencarian" class="btn float-right btn-warning px-4 ml-2">Reset</a>
                            <button type="submit" id="cari_banten" name="cari_banten" class="btn float-right btn-primary px-4">Cari</button>
                        </div>
                    </form>
                    @if($sql!=='')
                    <div class="row mb-4">
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
                    </div>
                    @endif
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
    
    <script>
        var select = document.getElementById('cari_kategoriKomponenBanten');
        multi(select,[]);
        select.mulstiselect({
            nonSelectedText:'Services'
        });
        $(".multi-select-filter").each(function () {
        $(this).multipleSelect({
        filter: true,
        width: "100%",
        placeholder: $(this).attr('placeholder')
    });
})
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
@endsection
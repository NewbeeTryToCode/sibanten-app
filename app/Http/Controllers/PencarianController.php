<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PencarianController extends Controller
{
    public function pencarian(Request $request){
        $tingkatanBanten = $this->sparql->query('SELECT ?tingkatanBanten 
        WHERE { ?tingkatanBanten rdfs:subClassOf banten:Tingkatan }
        ');
        $kategoriYadnya = $this->sparql->query('SELECT ?kategoriYadnya 
        WHERE {?kategoriYadnya rdfs:subClassOf banten:Upacara}
        ');
        $unsurBanten = $this->sparql->query('SELECT ?unsur 
        WHERE{?unsur a banten:Unsur}');
        $periodeYadnya = $this->sparql->query('SELECT ?periodeYadnya 
        WHERE{?periodeYadnya a banten:PeriodeYadnya}');
        $resultTingkatanBanten=[];
        $resultKategoriYadnya=[];
        $resultUnsurBanten = [];
        $resultPeriodeYadnya = [];

        foreach($tingkatanBanten as $item){
            array_push($resultTingkatanBanten, [
                'kategoriTingkatanBanten' => $this->parseData($item->tingkatanBanten->getUri())
            ]);
        }
        foreach($kategoriYadnya as $item){
            array_push($resultKategoriYadnya, [
                'kategoriYadnya' => $this->parseData($item->kategoriYadnya->getUri())
            ]);
        }
        foreach($unsurBanten as $item){
            array_push($resultUnsurBanten, [
                'kategoriUnsurBanten' => $this->parseData($item->unsur->getUri())
            ]);
        }
        foreach($periodeYadnya as $item){
            array_push($resultPeriodeYadnya, [
                'kategoriPeriodeYadnya' => $this->parseData($item->periodeYadnya->getUri())
            ]);
        }

        if($request->has('cari_banten') !=''||$request->has('cari_kategoriTingkatanBanten')||
        $request->has('cari_kategoriUnsurBanten')||$request->has('cari_kategoriYadnya')||
        $request->has('cari_kategoriPeriodeYadnya')){
            $resp = 1;
            $sql = 'SELECT ?banten (COALESCE(?gambar, ?missing) as ?gambarnull) WHERE{
                VALUES ?missing {"missing.jpeg"} {';
            $i = 0;
            if($request->cari_kategoriTingkatanBanten !=''){
                if($i ==0){
                    $sql = $sql.'?banten a banten:'.$request->cari_kategoriTingkatanBanten;
                    $i++;
                }else{
                    $sql = $sql.'.?banten a banten:'.$request->cari_kategoriTingkatanBanten;
                }
            }
            else{
                $sql=$sql;
            }if($request->cari_kategoriUnsurBanten !=''){
                if($i ==0){
                    $sql = $sql.'?banten banten:memilikiUnsurBanten banten:'.$request->cari_kategoriUnsurBanten;
                    $i++;
                }else{
                    $sql = $sql.'.?banten banten:memilikiUnsurBanten banten:'.$request->cari_kategoriUnsurBanten;
                }
            }else{
                $sql=$sql;
            }
            if($request->cari_kategoriYadnya !=''){
                if($i==0){
                    $sql = $sql.'?upacara  a banten:'.$request->cari_kategoriYadnya.'.?upacara banten:memilikiBanten ?banten';
                    $i++;
                }
                else{
                    $sql = $sql.'.?upacara a banten:'.$request->cari_kategoriYadnya.'.?upacara banten:memilikiBanten ?banten';
                }
            }else{
                $sql=$sql;
            }
            if($request->cari_kategoriPeriodeYadnya !=''){
                if($i==0){
                    $sql = $sql.'?periode banten:memilikiSifatYadnya banten:'.$request->cari_kategoriPeriodeYadnya.'.?periode banten:memilikiBanten ?banten';
                    $i++;
                }
                else{
                    $sql = $sql.'.?periode banten:memilikiSifatYadnya banten:'.$request->cari_kategoriPeriodeYadnya.'.?periode banten:memilikiBanten ?banten';

                }
            }
            else{
                $sql=$sql;
            }
            $sql=$sql.'} OPTIONAL {?banten banten:memilikiFoto ?gambar}}ORDERBY ?banten';
            $queryData = $this->sparql->query($sql);
            $resultBanten = [];
            if($i===0){
                $resultBanten=[];
            }
            else{
                foreach($queryData as $item){
                    array_push($resultBanten,[
                        'nama'=>$this->parseData($item->banten->getUri()),
                        'gambar'=>$this->parseData($item->gambarnull->getValue())
                    ]);
                }
            }
            $jumlahBanten = count($resultBanten);
        }
        
        else{
            $resultBanten=[];
            $jumlahBanten=0;
            $resp=0;
        }
        $hasilSearchingBanten = $this->paginate($resultBanten)->withQueryString()->withPath('/dashboard/pencarian');
        $data =[
            'listKategoriTingkatanBanten'=>$resultTingkatanBanten,
            'listKategoriUnsurBanten'=>$resultUnsurBanten,
            'listKategoriYadnya'=>$resultKategoriYadnya,
            'listKategoriPeriodeYadnya'=>$resultPeriodeYadnya,
            'hasilSearching'=>$hasilSearchingBanten,
            'jumlahBanten'=>$jumlahBanten,
            'resp'=>$resp
        ];
        return view('dashboard.pencarian',[
            'title'=>'Pencarian',
            'data'=>$data
        ]);
    }
    public function paginate($items,$perPage = 12, $page = null, $options= []){
        $page = $page ?:(Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page,$perPage),$items->count(),$perPage,$page
        ,$options);
    }
}

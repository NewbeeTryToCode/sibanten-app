<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PenjelajahanController extends Controller
{
    public function penjelajahan(Request $request){
        $kategoriYadnya = $this->sparql->query('SELECT ?kategoriYadnya 
        WHERE {?kategoriYadnya rdfs:subClassOf banten:Upacara}
        ');
        $resultKategoriYadnya=[];
        foreach($kategoriYadnya as $item){
            array_push($resultKategoriYadnya, [
                'kategoriYadnya' => $this->parseData($item->kategoriYadnya->getUri())
            ]);
        } 
        $resultBantenYadnya=[];
        $jumlahBanten=0;
        $resp = 0;
        $jumlahYadnya=0;
        $resultNamaYadnya=[];
        //query kategori yadnya
        if($request->has('penjelajahanBanten')||$request->has('kategoriYadnya')){
            $resp=1;
            if($request->kategoriYadnya){
                $sql = 'SELECT ?namaUpacara (COALESCE(?gambar, ?missing) as ?gambarnull) WHERE{
                    VALUES ?missing {"missing.jpeg"} {?namaUpacara a banten:'.$request->kategoriYadnya.'} OPTIONAL{?namaUpacara banten:memilikiFoto ?gambar}}';
                $namaYadnya = $this->sparql->query($sql);
                foreach($namaYadnya as $item){
                    array_push($resultNamaYadnya,[
                        'namaUpacara'=>$this->parseData($item->namaUpacara->getUri()),
                        'gambar'=>$this->parseData($item->gambarnull->getValue())
                        
                    ]);
                }
            }
            else{
                $resultNamaYadnya=[];
            }
            $jumlahYadnya = $jumlahYadnya + count($resultNamaYadnya);

        }
        //query mencari banten dari yadnya
        if(isset($_GET['NamaYadnya'])){
            $resp= 1;
            $sql = 'SELECT ?banten (COALESCE(?gambar, ?missing) as ?gambarnull) WHERE{
                VALUES ?missing {"missing.jpeg"} {?banten banten:bantenDari banten:'.$_GET['NamaYadnya'].'} OPTIONAL{?banten banten:memilikiFoto ?gambar}}';
            $bantenYadnya = $this->sparql->query($sql);
            foreach($bantenYadnya as $item){
                 array_push($resultBantenYadnya,[
                     'namaBanten'=>$this->parseData($item->banten->getUri()),
                     'gambar'=>$this->parseData($item->gambarnull->getValue())
                 ]);
            }
            $jumlahBanten = $jumlahBanten + count($resultBantenYadnya);
        }            
        $hasilPenjelajahanBanten = $this->paginate($resultNamaYadnya)->withQueryString()->withPath('/dashboard/penjelajahan');
        ;

        $data=[
            'kategoriYadnya'=>$resultKategoriYadnya,
            'resultNamaYadnya'=>$resultNamaYadnya,
            'resp'=>$resp,
            'listBanten'=>$resultBantenYadnya,
            'jumlahYadnya'=>$jumlahYadnya,
            'jumlahBanten'=>$jumlahBanten,
            'hasilPenjelajahan'=>$hasilPenjelajahanBanten
        ];


        return view('dashboard.penjelajahan',[
            'title'=>'Penjelajahan',
            'data'=>$data,
            'sql'=>isset($sql)? $sql:''
        ]);
    }
    public function paginate($items,$perPage = 12, $page = null, $options= []){
        $page = $page ?:(Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page,$perPage),$items->count(),$perPage,$page
        ,$options);
    }
}

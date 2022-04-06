<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PencarianNamaBantenController extends Controller
{
    //

    public function index(Request $request){
        if($request->has('cari_banten')!=''||$request->cari_namaBanten!=''){
            $resp = 1;
            $sql = "SELECT ?banten 
            (COALESCE (?gambar,?missing) as ?gambarnull) 
                WHERE{VALUES ?missing {'missing.jpeg'}
                {?banten a banten:Alit} 
                UNION {?banten a banten:Banten} 
                UNION {?banten a banten:Madya}
                UNION {?banten a banten:Utama}
 				OPTIONAL{?banten banten:memilikiFoto ?gambar}";
            if($request->cari_namaBanten!=''){
                $sql = $sql."FILTER(REGEX(STR(?banten),'".$request->cari_namaBanten."','i'))}";
            }else{
                $sql=$sql;
            }
            $queryData = $this->sparql->query($sql);
            $resultBanten = [];
            foreach($queryData as $item){
                array_push($resultBanten,[
                    'nama'=>$this->parseData($item->banten->getUri()),
                    'gambar'=>$this->parseData($item->gambarnull->getValue())
                ]);
            }
            $jumlahBanten = count($resultBanten);
        }else{
            $resultBanten=[];
            $jumlahBanten=0;
            $resp=0;
            $sql='';
        }
        $hasilSearchingBanten = $this->paginate($resultBanten)->withQueryString()->withPath('/dashboard/pencarianNamaBanten');
        $data =[
            'hasilSearching'=>$hasilSearchingBanten,
            'jumlahBanten'=>$jumlahBanten,
            'resp'=>$resp
        ];
        return view('dashboard.pencarianNamaBanten',[
            'title'=>'Pencarian Berdasarkan Nama Banten',
            'data'=>$data,
            'sql'=>$sql
        ]);
    }
    public function paginate($items,$perPage = 12, $page = null, $options= []){
        $page = $page ?:(Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page,$perPage),$items->count(),$perPage,$page
        ,$options);
    }
}


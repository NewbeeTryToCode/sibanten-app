<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function detail($namaBanten){
        //kueri data detail
        $detailBanten = $this->sparql->query('SELECT * WHERE
        { VALUES ?namaBanten{banten:'.$namaBanten.'}
  		?namaBanten banten:memilikiUnsurBanten ?unsurBanten
  		OPTIONAL {?namaBanten banten:memilikiKomponen ?komponen}
        OPTIONAL {?namaBanten rdf:type ?tingkatanBanten}  
        OPTIONAL {?namaBanten banten:memilikiAlasBanten ?alasBanten}
        OPTIONAL {?namaBanten banten:memilikiTempatDiaturkan ?tempatDiaturkan} 
        OPTIONAL {?namaBanten banten:memilikiDeskripsi ?deskripsi} 
        OPTIONAL {?namaBanten banten:memilikiFoto ?gambar} 
        }');
        // kueri data detail yadnya dari banten dibuat 2 karena kalau jadi 1 terlalu banyak hasil kueri untuk optimalisasi sistem
        $detailYadnya = $this->sparql->query('SELECT ?namaUpacara ?kategoriYadnya ?periodeYadnya WHERE
        { VALUES ?namaBanten{banten:'.$namaBanten.'}
  		{?namaBanten banten:bantenDari ?namaUpacara}
  		OPTIONAL{?namaUpacara rdf:type ?kategoriYadnya}
  		OPTIONAL{?namaUpacara banten:memilikiSifatYadnya ?periodeYadnya}
        }');

        $resultDetailBanten = [];
        $resultDetailYadnya = [];
        $default = 'http://www.semanticweb.org/anom/ontologies/2022/2/untitled-ontology-25#-';
        

        foreach($detailBanten as $item){
            if(!isset($item->namaUpacara)){
                $item->namaUpacara = $default;
            }
            if(!isset($item->unsurBanten)){
                $item->unsurBanten = $default;
            }
            if(!isset($item->komponen)){
                $item->komponen = $default;
            }
            if(!isset($item->tingkatanBanten)){
                $item->tingkatanBanten = $default;
            }
            if(!isset($item->tempatDiaturkan)){
                $item->tempatDiaturkan = $default;
            }
            if(isset($item->alasBanten)===false){
                $item->alasBanten = $default;
            }
            if(!isset($item->deskripsi)){
                $item->deskripsi = $default;
            }
            if(!isset($item->gambar)){
                $item->gambar = $default;
            }
            array_push($resultDetailBanten,[
                'namaBanten'=>$this->parseData($item->namaBanten),
                'unsurBanten'=>$this->parseData($item->unsurBanten),
                'komponen'=>$this->parseData($item->komponen),
                'tingkatanBanten'=>$this->parseData($item->tingkatanBanten),
                'tempatDiaturkan'=>$this->parseData($item->tempatDiaturkan),
                'alasBanten'=>$this->parseData($item->alasBanten    ),
                'deskripsi'=>$this->parseData($item->deskripsi),
                'gambar'=>$this->parseData($item->gambar)
            ]);
        }
        foreach($detailYadnya as $item){
            if(!isset($item->kategoriYadnya)){
                $item->kategoriYadnya = $default;
            }
            elseif(!isset($item->periodeYadnya)){
                $item->periodeYadnya = $default;
            }
            array_push($resultDetailYadnya,[
                'namaUpacara'=>$this->parseData($item->namaUpacara),
                'kategoriYadnya'=>$this->parseData($item->kategoriYadnya),
                'periodeYadnya'=>$this->parseData($item->periodeYadnya)
            ]);
        }
        return view('dashboard.detail',[
            'title'=>'Detail Banten',
            'detailBanten'=>$resultDetailBanten,
            'detailYadnya'=>$resultDetailYadnya
        ]);
    }
    public static function sameAs($data,$index){
        $i = 0;
        $print=[];
        foreach($data as $item){
            $print[$i]=$item[$index];
            $i++;
        } 
        $print = array_unique($print);
        return $print;
    }
}

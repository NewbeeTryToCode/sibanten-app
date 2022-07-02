<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class DashboardController extends Controller
{
    public function dashboard(){
        //query semua data banten dan gambar
        $banten = $this->sparql->query('SELECT ?banten 
            (COALESCE (?gambar,?missing) as ?gambarnull) 
                WHERE{VALUES ?missing {"missing.jpeg"}
                {?banten a banten:Alit} 
                UNION {?banten a banten:Banten} 
                UNION {?banten a banten:Madya}
                UNION {?banten a banten:Utama}
                OPTIONAL{?banten banten:memilikiFoto ?gambar}
        } ORDER BY DESC(?gambarnull)');
        //query semua data banten yang memiliki upacara
        $bantenMemilikiUpacara = $this->sparql->query('SELECT * 
        WHERE { {?banten a banten:Alit} 
            UNION {  ?banten a banten:Madya} 
            UNION {  ?banten a banten:Utama} 
            UNION {  ?banten a banten:Banten} ?banten banten:bantenDari ?upacara}');
        //query semua data upacara yadnya
        $upacara = $this->sparql->query('SELECT (COUNT (?upacara)as ?TotalUpacara)
        WHERE {{?upacara a banten:ManusaYadnya}
            UNION{?upacara a banten:DewaYadnya} 
            UNION{?upacara a banten:BhutaYadnya} 
            UNION{?upacara a banten:RsiYadnya} 
            UNION{?upacara a banten:PitraYadnya}}');

        $result =[];
        $resultBantenUpacara = [];
        $count = 0;
        $countUpacara = $this->parseData($upacara[0]->TotalUpacara->getValue());
        foreach($banten as $b){
            array_push($result,[
                'nama_banten'=>$this->parseData($b->banten->getUri()),
                'gambar'=>$this->parseData($b->gambarnull->getValue()),
                ]);
            $count=$count+1;
        }
        foreach($bantenMemilikiUpacara as $bmu){
            array_push($resultBantenUpacara,[
                'nama_banten'=>$this->parseData($bmu->banten->getUri()),
                'upacara'=>$this->parseData($bmu->upacara->getUri()),
                ]);
        }
        $allUpacara=[];
        foreach($resultBantenUpacara as $item){
            array_push($allUpacara,[
                'data'=> $this->sparql->query('SELECT * WHERE {VALUES ?banten{banten:'.$item['upacara'].'}.?banten rdf:type ?class }')
            ]);
        }
        $dashboardUpacara = [];
        foreach($allUpacara as $item){
            for ($i = 0; $i<count($item['data']); $i++){
                array_push($dashboardUpacara,[
                    'kategoriUpacara' =>$this->parseData($item['data'][$i]->class->getUri()),
                ]);

            }
        }
        //mencari total tiap kategori upacara
        $allDashboardUpacara = [
            'ManusaYadnya'=>0,
            'DewaYadnya'=>0,
            'PitraYadnya'=>0,
            'RsiYadnya'=>0,
            'BhutaYadnya'=>0,
        ];
        $totaTipelUpacara = 0;
        foreach($dashboardUpacara as $item){
            if($item['kategoriUpacara'] =='ManusaYadnya'){
                $allDashboardUpacara['ManusaYadnya'] = $allDashboardUpacara['ManusaYadnya'] +1 ;
                $totaTipelUpacara = $totaTipelUpacara +1 ;
            }
            else if($item['kategoriUpacara'] =='DewaYadnya'){
                $allDashboardUpacara['DewaYadnya'] = $allDashboardUpacara['DewaYadnya'] +1 ;
                $totaTipelUpacara = $totaTipelUpacara +1 ;

            }
            else if($item['kategoriUpacara'] =='RsiYadnya'){
                $allDashboardUpacara['RsiYadnya'] = $allDashboardUpacara['RsiYadnya'] +1 ;
                $totaTipelUpacara = $totaTipelUpacara +1 ;

            }
            else if($item['kategoriUpacara'] =='PitraYadnya'){
                $allDashboardUpacara['PitraYadnya'] = $allDashboardUpacara['PitraYadnya'] +1 ;
                $totaTipelUpacara = $totaTipelUpacara +1 ;

            }
            else if($item['kategoriUpacara'] =='BhutaYadnya'){
                $allDashboardUpacara['BhutaYadnya'] = $allDashboardUpacara['BhutaYadnya'] +1 ;
                $totaTipelUpacara = $totaTipelUpacara +1 ;

            }
        }   

        //pagination

        $databanten = $this->paginate($result)->withQueryString()->withPath('/dashboard');
        return view('dashboard.index',[
            'title'=>'Overview',
            'banten'=>$databanten,
            'count'=>$count,
            'countupacara'=>$countUpacara,
            'tipeUpacara'=>$allDashboardUpacara,
            'totalTipeUpacara'=>$totaTipelUpacara
            ]
        );
    }

    public function index(){
        //query semua data banten dan gambar
        $banten = $this->sparql->query('SELECT ?banten 
        (COALESCE (?gambar,?missing) as ?gambarnull) 
            WHERE{VALUES ?missing {"missing.jpeg"}
            {?banten a banten:Alit} 
            UNION {?banten a banten:Banten} 
            UNION {?banten a banten:Madya}
            UNION {?banten a banten:Utama}
            OPTIONAL{?banten banten:memilikiFoto ?gambar}
        }');
        //query semua data upacara yadnya
        $upacara = $this->sparql->query('SELECT (COUNT (?upacara)as ?TotalUpacara)
        WHERE {{?upacara a banten:ManusaYadnya}
            UNION{?upacara a banten:DewaYadnya} 
            UNION{?upacara a banten:BhutaYadnya} 
            UNION{?upacara a banten:RsiYadnya} 
            UNION{?upacara a banten:PitraYadnya}}');

        $result =[];
        $count = 0;
        $countUpacara = $this->parseData($upacara[0]->TotalUpacara->getValue());
        foreach($banten as $b){
            array_push($result,[
                'nama_banten'=>$this->parseData($b->banten->getUri()),
                'gambar'=>$this->parseData($b->gambarnull->getValue()),
                ]);
            $count=$count+1;
        }
        return view('index',[
            'title'=>'Si Banten - App',
            'banten'=>$result,
            'count'=>$count,
            'countupacara'=>$countUpacara,
            ]
        );
    }

    public function paginate($items,$perPage = 8, $page = null, $options= []){
        $page = $page ?:(Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page,$perPage),$items->count(),$perPage,$page
        ,$options);
    }
    
    
}

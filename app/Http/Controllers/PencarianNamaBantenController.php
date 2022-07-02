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

     // Levenshtein Algorithm
     public static function levenshteinAlgorithm(
        string $str2,
        string $str1,
        int $costIns = 1,
        int $costRep = 1,
        int $costDel = 1
    ) {
        $matrix = [];
        $str1Array = str_split($str1);
        $str2Array = str_split($str2);
        $str1Length = count($str1Array);
        $str2Length = count($str2Array);

        // string(Baris (kesamping) x kolom (atas bawah))
        // untuk baris
        for ($i = 1; $i <= $str1Length; $i++) {
            $matrix[$i][0] = $i * $costDel;
        }
        // untuk kolom
        for ($j = 0; $j <= $str2Length; $j++) {
            $matrix[0][$j] = $j * $costIns;
        }
        $status = [];
        $k = 0;
        $l = $m = $n = $o = 0;

        for ($i = 1; $i <= $str1Length; $i++) {
            for ($j = 1; $j <= $str2Length; $j++) {
                // Data Sama (Disalin)
                if ($str1Array[$i - 1] === $str2Array[$j - 1]) {
                    $matrix[$i][$j] = $matrix[$i - 1][$j - 1];
                    //copy
                }
                // Data berbeda +1 (insert,replace,delete)
                elseif ($str1Array[$i - 1] !== $str2Array[$j - 1]) {
                    $matrix[$i][$j] = min($matrix[$i - 1][$j] + $costIns, $matrix[$i][$j - 1] + $costDel, $matrix[$i - 1][$j - 1] + $costRep);
                }
            }
        }
        $distance=$matrix[$str1Length][$str2Length];

        return $matrix[$str1Length][$str2Length];
    }

    public static function lsdata(
        string $str2,
        string $str1,
        int $costIns = 1,
        int $costRep = 1,
        int $costDel = 1
    ) {
        $matrix = [];
        $str1Array = str_split($str1);
        $str2Array = str_split($str2);
        $str1Length = count($str1Array);
        $str2Length = count($str2Array);

        // string(Baris (kesamping) x kolom (atas bawah))
        // untuk baris
        for ($i = 1; $i <= $str1Length; $i++) {
            $matrix[$i][0] = $i * $costDel;
        }
        // untuk kolom
        for ($j = 0; $j <= $str2Length; $j++) {
            $matrix[0][$j] = $j * $costIns;
        }
        $status = [];
        $k = 0;
        $l = $m = $n = $o = 0;

        for ($i = 1; $i <= $str1Length; $i++) {
            for ($j = 1; $j <= $str2Length; $j++) {
                // Data Sama (Disalin)
                if ($str1Array[$i - 1] === $str2Array[$j - 1]) {
                    $matrix[$i][$j] = $matrix[$i - 1][$j - 1];
                    //copy
                }
                // Data berbeda +1 (insert,replace,delete)
                elseif ($str1Array[$i - 1] !== $str2Array[$j - 1]) {
                    $matrix[$i][$j] = min($matrix[$i - 1][$j] + $costIns, $matrix[$i][$j - 1] + $costDel, $matrix[$i - 1][$j - 1] + $costRep);
                }
            }
        }
        $distance=$matrix[$str1Length][$str2Length];

        // Mengecek Jalur
        $i = $str1Length;
        $j = $str2Length;

        while ( $i >= 1) {
            while ( $j >= 1) {
                // Data Sama (Disalin)
                if ($str1Array[$i - 1] === $str2Array[$j - 1]) {
                    //copy
                    // echo "i = $i, j = $j <br>";
                    $status[$k][0] = $str2Array[$j - 1];
                    $status[$k][1] = "Copy";
                    $status[$k][2] = $str1Array[$i - 1];

                    // echo $str2Array [$j-1];
                    $i = $i - 1;
                    $j = $j - 1;
                    $k++;
                }
                // Data berbeda +1 (insert,replace,delete)
                elseif ($str1Array[$i - 1] !== $str2Array[$j - 1]) {
                    // remove
                    if ($matrix[$i - 1][$j] < $matrix[$i - 1][$j - 1] && $matrix[$i - 1][$j] < $matrix[$i][$j - 1]) {
                        // sebelah kanan
                        $status[$k][0] = " ";
                        $status[$k][1] = "Insert";
                        // sebelah kiri
                        $status[$k][2] = $str1Array[$i - 1];
                        $i = $i - 1;
                        $j = $j;
                        $k++;
                    }
                    // insert
                    elseif ($matrix[$i][$j - 1] < $matrix[$i - 1][$j] && $matrix[$i][$j - 1] < $matrix[$i - 1][$j - 1]) {
                        $status[$k][0] = $str2Array[$j - 1];
                        $status[$k][1] = "Delete";
                        $status[$k][2] = " ";
                        $i = $i;
                        $j = $j - 1;
                        $k++;
                    }
                    //replace
                    elseif ($matrix[$i - 1][$j - 1] < $matrix[$i][$j - 1] && $matrix[$i - 1][$j-1]<$matrix[$i-1][$j]) {
                        $status[$k][0] = $str2Array[$j - 1];
                        $status[$k][1] = "Replace";
                        $status[$k][2] = $str1Array[$i-1];
                        $i = $i - 1;
                        $j = $j - 1;
                        $k++;
                    }
                    else {
                        $status[$k][0] = $str2Array[$j - 1];
                        $status[$k][1] = "Replace";
                        $status[$k][2] = $str1Array[$i-1];
                        $i = $i - 1;
                        $j = $j - 1;
                        $k++;
                    }
                }
            }
        }

        // menampilkan matrix
        // for ($i = 0; $i <= $str1Length; $i++) {
        //     for ($j = 0; $j <= $str2Length; $j++) {
        //         if (isset($matrix[$i][$j])) {
        //             echo $matrix[$i][$j];
        //         }
        //     }
        //     echo "<br>";
        // }
        // dd($matrix, $status, $str1Length,$str1Length, $str1Array, $str2Array);

        $data2=[
            "distance" => $distance,
            "matrix" => $matrix,
            "status" => $status,
        ];

        return $data2;
    }
}


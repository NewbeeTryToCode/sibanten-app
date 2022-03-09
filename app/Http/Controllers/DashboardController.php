<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
            
        return view('dashboard.index',[
            'title'=>'Overview',
            ]
        );
    }
    public function pencarian(){
        return view('dashboard.pencarian',[
            'title'=>'Pencarian'
        ]);
    }
    public function penjelajahan(){
        return view('dashboard.penjelajahan',[
            'title'=>'Penjelajahan'
        ]);
    }
    public function bantens(){
        return view('dashboard.detail',[
            'title'=>'Detail Banten'
        ]);
    }
    
}

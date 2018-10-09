<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

use Redirect;

use App\Product;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::get();
        //dd($data);
        //return response()->json($cities);
        return view('home')->with('product',$product);
        //return view('home');
    }
   
   
    public function getPosts()
    {
       // return \DataTables::of(Product::query())->make(true);
        $item = Product::with('photo')->get();
        //print_r($item);exit;
        return Datatables::of($item)
                ->addColumn('action', function ($item) {
                return '<a href="/product/'.$item->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                   <a  href="jsvascript:void(0);" class="btn-delete btn btn-xs btn-danger" data-remote="/product/' . $item->id . '"><i class="glyphicon glyphicon-remove"></i> Delete </a><meta name="csrf-token" content="'.@csrf_token().'">';
        })
        ->addColumn('image', function ($item) {
            return '<img src="product_images/'.$item->photo['photo'].'" height="100" width="100" align="center" />';
        })
        ->rawColumns(['image','action'])
        ->make(true);
        
    }
    
}

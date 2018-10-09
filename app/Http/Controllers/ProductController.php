<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Redirect;
//use DataTables;
use App\Product;
use App\User;
use App\Photo;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $products = new Product(); 
        return view('add_product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductRequest $request)
    {
      dd($request);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
      //dd($request->all());
      
      //echo '<pre>'; print_r($request->file('photo'));
      //echo $file->getClientOriginalName();exit;
      $timestamp = now()->timestamp;
      $data=array('name' => $request['name'],'qty' => $request['qty']);
      $product= new Product();
      $product->name= $request['name'];
      $product->qty= $request['qty'];
      
       
      // add other fields
      $product->save();
      
      $photo= new Photo();
      
      $destinationPath = 'product_images';
      if($request->file('photo'))
      { 
        $file = $request->file('photo');
        $photo->photo = time().'-'.$file->getClientOriginalName();
        $photo->pro_id = $product->id;
        
        $photo->save();
        $file->move($destinationPath,$photo->photo);
      }
      
      
      return redirect('/home');
      //dd($data);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->get(['id','name','qty'])->toArray();
        
        return view('add_product')->with('product',$product);
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $photo = Product::with('photo')->where('id',$product->id)->get()->first()->toArray();
        return view('add_product')->with('product',$photo);
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        //
     // dd( request()->segment(2));
       $product->update($request->all());
       $photo= new Photo();
      
        $destinationPath = 'product_images';
        if($request->file('photo'))
        { 
          $photo1 = Photo::where('pro_id', '=', request()->segment(2));
          $photo1->delete();
          if($request->old_photo){
            unlink($destinationPath.'/'.$request->old_photo);
          }
          
          $file = $request->file('photo');
          $photo->photo = time().'-'.$file->getClientOriginalName();
          $photo->pro_id = request()->segment(2);
          $photo->save();
          $file->move($destinationPath,$photo->photo);
        }
       
       return redirect('/home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Product::destroy($id);
    }
}

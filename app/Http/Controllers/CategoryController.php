<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category= Category::all();

        return view ('Category.allCategory',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Category.addCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create($request->all());
        Session::put('message', 'Success!');
        return redirect('/category');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        $cat= Category::find($category);

        return view('Category.editCategory',compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit( $category)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $category)
    {
        $category=Category::findOrFail($category);
        $input=$request->all();
        $category->update($input);
        Session::put('message', 'Success!');
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::findOrFail($id);
        $category->delete();
        Session::put('message', 'Success!');
        return redirect()->back();

    }

    public function createReport(Request $request){

        $cat =  DB::select('select c.name,c.description,count(catID) as count  from categories c , products p where p.catID = c.id group by p.catID ');

        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('cat',$cat);


        $pdf =  PDF::loadView('Category.categoryReport',$cat);

        // // download PDF file with download method
        return $pdf->stream('categories.pdf');
        return view('Category.categoryReport',compact('cat'));
    }
}

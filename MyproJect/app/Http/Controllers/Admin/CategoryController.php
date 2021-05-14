<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        //Method GET
        $data = [];
        $categories = Category::get();
        $data['categories'] = $categories;
        // dd($categories);
        return view('admin.categories.index', $data);
    }
    public function create()
    {
        //Method GET
        $data = [];
        return view('admin.categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Method: POST
        // dd($request->all());
        // insert to DB
        $categoryInsert = [
            'name' => $request->category_name
        ];
        DB::beginTransaction();
        try {
            Category::create($categoryInsert);
            // insert into data to table category (successful)
            DB::commit();
            return redirect()->route('admin.category.index')->with('sucess', 'Insert into data to Category Sucessful.');
        } catch (\Exception $ex) {
            // insert into data to table category (fail)
            DB::rollBack();
            Log::error($ex->getMessage());
            return redirect()->back()->with('error', $ex->getMessage());
        }
        // $news = new Category;
        // $news->name = $request->category_name; 
        // $news->save();
        // // return redirect()->action([CategoryController::class, 'create']);
        // $data = [];
        // $categories = Category::get();
        // $data['categories'] = $categories;
        // // dd($categories);
        // return view('categories.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Method GET
        $data = [];
        $categories = Category::get()->where('id', '=', $id);
        $data['categories'] = $categories;
        // dd($categories);
        return view('admin.categories.detail', $data);
        // $data = [];
        // $categories = Category::where('id', '=', $id)->select('*')->first();
        // $data['categories'] = $categories;
        // return view('categories.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Method GET
        $data = [];
        $category = Category::findOrFail($id);
        $data['category'] = $category;
        return view('admin.categories.edit', $data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, $id)
    {
       
        //cách 1:
        DB::beginTransaction();
        try{
            $category = Category::find($id);
            $category->name = $request->category_name;
            $category->save();

            DB::commit();
            return redirect()->route('admin.category.index')->with('success','Insert Category successful!');
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Method DELETE
        // dd('toi day');
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            $category->delete();
            DB::commit();
            return redirect()->route('category.index')
                ->with('success', 'Delete Category successful!');
        }  catch (\Exception $ex) {
            DB::rollBack();
            // have error so will show error message
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}

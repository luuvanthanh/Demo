<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use File;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = [];
        // get list data of table posts
        $posts = Post::with('category');
        //     ->where('category_id', $request->category_id)
        //     ->get();
        // if ($request->category_id==null) {
        //     $posts = Post::query()->where('name', 'like',"%{$request->name}%")->paginate(2);
        // }
        //search post name
        if(!empty($request->name)){
            $posts = $posts->where('name', 'like', '%' . $request->name . '%');
        }
        //search category_id
        if(!empty($request->category_id)){
            $posts = $posts->where('category_id', 'like', '%' . $request->category_id . '%');
        }
        //pagination
        $posts = $posts->paginate(2);
        // dd($posts->count());
        // get list data of table categories
        $categories = Category::pluck('name', 'id')
            ->toArray();                                                                                                                                                               
        $data['categories'] = $categories;
        // dd($posts);
        $data['posts'] = $posts;
        return view('posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $data = [];
        // $categories = Category::get();
        // có thể dùng cách get trên
        $categories = Category::pluck('name', 'id')->toArray();
        // dd($categories);
        $data['categories'] = $categories;
        return view('posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
      

        // $postInsert = [
        //     'name' => $request->name,
        //     'thumbnail' => $request->thumbnail,
        //     'category_id' => $request->category_id
        // ];
        // DB::beginTransaction();//mở lệnh
        // try {
        //     Post::create($postInsert);
        //     // insert into data to table category (successful)
        //     DB::commit();//nạp dữ liệu ok thì thực hiện bước này còn sai thì nhảy thông báo
        //     return redirect()->route('post.index')->with('success', 'Insert into data to Post Sucessful.');
        //     // with tạo ra session
        // } catch (\Exception $ex) {
        //     // insert into data to table category (fail)
        //     DB::rollBack();
        //     Log::error($ex->getMessage());
        //     return redirect()->back()->with('error', $ex->getMessage());
        // }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail') 
        && $request->file('thumbnail')->isValid()) {
        // Nếu có thì thục hiện lưu trữ file vào public/images
        $image = $request->file('thumbnail');
        $extension = $request->thumbnail->extension();
        $fileName = 'thumbnail_' . time() . '.' . $extension;
        $thumbnailPath = $image->move('thumbnail', $fileName);
    }

        $dataInsert = [
            'name' => $request->name,
            'thumbnail' => $thumbnailPath,
            'category_id' => $request->category_id,
            'status' => $request->status
        ];
        
        DB::beginTransaction();
        // dd($dataInsert);
        try {
            $post = Post::create($dataInsert);
            $postDetail = new PostDetail([
                'content' => $request->content
            ]);
            $post->post_detail()->save($postDetail);
            DB::commit();

            // success
            return redirect()->route('post.index')->with('success', 'Insert successful!');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
        }







    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = [];
        $posts = Post::get()->where('id', '=', $id);
        $data['posts'] = $posts;
        // dd($categories);
        return view('posts.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = [];
        $categories = Category::pluck('name', 'id')
            ->toArray();
        $post = Post::find($id); // case 1
        // $post = Post::findOrFail($id); // case 2
        $data['post'] = $post;
        $data['categories'] = $categories;
        return view('posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        //
     
        $post = Post::find($id);
        $postDetailId = $post->post_detail ? $post->post_detail->id : null;
        $thumbnailOld = $post->thumbnail;

        // update data for table posts
        $post->name = $request->name;
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail') 
            && $request->file('thumbnail')->isValid()) {
            // Nếu có thì thục hiện lưu trữ file vào public/thumbnail
            $image = $request->file('thumbnail');
            $extension = $request->thumbnail->extension();
            $fileName = 'thumbnail_' . time() . '.' . $extension;
            $thumbnailPath = $image->move('thumbnail', $fileName);
            $post->thumbnail = $thumbnailPath;
            Log::info('thumbnailPath: ' . $thumbnailPath);
        }
        DB::beginTransaction();

        try {
            // update data for table posts
            $post->save();
            
            $dataDetailPost = [
                'content' => $request->content,
                'post_id' => $id,
            ];

            // create or update data for table post_details
            if (!$postDetailId) { // create
                $postDetail = new PostDetail($dataDetailPost);
                $postDetail->save();
            } else { // update
                PostDetail::find($postDetailId)
                    ->update($dataDetailPost);
            }
            
            DB::commit();
            
            // SAVE OK then delete OLD file
            if (File::exists(public_path($thumbnailOld))) {
                File::delete(public_path($thumbnailOld));
                
            }

            // success
            return redirect()->route('post.index')->with('success', 'Update successful!');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
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
        //
        DB::beginTransaction();
    
        try {
            $post = Post::find($id);
            $post->delete();

            DB::commit();

            return redirect()->route('posts.index')
                ->with('success', 'Delete Post successful!');
        }  catch (\Exception $ex) {
            DB::rollBack();
            // have error so will show error message
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}

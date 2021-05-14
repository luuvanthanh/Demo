<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $users = User::get();
        $data['users'] = $users;
        
        // dd($users);
        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userInsert = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ];
        // dd($userInsert);
        DB::beginTransaction();
        try {
            User::create($userInsert);
            // insert into data to table category (successful)
            DB::commit();
            return redirect()->route('user.index')->with('sucess', 'Insert into data to Category Sucessful.');
        } catch (\Exception $ex) {
            // insert into data to table category (fail)
            DB::rollBack();
            Log::error($ex->getMessage());
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
        $data = [];
        $users = User::get()->where('id', '=', $id);
        $data['users'] = $users;
        // dd($categories);
        return view('users.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $users = User::findOrFail($id);
        $data['users'] = $users;
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        DB::beginTransaction();
        try{
            $users = user::find($id);
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = $request->password;
            $users->save();

            DB::commit();
            return redirect()->route('user.index')->with('success','Insert Category successful!');
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
        DB::beginTransaction();
        try {
            $users = User::find($id);
            $users->delete();
            DB::commit();
            return redirect()->route('user.index')
                ->with('success', 'Delete user successful!');
        }  catch (\Exception $ex) {
            DB::rollBack();
            // have error so will show error message
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}

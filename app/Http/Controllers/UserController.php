<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categories;
class UserController extends Controller
{
    public $is_user_page =true;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderby('id','ASC')->get();
        return view('user.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        $user = User::find($id);
        return view('user.index',[
            'user' => $user,
            'is_user_page' => $this->is_user_page
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        // $data = $request-> all();
        // dd($data);
        $user = User::find($id);
        $user->name = $request['tennguoidung'];
        $user->sAdress = $request['diachi'];
        $user->dBirthday = $request['ngaysinh'];
        $user->sGender = $request['gioitinh'];
        $user->save();

        return redirect()->back()->with('status','Cập nhật thông tin cá nhân thành công');
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
    }

    public function admin($id)
    {
        $user = User::find($id);
        $cats = Categories::orderby('id','ASC')->get();
        return view('admincp.admin_page.adminpage',[
            'isadmin' => true,
            'user' => $user,
            'cats' => $cats
        ]);
    }
}
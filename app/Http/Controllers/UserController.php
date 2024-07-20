<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bill;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public $is_user_page = true;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderby('id', 'ASC')->get();
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
        $bills = Bill::where('idUser', $id)->get();
        return view('user.index', [
            'user' => $user,
            'is_user_page' => $this->is_user_page,
            'bills' => $bills
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
        // 
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

        $data = $request->validate(
            [
                'tennguoidung' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($id),],
                'diachi' => ['max:255'],
                'ngaysinh' => ['nullable', 'date'],
                'gioitinh' => ['in:nam,nữ', 'nullable'],
            ],
            [
                'tennguoidung.required' => 'Tên người dùng không được để trống',
                'tennguoidung.string' => 'Tên người dùng phải là các ký tự',
                'tennguoidung.max' => 'Tên người dùng không được nhiều hơn 255 ký tự',
                'tennguoidung.unique' => 'Tên người dùng đã được sử dụng',

                'diachi.max' => 'Địa chỉ không được nhiều hơn 255 ký tự',

                'ngaysinh.date' => 'Ngày sinh không hợp lệ',

                'gioitinh.in' => 'Giới tính chỉ chấp nhân nam hoặc nữ',
            ]
        );

        // dd($data);
        $user = User::find($id);
        $user->name = $data['tennguoidung'];
        $user->sAdress = $data['diachi'];
        $user->dBirthday = $data['ngaysinh'];
        $user->sGender = $data['gioitinh'];

        $user->save();

        return response()->json([
            'message' => 'Cập nhật thông tin cá nhân thành công',
            'status' => 1
        ]);
    }

    public function update_anhdaidien(Request $request, $id)
    {

        $request->validate(
            [
                'anhdaidien' => ['image', 'max:4096'],
            ],
            [
                'anhdaidien.image' => 'File bạn vừa upload không phải là hình ảnh',
                'anhdaidien.max' => 'File ảnh bạn upload phải < 4mb',
            ]
        );

        $send = [
            'avatar_change_status' => ''
        ];

        $file = $request->file("anhdaidien");
        $user = User::find($id);

        if ($file) {
            $destination = "uploads/user_av";
            $filename = 'time_' . time() . '_file_' . $file->getClientOriginalName();
            if ($file->move($destination, $filename)) {
                $send = [
                    'avatar_change' => 'Cập nhật Avatar thành công',
                    'avatar_change_status' => 1,
                    'av_link' => url($destination . '/' . $filename)
                ];
                $user->sAvatar = $filename;
            } else {
                $send = [
                    'avatar_change' => 'Cập nhật Avatar thất bại',
                    'avatar_change_status' => 0
                ];
            }
        }

        $user->save();

        return response()->json([
            'status' => 1,
            'av_update' => $send,
        ]);
    }

    public function save_user_setting(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 0,
                'errors' => 'Bạn chưa đăng nhập',
            ]);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 0,
                'errors' => 'Không tìm thấy người dùng',
            ]);
        }

        if(Auth::user()->id == $id) {
            $ntp_font = $request['ntp_font'];
            $ntp_mode = $request['ntp_mode'];
            
            $data = array(
                'ntp_font' => $ntp_font,
                'ntp_mode' => $ntp_mode
            );
            
            $json_data = json_encode($data);
            $user->sSetup = $json_data;
            $user->save();
            return response()->json([
                'status' => 1,
                'message' => 'Cài đặt thành công',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'errors' => 'Bạn không có quyền thay đổi cho nguòi dùng này',
            ]);
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
    }

    public function admin($id)
    {
        $user = User::find($id);
        return view('admincp.admin_page.adminpage', [
            'isadmin' => true,
            'user' => $user,
        ]);
    }
}

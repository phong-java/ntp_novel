<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Author;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->validate(
            [
                'butdanh' => ['required', 'string', 'max:100', Rule::unique('tblauthor', 'sNickName'),],
                'mota' => ['required', 'string', 'max:3000'],
                'nganhang' => ['required'],
                'maso_nganhhang'=>['required','string','max:20',],
                'camket' => ['file', 'mimes:pdf', 'max:10240'],
                'cccd' => ['required','file', 'mimes:pdf', 'max:10240'],
                'id_user' => ['required',Rule::unique('tblauthor', 'idUser')]
            ],
            [
                'butdanh.required' => 'Bút danh không được để trống',
                'butdanh.max' => 'Bút danh không được dài quá 100 ký tự',
                'butdanh.unique' => 'Bút danh đã được sử dụng',

                'mota.required' => 'Mô tả không được để trống',
                'mota.max' => 'Mô tả không được dài quá 3000 ký tự',

                'nganhang.required' => 'Ngân hàng không được để trống',

                'maso_nganhhang.required' => 'Mã số ngân hàng khong được bỏ trống',

                'camket.file' => 'Tệp cam kết phải là tệp hợp lệ',
                'camket.mimes' => 'Tệp cam kết phải là tệp PDF',
                'camket.max' => 'Tệp cam kết không được vượt quá 10MB',

                'cccd.file' => 'Tệp ảnh CCCD phải là tệp hợp lệ',
                'cccd.mimes' => 'Tệp ảnh CCCD phải là tệp PDF',
                'cccd.required' => 'Tệp ảnh CCCD không được để trống',
                'cccd.max' => 'Tệp ảnh CCCD không được vượt quá 10MB',

                'id_user.required' => 'Mã người dùng không có hãy chắc rằng bạn đã đăng nhập nếu không hãy reload lại trang',
            ]
        );
        $file = $request->file("camket");
        $file_cccd = $request->file("cccd");

        $author = new Author();
        $user = User::find($data['id_user']);
        
        $author->sNickName = $data['butdanh'];
        $author->sDes = $data['mota'];
        $author->idUser = $data['id_user'];
        $author->sBankAccountNumber = $data['maso_nganhhang'];
        $author->sBank = $data['nganhang'];
        
        if ($user->sRole == 'admin') {
            $author->iStatus = 1;
        } else {
            $author->iStatus = 0;
        }

        $destination = "uploads/camket";
        $destination_cccd = "uploads/cccd";

        if($file_cccd) {
            $filename_cccd = 'time_'.time().'_file_'.$file_cccd->getClientOriginalName();
            if ($file_cccd->move($destination_cccd, $filename_cccd)) {
                $author->sImg_identity = $filename_cccd;
            }
        }

        if($file) {
            $filename = 'time_'.time().'_file_'.$file->getClientOriginalName();
            if ($file->move($destination, $filename)) {
                $author->sCommit = $filename;
            }
        }

        $author->save();

        return response()->json([
            'message' => 'xin cấp quyền thành công hãy đợi quản trị viên xét duyệt ( quá trình mất 2 -3 ngày)',
            'status' =>1,
            'file' => url($destination.'/'.$author->sCommit),
            'file' => url($destination_cccd.'/'.$author->sImg_identity)
        ]);
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
        $author = Author::where('idUser',$user->id)->first();
        $is_author_page = true;
        return view('author.authorpage',[
            'user' => $user,
            'author' => $author,
            'author_found' => $author ? 1:0,
            'is_author_page' => $is_author_page
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
        $author = Author::find($id);
        return view('admincp.admin_page.admin_chitiet_tacgia')->with(compact('author'));
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
        $author = Author::find($id);
        
        $data = $request->validate(
            [
                'butdanh' => ['required', 'string', 'max:100', Rule::unique('tblauthor', 'sNickName')->ignore($id,'id'),],
                'mota' => ['required', 'string', 'max:3000'],
                'nganhang' => ['required'],
                'maso_nganhhang'=>['required','string','max:20'],
                'id_user' => ['required',Rule::unique('tblauthor', 'idUser')->ignore($id,'id')],
                'camket' => ['file', 'mimes:pdf', 'max:10240'],
                'cccd' => ['file', 'mimes:pdf', 'max:10240']
            ],
            [
                'butdanh.required' => 'Bút danh không được để trống',
                'butdanh.max' => 'Bút danh không được dài quá 100 ký tự',
                'butdanh.unique' => 'Bút danh đã được sử dụng',

                'mota.required' => 'Mô tả không được để trống',
                'mota.max' => 'Mô tả không được dài quá 3000 ký tự',

                'nganhang.required' => 'Ngân hàng không được để trống',

                'maso_nganhhang.required' => 'Mã số ngân hàng khong được bỏ trống',

                'id_user.required' => 'Mã người dùng không có hãy chắc rằng bạn đã đăng nhập nếu không hãy reload lại trang',

                'camket.file' => 'Tệp cam kết phải là tệp hợp lệ',
                'camket.mimes' => 'Tệp cam kết phải là tệp PDF',
                'camket.max' => 'Tệp cam kết không được vượt quá 10MB',

                'cccd.file' => 'Tệp ảnh CCCD phải là tệp hợp lệ',
                'cccd.mimes' => 'Tệp ảnh CCCD phải là tệp PDF',
                'cccd.max' => 'Tệp ảnh CCCD không được vượt quá 10MB'
            ]
        );

        $file = $request->file("camket");
        $file_cccd = $request->file("cccd");

        $user = User::find($data['id_user']);

        $author->sNickName = $data['butdanh'];
        $author->sDes = $data['mota'];
        $author->idUser = $data['id_user'];
        $author->sBankAccountNumber = $data['maso_nganhhang'];
        $author->sBank = $data['nganhang'];

        if($author->iStatus != 1) {
            $author->iStatus = 0;
        }
        

        if ($user->sRole == 'admin') {
            $author->iStatus = 1;   
        }
        
        $destination = "uploads/camket";
        $destination_cccd = "uploads/cccd";

        if($file) {
            $filename = 'time_'.time().'_file_'.$file->getClientOriginalName();
            if ($file->move($destination, $filename)) {
                $author->sCommit = $filename;
            }
        }

        if($file_cccd) {
            $filename_cccd = 'time_'.time().'_file_'.$file_cccd->getClientOriginalName();
            if ($file_cccd->move($destination_cccd, $filename_cccd)) {
                $author->sImg_identity = $filename_cccd;
            }
        }
        $author->save();

        return response()->json([
            'message' => ' cập nhật thông tin xin cấp quyền thành công hãy tiếp tục đợi đợi quản trị viên xét duyệt ( quá trình mất 2 -3 ngày)',
            'status' =>1,
            'file' => url($destination.'/'.$author->sCommit),
            'file_cccd' => url($destination_cccd.'/'.$author->sImg_identity),
            'author_found' => $author ? 1:0
        ]);
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

    public function xetduyet(Request $request,$id) {
        $author = Author::find($id);
        $author->iStatus = $request['xuly'];
        if ($request['xuly'] == 1) {
            $user = User::find($author->idUser);
            $user->sRole = 'author';
            $user->save();
        }  
       
        $author->save();
        return response()->json([
            'message' => 'Xử lý thông tin xin cấp quyền thành công',
            'status' =>1
        ]);
    }

    public function danhsach_xetduyet() {
        return view('admincp.admin_page.admin_xetduyet_tacgia');
    }
}

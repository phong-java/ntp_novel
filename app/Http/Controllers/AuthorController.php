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
                'nganhang' => ['required','in:VCB,VTB,TCB,BIDV,TPB,AGB'],
                'maso_nganhhang'=>['required','string','max:20',],
                'camket' =>['required'],
                'id_user' => ['required',Rule::unique('tblauthor', 'idUser')]
            ],
            [
                'butdanh.required' => 'Bút danh không được để trống',
                'butdanh.max' => 'Bút danh không được dài quá 100 ký tự',
                'butdanh.unique' => 'Bút danh đã được sử dụng',

                'mota.required' => 'Mô tả không được để trống',
                'mota.max' => 'Mô tả không được dài quá 3000 ký tự',

                'nganhang.required' => 'Ngân hàng không được để trống',
                'nganhang.in' => 'Ngân hàng bạn chọn không có trong danh sách',

                'maso_nganhhang.required' => 'Mã số ngân hàng khong được bỏ trống',

                'camket.required' => 'Cam kết không được để trống',

                'id_user.required' => 'Mã người dùng không có hãy chắc rằng bạn đã đăng nhập nếu không hãy reload lại trang',
            ]
        );
        $file = $request->file("camket");

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
            'file' => url($destination.'/'.$author->sCommit)
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
                'nganhang' => ['required','in:VCB,VTB,TCB,BIDV,TPB,AGB'],
                'maso_nganhhang'=>['required','string','max:20'],
                'id_user' => ['required',Rule::unique('tblauthor', 'idUser')->ignore($id,'id')],
                'camket' => ['file', 'mimes:pdf', 'max:10240']
            ],
            [
                'butdanh.required' => 'Bút danh không được để trống',
                'butdanh.max' => 'Bút danh không được dài quá 100 ký tự',
                'butdanh.unique' => 'Bút danh đã được sử dụng',

                'mota.required' => 'Mô tả không được để trống',
                'mota.max' => 'Mô tả không được dài quá 3000 ký tự',

                'nganhang.required' => 'Ngân hàng không được để trống',
                'nganhang.in' => 'Ngân hàng bạn chọn không có trong danh sách',

                'maso_nganhhang.required' => 'Mã số ngân hàng khong được bỏ trống',

                'id_user.required' => 'Mã người dùng không có hãy chắc rằng bạn đã đăng nhập nếu không hãy reload lại trang',

                'camket.file' => 'Tệp cam kết phải là tệp hợp lệ',
                'camket.mimes' => 'Tệp cam kết phải là tệp PDF',
                'camket.max' => 'Tệp cam kết không được vượt quá 10MB'
            ]
        );

        $file = $request->file("camket");
        $user = User::find($data['id_user']);

        $author->sNickName = $data['butdanh'];
        $author->sDes = $data['mota'];
        $author->idUser = $data['id_user'];
        $author->sBankAccountNumber = $data['maso_nganhhang'];
        $author->sBank = $data['nganhang'];
        if ($user->sRole == 'admin') {
            $author->iStatus = 1;   
        }
        
        $destination = "uploads/camket";

        if($file) {
            $filename = 'time_'.time().'_file_'.$file->getClientOriginalName();
            if ($file->move($destination, $filename)) {
                $author->sCommit = $filename;
            }
        }

        $author->save();

        return response()->json([
            'message' => ' cập nhật thông tin xin cấp quyền thành công hãy tiếp tục đợi đợi quản trị viên xét duyệt ( quá trình mất 2 -3 ngày)',
            'status' =>1,
            'file' => url($destination.'/'.$author->sCommit),
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
        $author->iStatus = $request['vuly'];
        if ($request['vuly'] == 1) {
            $user = User::find($author->idUser);
            $user->sRole = 'author';
            $user->save();
        }  
       
        $author->save();
        return response()->json([
            'message' => ' cập nhật thông tin xin cấp quyền thành công',
            'status' =>1
        ]);
    }

    public function danhsach_xetduyet() {
        return view('admincp.admin_page.admin_xetduyet_tacgia');
    }
}

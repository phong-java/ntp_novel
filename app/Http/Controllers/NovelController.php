<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Novel;
use App\Models\Categories;
use App\Models\Chapter;
use App\Models\Classify;
use Illuminate\Support\Facades\Auth;

class NovelController extends Controller
{
    public $isSingle = true;

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
        if (Auth::check()) {
            $id = Auth::user()->id;
            $data = $request->validate(
                [
                    'anhbia' => ['required', 'image', 'max:4096'],
                    'tentruyen' => ['required', 'string', 'max:255'],
                    'motatruyen' => ['required'],
                    'tiendo' => ['required', 'in:1,2,3'],
                    'theloai' => ['required']
                ],
                [
                    'tentruyen.required' => 'Tên truyện không được để trống',
                    'tentruyen.string' => 'Tên truyện phải là các ký tự',
                    'tentruyen.max' => 'Tên truyện không được nhiều hơn 255 ký tự',
    
                    'anhbia.required' => 'Ảnh bìa truyện không được để trống',
                    'anhbia.image' => 'Ảnh bìa truyện không đúng định dạng',
                    'anhbia.max' => 'Ảnh bìa truyện phải nhở hơn 4mb',
    
                    'motatruyen.required' => 'Mô tả truyện không được để trống',
    
                    'tiendo.required' => 'Tiến độ không được để trống',

                    'theloai.required' => 'Thể loại không được để trống'
                ]
            );
    
            $user = User::find($id);
            $novel = new Novel();
            $cats = Categories::orderby('id', 'ASC')->get();
            $catIds = $cats->pluck('id')->toArray();

            $theloai = $data['theloai'];
            $invalidTheloai = array_diff($theloai, $catIds);
            
            if (!empty($invalidTheloai)) {
                return response()->json([
                    'errors' => ['theloai' => 'Có thể loại không hợp lệ'],
                    'status' => 0
                ]);
            }
    
            if($user) {
                if($user['sRole'] != 'user') {
                    $file = $request->file("anhbia");
            
                    if($file) {
                        $destination = "uploads/images";
                        $filename = 'time_'.time().'_file_'.$file->getClientOriginalName();
                        if ($file->move($destination, $filename)) {
                            $novel->sCover = $filename;
                        }
                    }
    
                    
                    $novel->sNovel = $data['tentruyen'];
                    $novel->sDes = htmlspecialchars($data['motatruyen']);
                    $novel->sProgress = $data['tiendo'];
                    $novel->idUser = $id;
    
                    $novel->save();

                    

                    foreach ($data['theloai'] as $id) {
                        $clasifi = new Classify();
                        $clasifi->idNovel = $novel->id;
                        $clasifi->idCategories = $id;

                        $clasifi->save();
                    }

                    return response()->json([
                        'message' => 'Thêm truyện thành công',
                        'status' => 1
                    ]);

                } else {
                    return response()->json([
                        'errors' => ['Nguoidung_quyen' => 'Bạn không có quyền thêm truyện'],
                        'status' => 1
                    ]);
                }
    
            } else {
                return response()->json([
                    'errors' => ['Nguoidung' => 'Không tìm thấy người dùng'],
                    'status' => 1
                ]);
            }

            dd($data['theloai']);
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Không tìm thấy người dùng'],
                'status' => 1
            ]);
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
        
        return view('single.single_page',[
            'isSingle' => $this->isSingle
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
    public function update(Request $request, $idnovel)
    {
        if (Auth::check()) {
            
            $data = $request->validate(
                [
                    'anhbia' => ['nullable', 'image', 'max:4096'],
                    'tentruyen' => ['required', 'string', 'max:255'],
                    'motatruyen' => ['required'],
                    'tiendo' => ['required', 'in:1,2,3'],
                    'theloai' => ['required']
                ],
                [
                    'tentruyen.required' => 'Tên truyện không được để trống',
                    'tentruyen.string' => 'Tên truyện phải là các ký tự',
                    'tentruyen.max' => 'Tên truyện không được nhiều hơn 255 ký tự',
    
                    'anhbia.image' => 'Ảnh bìa truyện không đúng định dạng',
                    'anhbia.max' => 'Ảnh bìa truyện phải nhở hơn 4mb',
    
                    'motatruyen.required' => 'Mô tả truyện không được để trống',
    
                    'tiendo.required' => 'Tiến độ không được để trống',

                    'theloai.required' => 'Thể loại không được để trống'
                ]
            );

            $iduser = Auth::user()->id;
            $user = User::find($iduser);
            
            $novel = Novel::find($idnovel);

            $cats = Categories::orderby('id', 'ASC')->get();
            $catIds = $cats->pluck('id')->toArray();

            $theloai = $data['theloai'];
            $invalidTheloai = array_diff($theloai, $catIds);
            
            if (!empty($invalidTheloai)) {
                return response()->json([
                    'errors' => ['theloai' => 'Có thể loại không hợp lệ'],
                    'status' => 0
                ]);
            }
    
            if($user) {
                if($user['sRole'] != 'user') {
                    
                    if ($novel->idUser !==  $iduser) {
                        return response()->json([
                            'errors' => ['Nguoidung_quyen' => 'Bạn không có quyền cập nhật truyện này'],
                            'status' => 0
                        ]);
                    }

                    $file = $request->file("anhbia");
            
                    if($file) {
                        $destination = "uploads/images";
                        $filename = 'time_'.time().'_file_'.$file->getClientOriginalName();
                        if ($file->move($destination, $filename)) {
                            $novel->sCover = $filename;
                        }
                    }
    
                    
                    $novel->sNovel = $data['tentruyen'];
                    $novel->sDes = htmlspecialchars($data['motatruyen']);
                    $novel->sProgress = $data['tiendo'];
    
                    $novel->save();

                    
                    Classify::where('idNovel', $idnovel)->delete();

                    foreach ($data['theloai'] as $id_cat) {
                        $clasifi = new Classify();
                        $clasifi->idNovel = $idnovel;
                        $clasifi->idCategories = $id_cat;

                        $clasifi->save();
                    }

                    return response()->json([
                        'message' => 'Cập nhật truyện thành công',
                        'status' => 1
                    ]);

                } else {
                    return response()->json([
                        'errors' => ['Nguoidung_quyen' => 'Bạn không có quyền cập nhật truyện này'],
                        'status' => 1
                    ]);
                }
    
            } else {
                return response()->json([
                    'errors' => ['Nguoidung' => 'Không tìm thấy người dùng'],
                    'status' => 0
                ]);
            }

            dd($data['theloai']);
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Không tìm thấy người dùng'],
                'status' => 0
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

    public function Danh_sachtruyen_tacgia()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $novels = Novel::orderBy('id', 'DESC')->where('idUser',$id)->get();
            return view('author.novel.novel_list', [
                'novels' => $novels,
            ]);

        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Không tìm thấy người dùng'],
                'status' => 1
            ]);
        }
    }

    public function quan_ly_truyen($id)
    {
        $novel = Novel::find($id);
        $chapters = Chapter::orderBy('id', 'DESC')->where('idNovel',$id)->get();
        $theloai = Classify::orderby('id', 'ASC')->where('idNovel',$id)->get();
        return view('author.novel.novel_index',[
           'novel' =>$novel,
           'chapters' => $chapters,
           'theloai' => $theloai
        ]);
    }
}

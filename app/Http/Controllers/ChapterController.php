<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Novel;
use App\Models\Categories;
use App\Models\Classify;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;

class ChapterController extends Controller
{
    public $is_chapter_page = true;
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

            $data = $request->validate(
                [
                    'tenchuong' => ['required', 'string', 'max:255',Rule::unique('tblchapter', 'sChapter')->where(function ($query) use ($request) {
                        return $query->where('idNovel', $request->idNovel);
                    }),],
                    'noidungchuong' => ['required'],
                    'tinhphi' => ['in:1,0'],
                    'tinhtrang' => ['required', 'in:1,0'],
                    'idNovel' => ['required'],
                    'giatien' => ['integer', 'min:1']
                ],
                [
                    'tenchuong.required' => 'Tên chương không được để trống',
                    'tenchuong.string' => 'Tên chương phải là các ký tự',
                    'tenchuong.max' => 'Tên chương không được nhiều hơn 255 ký tự',
                    'tenchuong.unique' => 'Tên chương đã tồn tại trong truyện này',

                    'noidungchuong.required' => 'Nội dung chương không được để trống',

                    'tinhtrang.in' => 'Tình trạng bạn chọn không tồn tại',

                    'tinhphi.in' => 'lựa chọn tính phí bạn chọn không tồn tại',
                    'idNovel.required' => 'Mã truyện không được bỏ trống hãy load lại page để load mã truyện',

                    'giatien.integer' => 'Giá tiền phải là một giá trị số',
                    'giatien.min' => 'Giá trị nhỏ nhất của giá tiền là 1'
                ]
            );

            $maxChapter = Chapter::where('idNovel', $data['idNovel'])
                                    ->orderBy('iChapterNumber', 'DESC')
                                    ->first();

            if ($maxChapter) {
                $iChapterNumber = $maxChapter->iChapterNumber + 1;
            } else {
                $iChapterNumber = 1;
            }
            
            $chapter = new Chapter();
            $chapter->sChapter =  $data['tenchuong'];
            $chapter->iChapterNumber =  $iChapterNumber;
            $chapter->sContent =  $data['noidungchuong'];
            $chapter->iPublishingStatus =  0;

            $chapter->iStatus =  $data['tinhtrang'];
            $chapter->idNovel =  $data['idNovel'];

            if(isset($data['tinhphi'])) {
                $chapter->icharges =  $data['tinhphi'];

                if ($data['giatien'] <= 0) {
                    $chapter->iPrice =  1;
                } else {
                    $chapter->iPrice =  $data['giatien'];
                }
            }

            $chapter->save();

            return response()->json([
                'message' => 'Thêm chương truyện thành công',
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
        $chapter = Chapter::find($id);
        $novel = Novel::find($chapter->idNovel);

        $previousChapter = Chapter::where('idNovel', $chapter->idNovel)
            ->where('iChapterNumber', '<', $chapter->iChapterNumber)
            ->orderBy('iChapterNumber', 'DESC')
            ->first();


        $nextChapter = Chapter::where('idNovel', $chapter->idNovel)
            ->where('iChapterNumber', '>', $chapter->iChapterNumber)
            ->orderBy('iChapterNumber', 'ASC')
            ->first();


        $previousChapterId = $previousChapter ? $previousChapter->id : 0;
        $nextChapterId = $nextChapter ? $nextChapter->id : 0;


        return view('chapter.chapter_page', [
            'is_chapter_page' => $this->is_chapter_page,
            'chapter' => $chapter,
            'novel' => $novel,
            'previousChapterId' => $previousChapterId,
            'nextChapterId' => $nextChapterId
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
        if (Auth::check()) {

            $data = $request->validate(
                [
                    'tenchuong' => ['required', 'string', 'max:255',Rule::unique('tblchapter', 'sChapter')->where(function ($query) use ($request,$id) { return $query->where('idNovel', $request->idNovel); })->ignore($id,'id'),],
                    'noidungchuong' => ['required'],
                    'tinhphi' => ['in:1,0'],
                    'tinhtrang' => ['required', 'in:1,0'],
                    'idNovel' => ['required'],
                    'giatien' => ['integer', 'min:1']
                ], [
                    'tenchuong.required' => 'Tên chương không được để trống',
                    'tenchuong.string' => 'Tên chương phải là các ký tự',
                    'tenchuong.max' => 'Tên chương không được nhiều hơn 255 ký tự',
                    'tenchuong.unique' => 'Tên chương đã tồn tại trong truyện này',

                    'noidungchuong.required' => 'Nội dung chương không được để trống',
                    'tinhtrang.in' => 'Tình trạng bạn chọn không tồn tại',

                    'tinhphi.in' => 'Lựa chọn tính phí bạn chọn không tồn tại',
                    'idNovel.required' => 'Mã truyện không được bỏ trống hãy tải lại lại trang để tải lại mã truyện',

                    'giatien.integer' => 'Giá tiền phải là một giá trị số',
                    'giatien.min' => 'Giá trị nhỏ nhất của giá tiền là 1'
                ]
            );

            
            $chapter = Chapter::find($id);
            $chapter->sChapter =  $data['tenchuong'];
            $chapter->sContent =  $data['noidungchuong'];
            $chapter->iPublishingStatus =  0;
            $chapter->iStatus =  $data['tinhtrang'];
            $chapter->idNovel =  $data['idNovel'];

            if(isset($data['tinhphi']) && $chapter->iChapterNumber >= 10) {
                $chapter->icharges =  $data['tinhphi'];
                $price = 0;

                if ($data['tinhphi'] == 1) {
                    $price =  $data['giatien'];
                }

                $chapter->iPrice = $price;

            } else {
                $chapter->icharges = 0;
                $chapter->iPrice = 0;
            }

            $chapter->save();

            return response()->json([
                'message' => 'Sửa chương truyện thành công',
                'status' => 1
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

    public function page_chitiet_chuong_author($id)
    {
        $chapters = Chapter::find($id);
        $novel = Novel::find($chapters->idNovel);
        return view('author.chapter.chapter_index',[
            'novel' =>$novel,
            'chapters' => $chapters
         ]);
    }

    public function admin_kiemquyet_chuong($id)
    {
        $chapters = Chapter::find($id);
        return response()->json([
            'chapters' => $chapters,
            'status' => 1
        ]);
    }

    public function kiem_duyet_chuong(Request $request)
    {
        $chapter = Chapter::find($request['id']);

        if (isset($request['xuly'])) {
            $chapter->iPublishingStatus = $request['xuly'];
        }

        if (isset($request['trangthai'])) {
            $chapter->iStatus = $request['trangthai'];
        }

        if (isset($request['trangthai']) || isset($request['xuly'])) {
            $chapter->save();
            $chapters = Chapter::orderBy('iChapterNumber', 'ASC')->where('idNovel',$request['id_novel'])->get();
            return response()->json([
                'message' => 'Cập nhật thành công',
                'status' =>1,
                'table'=>view('admincp.admin_page.admin_mucluc',[
                    'chapters' => $chapters
                 ])->render()
            ]);

        } else {
            return response()->json([
                'message' => 'Bạn chưa thay đổi gì cả',
                'status' =>1
            ]);
        }
    }
}

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
                    'tinhphi' => ['required', 'in:1,0'],
                    'tinhtrang' => ['required', 'in:1,0'],
                    'idNovel' => ['required']
                ],
                [
                    'tenchuong.required' => 'Tên chương không được để trống',
                    'tenchuong.string' => 'Tên chương phải là các ký tự',
                    'tenchuong.max' => 'Tên chương không được nhiều hơn 255 ký tự',
                    'tenchuong.unique' => 'Tên chương đã tồn tại trong truyện này',

                    'noidungchuong.required' => 'Nội dung chương không được để trống',

                    'tinhtrang.in' => 'Tình trạng bạn chọn không tồn tại',

                    'tinhphi.in' => 'lựa chọn tính phí bạn chọn không tồn tại',
                    'idNovel.required' => 'Mã truyện không được bỏ trống hãy load lại page để load mã truyện'
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
            $chapter->icharges =  $data['tinhphi'];

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
        // $Chapter = Chapter::find($id);
        return view('chapter.chapter_page', [
            'is_chapter_page' => $this->is_chapter_page
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
        //
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
}

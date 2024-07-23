<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ReportController extends Controller
{
    public function bao_cao_list_user()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $reports = Report::where('idUser', $id)->get();

            return response()->json([
                'status' => 1,
                'html' => view('user.report.report_list_user', [
                    'reports' => $reports
                ])->render()
            ]);
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }

    public function bao_cao_list_admin($status)
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $reports = Report::where('iStatus', $status)->get();

            return response()->json([
                'status' => 1,
                'ádasd' =>  $status,
                'html' => view('user.report.report_list_user', [
                    'reports' => $reports
                ])->render()
            ]);
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }
    

    public function bao_cao(Request $request)
    {

        $data = $request->validate(
            [
                'report_title' => ['required', 'string', 'max:255'],
                'content_report' => ['required', 'string', 'max:3000'],
            ],
            [
                'report_title.required' => 'Tiêu đề tố cáo không được để trống',
                'report_title.string' => 'Tiêu đề tố cáo phải là các ký tự',
                'report_title.max' => 'Tiêu đề tố cáo không được nhiều hơn 255 ký tự',

                'content_report.required' => 'Nội dung tố cáo không được để trống',
                'content_report.string' => 'Nội dung tố cáo phải là các ký tự',
                'content_report.max' => 'Nội dung tố cáo không được nhiều hơn 3000 ký tự',
            ]
        );
        if (Auth::check()) {
            $id = Auth::user()->id;
            $today = Carbon::today();
            $report = Report::whereDate('dCreateDay', $today)->where('idUser',$id)->get();

            if ($report->isEmpty()) {
                $report = new Report();
                $report->sTitle =  $data['report_title'];
                $report->sContent =  $data['content_report'];
                $report->idUser  =  $id;
                $report->sReply =  '';
                $report->save();

                return response()->json([
                    'message' => 'Bạn gửi tố cáo ' . $data['report_title'] . ' thành công. Đội ngũ quản trị viên sẽ phản hồi bạn sớm nhất có thể. Hãy thường xuyên kiểm tra mail',
                    'status' => 1
                ]);

            } else {
                return response()->json([
                    'errors' => ['baocao' => 'Ngày hôm nay bạn đã hết lượt tố cáo rồi tố cáo rồi nếu có cần hãy bổ sung vào tố cáo này hôm nay của bạn'],
                    'status' => 0
                ]);
            }

        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }

    public function chitiet_report_user($id_report)
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $report = Report::find($id_report);

            if ($report->idUser  == $id) {
                return response()->json([
                    'status' => 1,
                    'report_status' => $report->iStatus,
                    'report_title' => 'Chi tiết tố cáo: '.$report->sTitle,
                    'html' => view('user.report.report_detail_user', [
                        'report' => $report
                    ])->render()
                ]);
            } else {
                if (Auth::user()->sRole ='admin') {
                    return response()->json([
                        'status' => 1,
                        'report_title' => 'Chi tiết tố cáo: '.$report->sTitle,
                        'html' => view('admincp.admin_page.report.report_detail_admin', [
                            'report' => $report
                        ])->render()
                    ]);
                } else {
                    return response()->json([
                        'errors' => ['Nguoidung' => 'Bạn không phải admin hay người sở hữu tố cáo này'],
                        'status' => 0
                    ]);
                }
            }
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }
    public function update_report_admin(Request $request, $id_report) {

        $data = $request->validate(
            [
                'report_reply' => ['required', 'string', 'max:3000'],
                'report_status' => ['required', 'in:0,1,3','integer'],
            ],
            [
                'report_reply.required' => 'Nội dung phản hồi tố cáo không được để trống',
                'report_reply.string' => 'Nội dung phản hồi tố cáo phải là các ký tự',
                'report_reply.max' => 'Nội dung phản hồi tố cáo không được nhiều hơn 300 ký tự',

                'report_status.required' => 'Trạng thái tố cáo không được để trống',
                'report_status.in' => 'Trạng thái tố cáo phải nằm trong các giá trị (0 = chưa, 1 = đã, 3 = từ chối)',
                'report_status.integer' => 'Trạng thái tố cáo phải là các gái trị số',
            ]
        );

        if (Auth::check()) {
            $report = Report::find($id_report);

            if (Auth::user()->sRole ='admin') {

                $report->iStatus =  $data['report_status'];
                $report->sReply =  $data['report_reply'];
                $report->save();

                if (Auth::user()->email_verified_at != null) {
                    $user = User::find($report->idUser);
                    if ($user) {
                        Mail::send('admincp.admin_page.report.reply_mail',[
                            'user' =>$user,
                            'report' =>$report
                        ],function($email) use ($user,$report){
                            $email->to($user->email,$user->name)->subject('Phản hồi về tố cáo: '.$report->sTitle );
                        });
                    }
                }

                return response()->json([
                    'status' => 1,
                    'message' => 'Bạn cập nhật tố cáo ' . $report->sTitle . ' thành công',
                ]);
            } else {
                return response()->json([
                    'errors' => ['Nguoidung' => 'Bạn không không có quyền phản hồi tố cáo này'],
                    'status' => 0
                ]);
            }
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }
    public function update_report_user(Request $request, $id_report) {

        $data = $request->validate(
            [
                'report_title' => ['required', 'string', 'max:255'],
                'content_report' => ['required', 'string', 'max:3000'],
            ],
            [
                'report_title.required' => 'Tiêu đề tố cáo không được để trống',
                'report_title.string' => 'Tiêu đề tố cáo phải là các ký tự',
                'report_title.max' => 'Tiêu đề tố cáo không được nhiều hơn 255 ký tự',

                'content_report.required' => 'Nội dung tố cáo không được để trống',
                'content_report.string' => 'Nội dung tố cáo phải là các ký tự',
                'content_report.max' => 'Nội dung tố cáo không được nhiều hơn 3000 ký tự',
            ]
        );

        if (Auth::check()) {
            $id = Auth::user()->id;
            $report = Report::find($id_report);

            if ($report->idUser  == $id) {

                $report->sTitle =  $data['report_title'];
                $report->sContent =  $data['content_report'];
                $report->save();

                return response()->json([
                    'status' => 1,
                    'message' => 'Bạn cập nhật tố cáo ' . $data['report_title'] . ' thành công',
                ]);
            } else {
                return response()->json([
                    'errors' => ['Nguoidung' => 'Bạn không phải người sở hữu tố cáo này'],
                    'status' => 0
                ]);
            }
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }
}
<?php

use App\Models\User;
use App\Models\Author;
use App\Models\Novel;

    $novels = Novel::orderBy('id', 'DESC')->where('iLicense_Status',0)->get();

?>

<div class="container" id="ntp_admin_novel_list_wrap">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold">Danh sách truyện cần xét duyệt bản quyền là</div>
                @guest
                <div class="card-body">
                    @include('layouts.404_traiphep')
                </div>
            @else
                @auth
                    @if (Auth::user()->sRole == 'admin')
                    <div class="card-body overflow-auto ntp_custom_ver_scrollbar" style="height: 1000px;">
                        <table class="table table-hover ntp_novel_list">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    {{-- <th scope="col">Mã thể loại</th> --}}
                                    <th scope="col">Ảnh bìa</th>
                                    <th scope="col">Tên truyện</th>
                                    <th scope="col">Tác giả</th>
                                    <th scope="col">Ngày khởi tạo</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($novels as $key => $novel)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        {{-- <td>{{ $cat->id }}</td> --}}
                                        <td> <img class="ntp_anh_bia mb-2 w-100" src="{{ asset('uploads/images/'.$novel->sCover) }}" alt=""></td>
                                        <td class="name">{{ $novel->sNovel }}</td>
                                        <td>
                                            <?php
                                                 $author = Author::where('idUser',$novel->idUser)->first();
                                                    echo ($author->sNickName);
                                            ?>
                                        </td>
                                        <td>{{ $novel->dCreateDay }}</td>
                                        <td>
                                            <a class="btn btn-primary ntp_chitiettruyen" data-bs-toggle="modal"  data-bs-target="#ntp_edit_novel_poup" href="javascript:void(0);" data-link="{{route('Novel.chi_tiet_truyen',[$novel->id])}}">Quản lý truyện</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="card-body">
                            @include('layouts.404_traiphep')
                        </div>
                    @endif
                @endauth
            @endguest
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 mb-5">
    <div class=" row">
        <div class="col-md-8 mb-4 mb-md-0">
            <div class="card">
                <div class="card-header fw-bold">Đánh dấu của bạn</div>
                <div class="card-body">
                    <div class="overflow-auto ntp_custom_ver_scrollbar" style="height: 500px;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Số tiền giao dịch</th>
                                    <th scope="col">Số xu nhận được</th>
                                    <th scope="col">Thời gian giao dịch</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @for ($cats as $key => $cat)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $cat->id }}</td>
                                        <td>{{ $cat->sCategories }}</td>
                                        <td class="w-25">{{ $cat->sDes }}</td>
                                    </tr>
                                @endfor --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <form method="POST" action="/xulythanhtonamomo.php" target="_blank" enctype="application/x-www-form-urlencoded">
                <input type="submit" name="momo" value="QR momo" class="btn btn-danger">
            </form>
        </div>
    </div>
</div>
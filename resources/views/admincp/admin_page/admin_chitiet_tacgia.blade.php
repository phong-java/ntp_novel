<form method="POST" data-link="{{ route('Author.xetduyet', [$author->id]) }}">
    @csrf
    <div class="alert alert-success ntp_hidden" role="alert"></div>
    <div class="alert alert-danger ntp_hidden" role="alert"></div>
    <div class="mb-3">
        <label class="small mb-1" for="inputNickname">Nick name (bút danh tác giả)</label>
        <input class="form-control" type="text" value="{{ $author->sNickName }}" readonly>
    </div>
    <div class="mb-3">
        <label class="small mb-1" for="mota_tacgia">Mô tả về bạn</label>
        <textarea class="form-control" rows="10" readonly>{{ $author->sDes }}</textarea>
    </div>
    <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="inputBirthday">Ngân hàng sử dụng</label>
            <input class="form-control" readonly value="{{ $author->sBank }}">
        </div>
        <div class="col-md-6">
            <label class="small mb-1" for="maso_nganhhang">Số tài khoản ( viết sai dáng chịu)</label>
            <input class="form-control" type="text" value="{{ $author->sBankAccountNumber }}">
        </div>

    </div>

    <div class="row gx-3 mb-3">
        <label for="ntp_camket_da_upload" class="form-label">Cam kết đã up load</label>
        <iframe id="ntp_camket_da_upload" src="{{ asset('uploads/camket/' . $author->sCommit) }}"
            class="w-100 vh-100"></iframe>
    </div>

    <div class="row gx-3 mb-3">
        <label for="ntp_cccd_da_upload" class="form-label">CCCD đã up load</label>
        <iframe id="ntp_cccd_da_upload" src="{{ asset('uploads/cccd/' . $author->sImg_identity) }}"
            class="w-100 vh-100"></iframe>
    </div>

    <div class="gx-3 mb-3">
        {{-- <input class="btn-check" type="radio" name="vuly" id="xuly1" value="1">
        <label class="btn btn-outline-primary" for="xuly1">Đồng ý cấp quyền</label>

        <input class="btn-check" type="radio" name="vuly" id="xuly2" value="3">
        <label class="btn btn-outline-primary" for="xuly2">Từ chối cấp quyền</label> --}}

        <input class="btn-check" type="radio" name="xuly" id="xuly1" value="1">
        <label class="btn btn-outline-primary" for="xuly1">Đồng ý cấp quyền</label>

        <input class="btn-check" type="radio" name="xuly" id="xuly2" value="3">
        <label class="btn btn-outline-primary" for="xuly2">Từ chối cấp quyền</label>
    </div>
</form>

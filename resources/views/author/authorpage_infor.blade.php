<form method="POST" id="ntp_form_create_author"
action="<?php echo $author_found == 0 ? route('Author.store') : route('Author.update', [$author->id]); ?>">
@csrf
<div class="alert alert-success ntp_hidden" role="alert"></div>
<div class="alert alert-danger ntp_hidden" role="alert"></div>
<div class="mb-3">
    <label class="small mb-1" for="inputNickname">Nick name (bút
        danh tác giả)</label>
    <input class="form-control" maxlength="100"
        name="butdanh" type="text"
        placeholder="bút danh bạn định sử dụng là"
        value="{{ $author_found == 1 ?($author->sNickName ? $author->sNickName : '' ):''}}">

    <input class="form-control d-none" id="inputNickname"
        name="id_user" type="text" value="{{ $user->id }}">
</div>
<div class="mb-3">
    <label class="small mb-1" for="mota_tacgia">Mô tả về
        bạn</label>
    <textarea class="form-control" id="mota_tacgia" name="mota" rows="10"
        placeholder="Mô tả sơ lược về bạn ở đây ( không quá 3000 từ )..." maxlength="3000">{{ $author_found == 1 ?($author->sDes ? $author->sDes : ''):'' }}</textarea>
</div>
<div class="row gx-3 mb-3">
    <div class="col-md-6">
        <label class="small mb-1">Ngân hàng
            bạn sử dụng</label>
        <div class="form-check">
            <input <?php echo $author_found == 1?($author->sBank == 'VCB' ? 'checked' : ''):''; ?> class="form-check-input"
                type="radio" value="VCB" name="nganhang"
                id="nganhang1" required>
            <label class="form-check-label pe-auto"
                for="nganhang1">Vietcombank</label>
        </div>
        <div class="form-check">
            <input <?php echo $author_found == 1?($author->sBank == 'VTB' ? 'checked' : ''):''; ?> class="form-check-input"
                type="radio" value="VTB" name="nganhang"
                id="nganhang2">
            <label class="form-check-label pe-auto"
                for="nganhang2">VietinBank </label>
        </div>
        <div class="form-check">
            <input <?php echo $author_found == 1?($author->sBank == 'TCB' ? 'checked' : ''):''; ?> class="form-check-input"
                type="radio" value="TCB" name="nganhang"
                id="nganhang3">
            <label class="form-check-label pe-auto"
                for="nganhang3">Techcombank</label>
        </div>
        <div class="form-check">
            <input <?php echo $author_found == 1?($author->sBank == 'BIDV' ? 'checked' : ''):''; ?> class="form-check-input"
                type="radio" value="BIDV" name="nganhang"
                id="nganhang4">
            <label class="form-check-label pe-auto"
                for="nganhang4">Ngân hàng TMCP Đầu tư và
                Phát triển Việt Nam</label>
        </div>
        <div class="form-check">
            <input <?php echo $author_found == 1?($author->sBank == 'TPB' ? 'checked' : ''):'';  ?> class="form-check-input"
                type="radio" value="TPB" name="nganhang"
                id="nganhang5">
            <label class="form-check-label pe-auto"
                for="nganhang5">TPBank</label>
        </div>
        <div class="form-check">
            <input <?php echo $author_found == 1?($author->sBank == 'AGB' ? 'checked' : ''):'';?> class="form-check-input"
                type="radio" value="AGB" name="nganhang"
                id="nganhang6">
            <label class="form-check-label pe-auto"
                for="nganhang6">Agribank</label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="small mb-1" for="maso_nganhhang">Số tài khoản ( viết sai dáng chịu)</label>
        <input class="form-control" id="maso_nganhhang"
            maxlength="20" name="maso_nganhhang" type="text"
            placeholder="Số tài khoản ( viết sai dáng chịu)"
            value="{{ $author_found == 1?($author->sBankAccountNumber ? $author->sBankAccountNumber : ''):'' }}">
    </div>

</div>

<div class="row gx-3 mb-3 <?php echo $author_found == 0 ? 'd-none':($author->sCommit != '' ? '' : 'd-none'); ?>">
    <label class="form-label">Cam kết
        đã up load</label>
    <iframe id="ntp_camket_da_upload" src="<?php echo $author_found == 1 ? ($author->sCommit != '' ? asset('uploads/camket/' . $author->sCommit):''):''; ?>"
        class="w-100 vh-100"></iframe>
</div>

<div class="row gx-3 mb-3">
    <label for="upload_camket" class="form-label">Up load cam
        kết</label>
    <input class="form-control mb-3" type="file" name="camket"
        id="upload_camket">
    <a class="text-decoration-underline"
        href="{{ asset('uploads/camket/ban-cam-ket-chiu-trach-nhiem.pdf"') }}"
        download> Tải bản cam kết mẫu </a>
</div>

<!-- Save changes button-->
<button class="btn btn-primary ntp_btn_create_author"
    type="button"><?php echo $author_found == 0 ? 'Xin cấp quyền tác giả' : 'Cập nhật thông tin tác giả'; ?></button>
</form>
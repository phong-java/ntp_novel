// const { error } = require("laravel-mix/src/Log");

$(document).ready(function () {
  $("button.phong").on("click", function (event) {
    alert('phongllll');
  });

  var btn_close_success = '<span class="ntp_alert_close bg-success"><button type="button" class="btn-close"></button></span>';
  var btn_close_danger = '<span class="ntp_alert_close bg-danger"><button type="button" class="btn-close"></button></span>';

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.ntp_slick').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 6,
    slidesToScroll: 6,
    infinite: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

  $('.ntp_recommend').slick({
    centerMode: true,
    centerPadding: '200px',
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          centerMode: true,
          centerPadding: '50px',
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          centerMode: true,
          centerPadding: '0px',
          slidesToShow: 1
        }
      }
    ]
  });

  // tạo mới thể loại trong admin

  $('button.ntp_btn_cat_create').on('click', function () {
    var form = $('.ntp_cat_create')[0];
    var _data = new FormData(form);
    var _form = $('.ntp_cat_create');

    $.ajax({
      method: "POST",
      url: $(form).attr('action'),
      contentType: false,
      processData: false,
      data: _data,
      dataType: "json",

      success: function (data) {
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);

        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }

        $('body').trigger('ntp-alert-out');
      },
      error: function (error) {

      }
    });

  });

  // load thông tin chi tiết của thể loại

  $('body').on('click', '.ntp_cat_edit', function () {
    var _this = $(this)
    var url = $(_this).attr('data-link');
    $.ajax({
      method: "POST",
      url: url,
      success: function (data) {
        var ntp_efit_popup = $('.ntp_edit_cat_ppoup');
        $(ntp_efit_popup).find('.modal-body').html(data);
      },
      error: function (error) {

      }
    });
  });


  // cập nhật thể loại trong admin
  $('body').on('click', '.ntp_edit_cat_ppoup .ntp_btn_update_cat', function () {
    var _this = $(this)
    var pa = $(_this).parents('.ntp_edit_cat_ppoup');
    var _form = $(pa).find('.modal-body form');
    var url = $(_form).attr('action');
    var dataform = $(pa).find('.modal-body form')[0];
    var _data = new FormData(dataform);

    $.ajax({
      method: "POST",
      url: url,
      data: _data,
      contentType: false,
      processData: false,
      success: function (data) {
        $('body').trigger('ntp_admin_load_cat_list');
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);

        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }

        $('body').trigger('ntp-alert-out');
      },
      error: function (error) {

      }
    });
  });

  // Load lại danh sách thể loại trong admin

  $('#danh_sach_theloai-tab').on('click', function () {
    $('body').trigger('ntp_admin_load_cat_list');
  })
  // Load lại danh sách thể loại trong admin
  $('body').on('ntp_admin_load_cat_list', function () {
    var btn = $('#danh_sach_theloai-tab');

    if ($(btn).length) {
      var url = $(btn).attr('data-link');

      $.ajax({
        method: "POST",
        url: url,
        success: function (data) {
          var danh_sach_theloai = $('#danh_sach_theloai');
          $(danh_sach_theloai).html(data);
        },
        error: function (error) {

        }
      });
    }
  }).trigger('ntp_admin_load_cat_list');


  // đăng nhập
  $("#ntp_login_form .ntp_submit_login").on("click", function () {
    var _this = $(this)
    var pa = $(_this).parents('#ntp_login_register_modal');
    var _form = $(pa).find('#ntp_login_form');
    var url = $(_form).attr('action');
    var dataform = $(pa).find('#ntp_login_form')[0];
    var _data = new FormData(dataform);

    $.ajax({
      method: "POST",
      url: url,
      data: _data,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (data) {

        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);
          setTimeout(function () {
            location.reload();
          }, 400);

        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }

        $('body').trigger('ntp-alert-out');
      },
      error: function (error) {

      }
    });
  });


  // đăng ký
  $("#ntp_register_form .ntp_submit_register").on("click", function () {
    var _this = $(this)
    var pa = $(_this).parents('#ntp_login_register_modal');
    var _form = $(pa).find('#ntp_register_form');
    var url = $(_form).attr('action');
    var dataform = $(pa).find('#ntp_register_form')[0];
    var _data = new FormData(dataform);

    $.ajax({
      method: "POST",
      url: url,
      data: _data,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (data) {
        console.log(data);
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);
          setTimeout(function () {
            location.reload();
          }, 2000);
        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }

        $('body').trigger('ntp-alert-out');
      },
      error: function (error) {

      }
    });
  });

  // ntp_form_update_infor_user 
  $(".ntp_btn_update_infor_user").on("click", function (event) {
    var _this = $(this);
    var _form = $(_this).parents('#ntp_form_update_infor_user');
    var dataform = $(_this).parents('#ntp_form_update_infor_user')[0];
    var _data = new FormData(dataform);

    var url = $(_form).attr('action');

    $.ajax({
      method: "POST",
      url: url,
      data: _data,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (data) {
        console.log(data);
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);
          // setTimeout(function() {
          //   location.reload();
          // }, 2000);
        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }

        $('body').trigger('ntp-alert-out');
      },
      error: function (error) {

      }
    });
    event.preventDefault();
  });

  //thay avartar
  $('body').on('change', '#ntp_input_update_anhdaidien', function () {
    var fileInput = $(this)[0];
    var file = fileInput.files[0];

    if (file) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('.ntp_av_wrap .ntp_av ').attr('src', e.target.result);
      }

      reader.readAsDataURL(file);
      var _this = $(this);
      var _form = $(_this).parents('#ntp_form_update_av_user');
      var dataform = $(_this).parents('#ntp_form_update_av_user')[0];
      var _data = new FormData(dataform);

      var url = $(_this).attr('data-link');

      $.ajax({
        method: "POST",
        url: url,
        data: _data,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (data) {


          if (data.status == 1) {
            if (data.av_update.avatar_change_status == 1) {
              $('.ntp_av_wrap').find('.alert-danger').fadeOut(200);
              $('.ntp_av_wrap').find('.alert-success').fadeIn(200).html(data.av_update.avatar_change + btn_close_success);
              var _av = $('.ntp_av');
              $(_av).each(function () {
                $(this).attr('src', data.av_update.av_link);
              });
            } else if (data.av_update.avatar_change_status == 0) {
              $('.ntp_av_wrap').find('.alert-success').fadeOut(200);
              $('.ntp_av_wrap').find('.alert-danger').fadeIn(200).html(data.av_update.avatar_change + btn_close_danger);
            }
          } else {
            var errors = data.errors;
            var errorMessages = '';
            for (var key in errors) {
              errorMessages += errors[key] + '</br>';
            }

            console.log(data.errors);

            $('.ntp_av_wrap').find('.alert-success').fadeOut(200);
            $('.ntp_av_wrap').find('.alert-danger').fadeIn(200).html(errorMessages);
          }

          $('body').trigger('ntp-alert-out');
        },
        error: function (error) {

        }
      });

    }
  });

  $('body').on('change', '#ntp_input_anhbiatruyen', function () {
    var fileInput = $(this)[0];
    var file = fileInput.files[0];

    if (file) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('.ntp_anh_bia_wrap .ntp_anh_bia ').attr('src', e.target.result);
      }

      reader.readAsDataURL(file);
    }
  });
  // xin cấp quyền tác giả 
  $(".ntp_btn_create_author").on("click", function (event) {
    var _this = $(this);
    var _form = $(_this).parents('#ntp_form_create_author');
    var dataform = $(_this).parents('#ntp_form_create_author')[0];
    var _data = new FormData(dataform);

    var url = $(_form).attr('action');
    console.log(dataform);
    $.ajax({
      method: "POST",
      url: url,
      data: _data,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (data) {
        console.log(data);
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);
          // setTimeout(function() {
          //   location.reload();
          // }, 2000);
        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }

        if (data.file) {
          $(_form).find('#ntp_camket_da_upload').attr('src', data.file);
        }

        $('body').trigger('ntp-alert-out');
      },
      error: function (error) {

      }
    });
    event.preventDefault();
  });

  $('body').on('click', '.ntp_btn_author_detail', function () {
    var _this = $(this)
    var url = $(_this).attr('data-link');
    $.ajax({
      method: "POST",
      url: url,
      success: function (data) {
        var ntp_author_detail = $('#ntp_author_detail');
        $(ntp_author_detail).find('.modal-body').html(data);
      },
      error: function (error) {

      }
    });
  });

  $('body').on('click', '.ntp_author_detail_update', function () {
    var _this = $(this)
    var pa = $(_this).parents('#ntp_author_detail');
    var _form = $(pa).find('.modal-body form');
    var url = $(_form).attr('data-link');
    var dataform = $(pa).find('.modal-body form')[0];
    var _data = new FormData(dataform);

    $.ajax({
      method: "POST",
      url: url,
      data: _data,
      contentType: false,
      processData: false,
      success: function (data) {
        $('body').trigger('ntp_admin_load_xetduyet_author_list');
        $('body').trigger('ntp_admin_load_author_list');
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);

          setTimeout(function () {
            $(pa).find('.btn-close').trigger('click');
          }, 1000);
        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }

        $('body').trigger('ntp-alert-out');

      },
      error: function (error) {

      }
    });
  });

  $('body').on('click', '.ntp_btn_update_chapter', function () {
    var _this = $(this)
    var _form = $(_this).parents('form#ntp_form_update_chapter');
    var url = $(_form).attr('action');
    var dataform = $(_this).parents('form#ntp_form_update_chapter')[0];
    var _data = new FormData(dataform);

    $.ajax({
      method: "POST",
      url: url,
      data: _data,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);

        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }

        $('body').trigger('ntp-alert-out');

      },
      error: function (error) {

      }
    });
  });

  // Load lại danh sách xét duyệt tác giả trong admin
  $('body').on('ntp_admin_load_xetduyet_author_list', function () {
    var btn = $('#xet_duyet_tacgia-tab');

    if ($(btn).length) {
      var url = $(btn).attr('data-link');

      $.ajax({
        method: "POST",
        url: url,
        success: function (data) {
          var xet_duyet_tacgia = $('#xet_duyet_tacgia');
          $(xet_duyet_tacgia).html(data);
        },
        error: function (error) {

        }
      });
    }
  }).trigger('ntp_admin_load_xetduyet_author_list');

  $('body').on('click', '.ntp_chitiettruyen', function () {
    var _this = $(this)
    var url = $(_this).attr('data-link');
    $.ajax({
      method: "POST",
      url: url,
      success: function (data) {
        var ntp_edit_novel_poup = $('#ntp_edit_novel_poup ');
        $(ntp_edit_novel_poup).find('.modal-body').html(data);
      },
      error: function (error) {

      }
    });
  });

  $('body').on('click', '.ntp_admin_btn_update_novel', function () {
    var _this = $(this)
    var pa = $(_this).parents('#ntp_edit_novel_poup');
    var _form = $(pa).find('#ntp_form_novel_License');
    var url = $(_form).attr('action');
    var dataform = $(pa).find('.modal-body form')[0];
    var _data = new FormData(dataform);

    $.ajax({
      method: "POST",
      url: url,
      data: _data,
      contentType: false,
      processData: false,
      success: function (data) {
        $('body').trigger('ntp_admin_load_xetduyet_novel_list');
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);

          setTimeout(function () {
            $(pa).find('.btn-close').trigger('click');
          }, 1000);
        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }

        $('body').trigger('ntp-alert-out');

      },
      error: function (error) {

      }
    });

    $('body').trigger('ntp_admin_load_novel_list');

  });

  $('#xet_duyet_tacpham-tab').click(function () {
    $('body').trigger('ntp_admin_load_xetduyet_novel_list');
  });

  $('body').on('ntp_admin_load_xetduyet_novel_list', function () {
    var btn = $('#xet_duyet_tacpham-tab');

    if ($(btn).length) {
      var url = $(btn).attr('data-link');

      $.ajax({
        method: "POST",
        url: url,
        success: function (data) {
          var xet_duyet_tacpham = $('#xet_duyet_tacpham');
          $(xet_duyet_tacpham).html(data);
        },
        error: function (error) {

        }
      });
    }
  }).trigger('ntp_admin_load_xetduyet_novel_list');

  $('.ntp_btn_create_novel,.ntp_btn_update_infor_novel').click(function (e) {
    var _this = $(this);
    var _form = $(_this).parents('#ntp_form_create_novel');
    var url = $(_form).attr('action');
    var motatruyen = CKEDITOR.instances.motatruyen.getData();
    var dataform = $(_this).parents('#ntp_form_create_novel')[0];
    var _data = new FormData(dataform);
    _data.set('motatruyen', motatruyen);

    $.ajax({
      method: "POST",
      url: url,
      data: _data,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);
          $('body').trigger('ntp_author_load_novel_list');


        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }
        $('body').trigger('ntp-alert-out');
      },
      error: function (error) {

      }
    });
    e.preventDefault();
  });

  $('.ntp_btn_create_chapter').click(function (e) {
    var _this = $(this);
    var _form = $(_this).parents('#ntp_form_create_chapter');
    var url = $(_form).attr('action');
    var noidungchuong = CKEDITOR.instances.noidungchuong.getData();
    var dataform = $(_this).parents('#ntp_form_create_chapter')[0];
    var _data = new FormData(dataform);
    _data.set('noidungchuong', noidungchuong);
    console.log(_data);

    $.ajax({
      method: "POST",
      url: url,
      data: _data,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);
          $('body').trigger('ntp_author_load_novel_list');

        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }

        $('body').trigger('ntp-alert-out');
      },
      error: function (error) {

      }
    });
    e.preventDefault();
  });



  $('#danhsach_truyen-tab').on('click', function () {
    $('body').trigger('ntp_author_load_novel_list');
  })


  // Load lại danh sách truyện trong tác giả
  $('body').on('ntp_author_load_novel_list', function () {
    var btn = $('#danhsach_truyen-tab');

    if ($(btn).length) {
      var url = $(btn).attr('data-link');

      $.ajax({
        method: "POST",
        url: url,
        success: function (data) {
          var danhsach_truyen = $('#ntp_novel_list_wrap');
          $(danhsach_truyen).html(data);
        },
        error: function (error) {

        }
      });
    }

  }).trigger('ntp_author_load_novel_list');

  $('body').on('click', '.admin_kiemduyet_chuong', function () {
    var _this = $(this)
    var url = $(_this).attr('data-link');
    var _wrap = $('#ntp_chapter_detail_admin');
    $(_wrap).find('.ntp_load').html('Loading...');
    $.ajax({
      method: "GET",
      url: url,
      success: function (data) {

        var chapters = data.chapters;
        for (var key in chapters) {
          switch (key) {
            case 'id':
              $(_wrap).find('.' + key).val(chapters[key]);
              break;
            case 'iPublishingStatus':
              if (chapters[key] == 1) {
                $(_wrap).find('#xuly_chapter').prop('checked', true);
              } else {
                $(_wrap).find('#xuly_chapter').prop('checked', false);
              }
              break;
            case 'iPublishingStatus':
              if (chapters[key] == 1) {
                $(_wrap).find('#xuly_chapter').prop('checked', true);
              } else {
                $(_wrap).find('#xuly_chapter').prop('checked', false);
              }
              break;
            case 'iStatus':
              if (chapters[key] == 1) {
                $(_wrap).find('#trangthai_chapter').prop('checked', true);
              } else {
                $(_wrap).find('#trangthai_chapter').prop('checked', false);
              }
              break;
            case 'icharges':
              if (chapters[key] == 1) {
                (_wrap).find('.' + key).html('Có tính phí');
              } else {
                (_wrap).find('.' + key).html('Không tính phí');
              }
              break;
            default:
              $(_wrap).find('.' + key).html(chapters[key]);
          }
        }
      },
      error: function (error) {

      }
    });
  });

  $('body').on('click', '.ntp_chapter_detail_admin_check', function () {
    var _this = $(this);
    var pa = $(_this).parents('.ntp_chapter_detail_admin')
    var _form = $(pa).find('#ntp_form_chapter_check');
    var url = $(_form).attr('action');

    var xuly = $(_form).find('#xuly_chapter').is(':checked') ? 1 : 0;
    var trangthai = $(_form).find('#trangthai_chapter').is(':checked') ? 1 : 0;
    var id = $(pa).find('#idChapter').val();
    var id_novel = $(_this).attr('data-id-novel');
    var _data = {
      xuly: xuly,
      trangthai: trangthai,
      id: id,
      id_novel: id_novel,
      _token: $(_form).find('input[name="_token"]').val()
    };

    $.ajax({
      method: "POST",
      url: url,
      data: JSON.stringify(_data),
      contentType: 'application/json; charset=utf-8',
      dataType: 'json',
      success: function (data) {
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message + btn_close_success);
          $('body').trigger('ntp_author_load_novel_list');
          $('#ntp_mucluc').html(data.table);
        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages + btn_close_danger);
        }

        $('body').trigger('ntp-alert-out');
      },
      error: function (error) {

      }
    });
  });

  $('body').on('ntp_bookmark_load_locall',function(){
    if($('.ntp_bookmarks').hasClass('ntp_bookmarks_locall') && $('.ntp_bookmarks').length) {
      var bookmarks = localStorage.getItem('ntp_bookmarks');
      if (bookmarks) {
        
        bookmarks = JSON.parse(bookmarks); 
  
        if (bookmarks.length !== 0) {
          var html = '';
          $.each(bookmarks, function (index, value) {
            html += '<div class="d-flex flex-row my-1 align-items-center justify-content-between">'+
                    '<a href="' + value.link + '" class="title text-truncate text-decoration-none text-reset">' + value.title + '</a>'+
                    '<a href="javascript:void(0);" data-id-novel="' + value.id + '" class="btn ntp_bookmark_remove ntp_locall btn-danger mx-2">X</a>'+
                    '</div><hr>';
          });
  
          $('.ntp_bookmarks').html(html);
        }else {
          $('.ntp_bookmarks').html('');
        }
      }
    }
  }).trigger('ntp_bookmark_load_locall');

  $('body').on('ntp_history_load_locall',function(){
    if($('.ntp_read_history').length && $('.ntp_read_history').hasClass('ntp_read_history_locall') ) {
      var wrap = $('.ntp_read_history');
      var historys = localStorage.getItem('ntp_historys');
      if (historys) {
        var html='';
        historys = JSON.parse(historys);
        if (historys.length !== 0) {
          $.each(historys, function (index, value) {
              html += '<div class="d-flex flex-row my-1 align-items-center justify-content-between">'+
                        '<a href="' + value.link_novel + '" class="title text-truncate text-decoration-none text-reset">' + value.novel_name + '<br> ' + value.chapter_name + ' </a>'+
                        '<div class="d-flex flex-row align-items-center">'+
                          '<a href="' + value.link + '" title="Đọc tiếp" class="btn btn-success mx-2">...</a>'+
                          '<a href="javascript:void(0);"  data-id-novel="' + value.id_novel + '" title="Xóa lịch sử" class="btn ntp_remove_readding_history btn-danger me-2">X</a>'+
                        '</div>'+
                      '</div>'
          });
        }
        $(wrap).html(html);
      }
    }
  }).trigger('ntp_history_load_locall');


  $('body').on('click', '.ntp_bookmark_remove',function (e) { 
    var _this = $(this);
    if($(_this).hasClass('ntp_locall')) {
     
      var bookmarks = localStorage.getItem('ntp_bookmarks');
      // console.log($(_this).attr('data-id-novel'));
      if (bookmarks) {
        
        bookmarks = JSON.parse(bookmarks);
        if (bookmarks.length !== 0) {
          var index_bm = null;
          $.each(bookmarks, function (index, value) {
              if(value.id == parseInt($(_this).attr('data-id-novel')) ) {
                index_bm = index;
              }
          });

          bookmarks.splice(index_bm, 1);
        }

        localStorage.setItem('ntp_bookmarks', JSON.stringify(bookmarks));

        $('body').trigger('ntp_bookmark_load_locall');
      }

    } else {
      var url = $(_this).attr('data-link');

      $.ajax({
        method: "DELETE",
        url: url,
        success: function (data) {
          $(_this).parents('.ntp_bookmarks_card').replaceWith(data.bookmarks);
        },
        error: function (error) {
  
        }
      });
    }

    e.preventDefault();
  });

  $('body').on('click', '.ntp_remove_readding_history',function (e) { 
    var _this = $(this);
    if($(_this).parents('.ntp_read_history').hasClass('ntp_read_history_locall')) { 
      var id_novel = $(this).attr('data-id-novel');
      var historys = localStorage.getItem('ntp_historys');
      var indexh = null;
      if (historys) {
        historys = JSON.parse(historys);
        if (historys.length !== 0) {
          $.each(historys, function (index, value) {
              if(value.id_novel == id_novel) {
                indexh = index;
              }
          });

          if(indexh != null) {
            historys.splice(indexh, 1);
            localStorage.setItem('ntp_historys', JSON.stringify(historys));
            $('body').trigger('ntp_history_load_locall');
          }
        }

      }

    } else {
      var url = $(_this).attr('data-link');
      $.ajax({
        method: "get",
        url: url,
        success: function (data) {
          $(_this).parents('.ntp_read_history_card').replaceWith(data.history);
        },
        error: function (error) {
  
        }
      });
    }

    e.preventDefault();
  });


  if($('#ntp_login_register_modal').length) {
    
    if ($('.ntp_novel_single').length) {
     
      var bookmarks = localStorage.getItem('ntp_bookmarks');
      var id = $('.ntp_novel_single').attr('data-novel-id');

      if (bookmarks) {
        bookmarks = JSON.parse(bookmarks); 

        if (bookmarks.length !== 0) {
          $.each(bookmarks, function (index, value) {
              if(value.id == id) {
                // console.log(id);
                $('.ntp_novel_single .ntp_mark>p').removeClass('text-success').addClass('text-danger').html('<i class="fa-solid fa-bookmark me-2" aria-hidden="true"></i>Hủy đánh dấu');
              }
          });
        }
      }
    }

    if($('.ntp_chapter_page').length) {
      var historys = localStorage.getItem('ntp_historys');
      var novel_name = $('.ntp_chapter_title').find('.ntp_novel_name').text();
      var chapter_name = $('.ntp_chapter_title').find('.ntp_chapter_name').text();
      var link = $(location).attr('href');
      var id_novel = $('.ntp_chapter_title').attr('data-id-novel');
      var link_novel = $('.ntp_chapter_title').attr('data-link-novel');
      if (historys) {
        historys = JSON.parse(historys);
      } else {
        historys = [];
      }

      var historyExist = false;

      if (historys.length !== 0) {
        $.each(historys, function (index, value) {
            if(value.id_novel == id_novel) {
              historyExist = true;
              value.link = link;
              value.novel_name = novel_name;
              value.chapter_name = chapter_name;
              value.link_novel = link_novel;
            }
        });
      }

      if (!historyExist) {
        historys.push({
          novel_name: novel_name,
          chapter_name: chapter_name,
          id_novel: id_novel,
          link: link,
          link_novel:link_novel
        });
      }
      localStorage.setItem('ntp_historys', JSON.stringify(historys));

    }
  }

  $('body').on('click', '.ntp_mark', function () {
    var _this = $(this);
    var id = $(_this).attr('data-novel-id');
    var url = $(_this).attr('data-link');
    var name = $(_this).attr('data-name');
    var novel_url = $(_this).attr('data-novel-link');
    var _p = $(_this).find('>p');
    var _data = {
      id_novel: id
    };

    $.ajax({
      method: "POST",
      url: url,
      data: JSON.stringify(_data),
      contentType: 'application/json; charset=utf-8',
      dataType: 'json',
      success: function (data) {
        $(_p).html(data.message);
        $('.ntp_count_bookmark').html(data.bookmarks + ' đánh dấu')
        if (data.status == 1) {
          $(_p).removeClass('text-danger').addClass('text-success');
        } else if (data.status == 0) {
          $(_p).removeClass('text-success').addClass('text-danger');
        } else if (data.status == 3) {
          var bookmarks = localStorage.getItem('ntp_bookmarks');
          if (bookmarks) {
            bookmarks = JSON.parse(bookmarks);
          } else {
            bookmarks = [];
          }

          var bookmarlExist = false;
          var index_bookmar = null;

          if (bookmarks.length !== 0) {
            $.each(bookmarks, function (index, value) {
                if(value.id == id) {
                  bookmarlExist = true;
                  index_bookmar = index;
                }
            });
          }

          if (bookmarlExist) {
            bookmarks.splice(index_bookmar, 1);
            $(_p).removeClass('text-danger').addClass('text-success').html('<i class="fa-solid fa-bookmark me-2" aria-hidden="true"></i>Đánh dấu');
          } else {
            bookmarks.push({
              id: id,
              title: name,
              link: novel_url
            });
            $(_p).removeClass('text-success').addClass('text-danger').html('<i class="fa-solid fa-bookmark me-2" aria-hidden="true"></i>Hủy đánh dấu');
          }
          localStorage.setItem('ntp_bookmarks', JSON.stringify(bookmarks));

        }
      },
      error: function (error) {

      }
    });

  });

  $('body').on('click', '.ntp-show-hide-pass', function () {
    var _this = $(this);
    var _wrap = $(_this).parents('.ntp_pass_wrap');
    var input = $(_wrap).find('input');
    var type = $(input).attr('type');

    if (type === "password") {
      $(input).attr('type','text');
      $(this).addClass('text-danger').removeClass('text-success');
    } else {
      $(input).attr('type','password');
      $(this).addClass('text-success').removeClass('text-danger');
    }
  });

  $('body').on('click', '.ntp_alert_close .btn-close', function () {
    $('.alert-success').fadeOut(200);
    $('.alert-danger ').fadeOut(200);
  });

  $('body').on('ntp-alert-out', function () {
    setTimeout(function () {
      $('.alert-success').fadeOut(200);
      $('.alert-danger ').fadeOut(200);
    }, 10000);
  });

});
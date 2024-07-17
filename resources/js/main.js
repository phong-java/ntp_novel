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
          $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);

        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);

        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);
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
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);
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
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);
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
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
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
          if (data.av_update.avatar_change_status == 1) {
            $('.ntp_av_wrap').find('.alert-danger').fadeOut(200);
            $('.ntp_av_wrap').find('.alert-success').fadeIn(200).html(data.av_update.avatar_change+btn_close_success);
            var _av = $('.ntp_av');
            $(_av).each(function () {
              $(this).attr('src', data.av_update.av_link);
            });
          } else if (data.av_update.avatar_change_status == 0) {
            $('.ntp_av_wrap').find('.alert-success').fadeOut(200);
            $('.ntp_av_wrap').find('.alert-danger').fadeIn(200).html(data.av_update.avatar_change+btn_close_danger);
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);
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
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);
          
          setTimeout(function(){
            $(pa).find('.btn-close').trigger('click');
          },1000);
        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);
          
        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
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

  $('body').on('click','.ntp_chitiettruyen',function() {
    var _this = $(this)
    var url = $(_this).attr('data-link');
    $.ajax({
      method: "POST",
      url: url,
      success: function (data) {
        var ntp_edit_novel_poup  = $('#ntp_edit_novel_poup ');
        $(ntp_edit_novel_poup ).find('.modal-body').html(data);
      },
      error: function (error) {

      }
    });
  });

  $('body').on('click','.ntp_admin_btn_update_novel',function() {
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
            $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);
            
            setTimeout(function(){
              $(pa).find('.btn-close').trigger('click');
            },1000);
          } else if (data.status == 0) {
            $(_form).find('.alert-success').fadeOut(200);
  
            var errors = data.errors;
            var errorMessages = '';
            for (var key in errors) {
              errorMessages += errors[key] + '</br>';
            }
            $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
          }

          $('body').trigger('ntp-alert-out');
          
        },
        error: function (error) {
  
        } 
      });

      $('body').trigger('ntp_admin_load_novel_list');

  });

  $('#xet_duyet_tacpham-tab').click(function(){
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);
          $('body').trigger('ntp_author_load_novel_list');
          

        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);
          $('body').trigger('ntp_author_load_novel_list');

        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
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
            switch(key) {
              case 'id':
                $(_wrap).find('.'+key).val(chapters[key]);
                break;
              case 'iPublishingStatus':
                if(chapters[key] == 1) {
                  $(_wrap).find('#xuly_chapter').prop('checked', true);
                } else {
                  $(_wrap).find('#xuly_chapter').prop('checked', false);
                }
                break;
              case 'iPublishingStatus':
                if(chapters[key] == 1) {
                  $(_wrap).find('#xuly_chapter').prop('checked', true);
                } else {
                  $(_wrap).find('#xuly_chapter').prop('checked', false);
                }
                break;
              case 'iStatus':
                if(chapters[key] == 1) {
                  $(_wrap).find('#trangthai_chapter').prop('checked', true);
                } else {
                  $(_wrap).find('#trangthai_chapter').prop('checked', false);
                }
                break;
              case 'icharges':
                if(chapters[key]== 1) {
                  (_wrap).find('.'+key).html('Có tính phí');
                } else {
                  (_wrap).find('.'+key).html('Không tính phí');
                }
                break;
              default:
                $(_wrap).find('.'+key).html(chapters[key]);
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
    var trangthai = $(_form).find('#trangthai_chapter').is(':checked')? 1 : 0;
    var id = $(pa).find('#idChapter').val();
    var id_novel = $(_this).attr('data-id-novel');
    var _data = {
      xuly: xuly,
      trangthai: trangthai,
      id: id,
      id_novel:id_novel,
      _token:$(_form).find('input[name="_token"]').val()
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message+btn_close_success);
          $('body').trigger('ntp_author_load_novel_list');
          $('#ntp_mucluc').html(data.table);
        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages+btn_close_danger);
        }

        $('body').trigger('ntp-alert-out');
      },
      error: function (error) {

      }
    });
  });

  $('body').on('click','.ntp_alert_close .btn-close', function () {
    $('.alert-success').fadeOut(200);
    $('.alert-danger ').fadeOut(200);
  });

  $('body').on('ntp-alert-out', function () {
    setTimeout(function () {
      $('.alert-success').fadeOut(200);
      $('.alert-danger ').fadeOut(200);
    }, 6000);
  });

});
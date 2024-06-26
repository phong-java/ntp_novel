// const { error } = require("laravel-mix/src/Log");

$(document).ready(function () {
  $("button.phong").on("click", function (event) {
    alert('phongllll');
  });

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
          $(_form).find('.alert-success').fadeIn(200).html(data.message);

        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages);
        }
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message);

        } else if (data.status == 0) {
          $(_form).find('.alert-success').fadeOut(200);

          var errors = data.errors;
          var errorMessages = '';
          for (var key in errors) {
            errorMessages += errors[key] + '</br>';
          }
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages);
        }
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
        console.log(data);
        if (data.status == 1) {
          $(_form).find('.alert-danger').fadeOut(200);
          $(_form).find('.alert-success').fadeIn(200).html(data.message);
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
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages);
        }
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message);
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
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages);
        }
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
          $(_form).find('.alert-success').fadeIn(200).html(data.message);
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
          $(_form).find('.alert-danger').fadeIn(200).html(errorMessages);
        }

        if (data.av_update.avatar_change_status == 1) {
          $('.ntp_av_wrap').find('.alert-danger').fadeOut(200);
          $('.ntp_av_wrap').find('.alert-success').fadeIn(200).html(data.av_update.avatar_change);
          var _av = $('.ntp_av');
          $(_av).each(function () {
            $(this).attr('src', data.av_update.av_link);
          });
        } else if (data.av_update.avatar_change_status == 0) {
          $('.ntp_av_wrap').find('.alert-success').fadeOut(200);
          $('.ntp_av_wrap').find('.alert-danger').fadeIn(200).html(data.av_update.avatar_change);
        }

        $('body').trigger('ntp-alert-out');
      },
      error: function (error) {

      }
    });
    event.preventDefault();
  });

  $('body').on('change','#ntp_form_update_infor_user input[name="anhdaidien"]',function(){
    var fileInput = $(this)[0];
    var file = fileInput.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.ntp_av_wrap .ntp_av ').attr('src', e.target.result);
        }

        reader.readAsDataURL(file);

        $('body').find('.ntp_btn_update_infor_user').trigger('click');
    } else {
        $('#preview_image').hide();
        $('#preview_image').attr('src', '#');
    }
  });








  $('body').on('ntp-alert-out', function () {
    setTimeout(function () {
      $('.alert-success').fadeOut(200);
      $('.alert-danger ').fadeOut(200);
    }, 2000);
  });






});
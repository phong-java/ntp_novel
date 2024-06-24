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


  // $('button.ntp_btn_cat_create').on('click', function () {
  //   var form = $('.ntp_cat_create')[0];
  //   var _data = new FormData(form);
  //   var token = $(form).find('input[name="_token"]').val();

  //   $.ajax({
  //     method: "get",
  //     url: $(form).attr('action'),
  //     processData: false,
  //     contentType: false,
  //     data: _data,

  //     success: function (response) {
  //       console.log('response');
  //       console.log(response);
  //     },
  //     error: function (error) {
  //       console.log('error');
  //       console.log(error);

  //     }
  //   });

  // });

});
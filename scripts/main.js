$('.my').change(function() {
    if ($(this).val() != '') $(this).prev().text($(this).file.name);
    else $(this).prev().text('Выберите файл');
});

function handleFileSelectSingle(evt) {
var file = evt.target.files; // FileList object

var f = file[0]

  // Only process image files.
  if (!f.type.match('image.*')) {
    alert("Только изображения....");
  }

  var reader = new FileReader();

  // Closure to capture the file information.
  reader.onload = (function(theFile) {
    return function(e) {
      // Render thumbnail.
      var span = document.createElement('span');
      span.innerHTML = ['<img class="thumb_photo" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/>'].join('');
      document.getElementById('output').innerHTML = "";
      document.getElementById('output').insertBefore(span, null);
    };
  })(f);

  // Read in the image file as a data URL.
  reader.readAsDataURL(f);
}




$(document).ready(function () {
    $("#register_form").submit(function(e) {
      e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'send_reg_form.php',
            data: form_data,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#send_form').val('Отправляем...');
            },
            success: function(d) {
                $(this).find('input').val('');
                $.fancybox.open({src  : '#success_register', type : 'inline',});
                setTimeout(function(){
                    $.fancybox.close(true);
                }, 4000);
            },
            error: function(xhr){
                alert('Ошибка! Попробуйте позже!');
            }
        });
        e.preventDefault();
    });
    $("#phone").mask("8 (999) 999-9999");

    $(".navbar-toggler-icon").on('click', function(){
        $("#navbar1").animate({left: "0"}, 400, function(){
            $("#navbar1").addClass('show');
          });
    });

    $("#close_menu").on("click", function(){
      $("#navbar1").animate({left: "-100vw"}, 400, function(){
        $("#navbar1").removeClass('show collapse');
      });
    });

    $(".see_pass").on("click", function(){
      if ($("input[name=password]").attr("type") == "password") {
          $("input[name=password]").attr({"type":"text"});
          $(this).addClass("not_see");
      } else{
        $("input[name=password]").attr({"type":"password"});
        $(this).removeClass("not_see"); 
      }
    });


    $("#auth_form").submit(function(e) {
      e.preventDefault();
        var form_data_auth = new FormData(this);
        $("input[name=password]").attr({"type":"password"});
        $(".see_pass").removeClass("not_see"); 
        $.ajax({
            type: 'POST',
            url: '...',
            data: form_data_auth,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#send_form').val('ПОДОЖДИТЕ...');

            },
            success: function(d) {
                $(this).find('input').val('');
                
            },
            error: function(xhr){
                alert('Ошибка! Попробуйте позже!');
            }
        });
        e.preventDefault();
    });

    $('.slider').slick({
      autoplay: false,
      dots: true
    });
    $('.slider_lk').slick({
      autoplay: false,
      dots: true
    });

    // $('.lights_exapmle').on('click', function(){
    //   var name_modal = $(this).data('modal');
    //   $.fancybox.open({src  : name_modal, type : 'inline',});
    // });
    $('.lights_exapmle').fancybox({
        'titlePosition' : 'inside',
        'transitionIn' : 'none',
        'transitionOut' : 'none'
    });
    
    
        // $.fancybox.close(true);
    
    

  });

$("#time_remain")
  .countdown("2019/12/13", function(event) {
    $(this).html(
      event.strftime('<span>%D дней</span> %H ч %m мин %S сек')
    );
  });


function get() {
     var token = $('meta[name="csrf-token"]').attr("content");
     var cours = $('#sc').html();
     $.post( "/studying/get_page",
          {
            cours: cours,
            _token: token,
          },
         onAjaxSuccessAuth);
  }

function onAjaxSuccessAuth(data) {
   var dt = data;
    $('#sc').html(dt);
}
get();
//Получаем блок с расписанием по Ajax

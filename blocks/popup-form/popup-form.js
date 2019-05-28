/*--------------------------------------------------------------
# Popup Form
--------------------------------------------------------------*/
jQuery('.callBack__link').magnificPopup({
  type:'inline',
  midClick: true
});

jQuery(".order-form input[name='phone']").on('click', function(event) {
  jQuery(this).css('border', '1px solid gray');
});

jQuery(".f1").submit(function() {
  var form = jQuery(this);
  var phone = jQuery(this).find('input[name="phone"]');
  var message = jQuery(this).find('.message');

  if ( phone.val() == "") {
    message.fadeIn(300).addClass('alert-danger').text('Введите Ваш телефон');
    phone.css('border', '1px solid red').focus();
  } else {
    message.fadeIn(300).removeClass('alert-danger').addClass('alert-success').text('Сообщение успешно отправлено');
    phone.css('border', '1px solid gray');
  //yaCounter46416018.reachGoal('ORDER'); // изменить номер счётчика иначе ошибка !!!
    jQuery.ajax({
      type: "POST",
      url: "/wp-content/themes/storefront-child/mail.php",
      data: form.serialize(),
      // success: function ( serverAnswer ) { message.text( "Сообщение отправлено: " + serverAnswer ); }
      success: function ( serverAnswer ) { message.html('<span style="color:green;">Сообщение успешно отправлено</span>'); }
    });
  }//if
return false;
});
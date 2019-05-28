jQuery(document).ready(function() {

jQuery('.callBack__link').magnificPopup({
  type:'inline',
  midClick: true
});
//Одинковая высота
// jQuery('.r1__item').matchHeight();

//Маска для телеофона
jQuery("input[type=tel]").inputmask("+7 (999) 999-99-99");


});//ready

$(document).ready(function(){
  $('.arrow').click(function() {
    $('.selectBox').slideToggle(200).css('borderTop', 'none');
    $('.selectBox li').click(function() {
        $('.mehidden').val($(this).text());
        $('.default').text($(this).text());
        $('.selectBox').slideUp(200);
    });
});
});


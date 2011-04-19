$(document).ready(function(){
  $('#code-1').focus();
  $('#code-input input').keypress(function () {
    var $this = $(this);
    if ($this.val() != null){
      if ($this.attr('id') == 'code-5') {
        $('#code-input').submit();
      }
        $this.next().Attr('disabled', 'false').focus();
    }
  });
});
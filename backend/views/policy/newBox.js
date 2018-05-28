$(document).ready(function($){
    $('.policy-form .add-procStep').click(function () {
        var n = $('.text-procStep').length + 1;
        var box_html = $('<p class="text-procStep"><label for="procStep' + n + '">Procedure Step <span class="procStep-number">' + n + '</span></label><input type="text" class="form-control" name="procStep[]" value="" id="item' +n+'" /><a href="#" class="remove-proStep">Remove</a></p>');
        box_html.hide();
        $('.my-form p.text-procStep:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });

    $('.policy-form').on('click', '.remove-procStep', function(){
    if ($('.text-procStep').length > 1) {
        $(this).parent().fadeOut('slow', function(){
        $(this).remove();
        $('.procStep-number').each(function(index){
            $(this).text(index +1);
        });
    });
    }
    return false;
});
});
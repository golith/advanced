jQuery(document).ready(function($){
    $('.my-form .add-items').click(function(){
        var n = $('.text-items').length + 1;
        var box_html = $('<p class="text-items"><label for="item' + n + '">Item <span class="items-number">' + n + '</span></label> <input type="text" class="form-control" name="items[]" value="" id="item' + n + '" /> <a href="#" class="remove-items">Remove</a></p>');
        box_html.hide();
        $('.my-form p.text-items:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });

    $('.my-form').on('click', '.remove-items', function(){
        //$(this).parent().css( 'background-color', '#FF6C6C' );
        if($('.text-items').length > 1){
            $(this).parent().fadeOut('slow', function() {
                $(this).remove();
                $('.items-number').each(function(index){
                    $(this).text( index + 1 );
                });
            });
        }
        return false;
    });
});
jQuery(document).ready(function( $ ){
	$('#tabs > div').hide();
    $('#tabs div:first').show();
    $('#tabs ul li:first').addClass('active');
    $('#tabs ul li a').click(function(){
        $('#tabs ul li.active').removeClass('active');
        $(this).parent().addClass('active');
        var selectedTab=$(this).attr('href');
        $('#tabs > div').fadeOut(function() {
            $(selectedTab).delay(200).show();
        });        
        return false;
    });
});
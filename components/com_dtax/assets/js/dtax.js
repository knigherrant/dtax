var JST = (function($){
    var fn = {
        log : function(knigherrant){
            console.log(knigherrant);
        },
        uploadImage : function(){
            var 
                formData = new FormData(),
                imggif = $('#loadingmessage').find('img').attr('src'),
                avatar = $('#userProfile .userAvatar img')
            ; 
            if($('#cAvatar').val()){
                    formData.append('avatar', $('#cAvatar')[0].files[0]);
            }
            avatar.attr('src', imggif);
	    $.ajax({
                url: "index.php?option=com_dtax&task=frontend.uploadAvatar",
                type: "POST",
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false   // tell jQuery not to set contentType
              }).done(function( data ) {
                      $('#loadingmessage').hide();
                      avatar.attr('src', data);
                      
              });		   
        }
    };
    return fn;
})(jQuery);

jQuery(function($){
    $('#jform_created_by').parents('.control-group').hide();
<<<<<<< HEAD
    $('.icon-trash').click(function(){
        var item = $(this);
        item.parents('.jItem').fadeOut();
        $.ajax({
            url: "index.php?option=com_dtax&task=removeItem&t=" + item.data('action') + '&id=' + item.data('id'),
          }).done(function( data ) {
              console.log(data);
          });	
    })
=======
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
})
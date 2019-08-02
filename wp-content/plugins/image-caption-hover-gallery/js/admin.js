jQuery(document).ready(function($) {
    $('.colorpicker').wpColorPicker();

    var active = false,
        sorting = false;
    
    $( "#wcpinner" )
    .accordion({
        header: "> div > h3",
        collapsible: true,
        activate: function( event, ui){
            //this fixes any problems with sorting if panel was open (remove to see what I am talking about)
            if(sorting)
                $(this).sortable("refresh");   
        }
    })
    .sortable({
        handle: "h3",
        placeholder: "ui-state-highlight",
        start: function( event, ui ){
            //change bool to true
            sorting=true;
            
            //find what tab is open, false if none
            active = $(this).accordion( "option", "active" ); 
            
            //possibly change animation here
            $(this).accordion( "option", "animate", { easing: 'swing', duration: 0 } );
            
            //close tab
            $(this).accordion({ active:false });
        },
        stop: function( event, ui ) {
            ui.item.children( "h3" ).triggerHandler( "focusout" );
            
            //possibly change animation here; { } is default value
            $(this).accordion( "option", "animate", { } );
            
            //open previously active panel
            $(this).accordion( "option", "active", active );
            
            //change bool to false
            sorting=false;
        }
    });

    var count = $('.wcp-main-wrap .group:last-child').attr('id');
    
    $('.wcp-main-wrap .group').each(function(index, el) {
    	if (parseInt($(this).attr('id')) > parseInt(count)) {
    		count = $(this).attr('id');
    	};
    });
    
    $(".add").click(function() {
        count = parseInt(count) + 1;
        var clone_this = $('.wcp-main-wrap div#1').clone(true);
        $(clone_this).attr('id', count);
        $(clone_this).find('input, select, textarea').each(function(index, el) {
            var old_name = $(this).attr('name');
            var new_name = old_name.replace(/[0-9]/g, count);
            $(this).attr('name', new_name);
        });
        $(clone_this).appendTo('.wcp-main-wrap');
    });

    $(".wcp-main-wrap").on('click', '.button-delete', function(event) {
        event.preventDefault();
        var this_col = $(this).closest('.group').attr('id');
        if (this_col == '1' || this_col == 1) {
            alert('Sorry, you can not delete first Column!');
        } else {
            $(this).closest('.group').remove();
        }
    });

    // Media Uploader
    var image_hover_gallery_upload;
     
    jQuery('.upload_image_button').live('click', function( event ){
     
        event.preventDefault();

        var this_widget = '#' + jQuery(this).closest('.group').attr('id');
     
     
        // Create the media frame.
        image_hover_gallery_upload = wp.media.frames.image_hover_gallery_upload = wp.media({
          title: jQuery( this ).data( 'title' ),
          button: {
            text: jQuery( this ).data( 'btntext' ),
          },
          multiple: false  // Set to true to allow multiple files to be selected
        });
     
        // When an image is selected, run a callback.
        image_hover_gallery_upload.on( 'select', function() {
          // We set multiple to false so only get one image from the uploader
          attachment = image_hover_gallery_upload.state().get('selection').first().toJSON();
            
            
             jQuery(this_widget).find('.image-url').val(attachment.url);
             jQuery(this_widget).find('.image-title').val(attachment.title);
             jQuery(this_widget).find('.alt-text').val(attachment.alt);
             // jQuery(this_widget).find('.img-prev').html('<img src="'+attachment.url+'" width="100%">')
        });
     
        // Finally, open the modal
        image_hover_gallery_upload.open();
    });       
});
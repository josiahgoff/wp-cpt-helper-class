jQuery(document).ready(function($) {
    if ($('.wpmon-cpt-date-field')[0]) {
        $('.wpmon-cpt-date-field').datepicker({
            dateFormat: 'm/dd/yy'
        });
    }

	if ($('.wpmon-cpt-time-field')[0]) {
		$('.wpmon-cpt-time-field').timepicker({
			// This time format isn't working
			timeFormat: 'h:mm p',
			minTime: '9:00 AM',
			maxTime: '8:00 PM'
		})
	}


    //----------------------------------------------------------------
    // This handles selecting an existing URL for the 'more info' link
    //----------------------------------------------------------------

    $('body').on('click', '.url-link-btn', function (event) {
        wpActiveEditor = true; //we need to override this var as the link dialogue is expecting an actual wp_editor instance
        wpLink.open(); //open the link popup
        $('.link-target, #link-options > div:nth-child(3n)').remove();
        return false;
    });

    $('body').on('click', '#wp-link-submit', function (event) {
        var linkAtts = wpLink.getAttrs();//the links attributes (href, target) are stored in an object, which can be access via  wpLink.getAttrs()
        $('.content_link_field').val(linkAtts.href);//get the href attribute and add to a textfield, or use as you see fit
        wpLink.textarea = $('body'); //to close the link dialogue, it is again expecting an wp_editor instance, so you need to give it something to set focus back to. In this case, I'm using body, but the textfield with the URL would be fine
        wpLink.close();//close the dialogue
        //trap any events
        event.preventDefault ? event.preventDefault() : event.returnValue = false;
        event.stopPropagation();
        return false;
    });

    $('body').on('click', '#wp-link-cancel, #wp-link-backdrop, #wp-link-close', function (event) {
        wpLink.textarea = $('body');
        wpLink.close();
        event.preventDefault ? event.preventDefault() : event.returnValue = false;
        event.stopPropagation();
        return false;
    });


    //----------------------------------------------------------------
    // This handles getting the media uploader to work for images
    //----------------------------------------------------------------

    var customMediaSelector = {
        init: function () {
            $('.custom_media_add').on('click', function (e) {
                var $el;
                e.preventDefault();
                $el = customMediaSelector.el = $(this).closest('div');
                $el.image = $el.find('.custom_media_image');
                $el.id = $el.find('.custom_media_id');
                customMediaSelector.frame().open();
            });

            $('.custom_media_remove').on('click', function (e) {
                var $el = $(this).closest('div');
                e.preventDefault();

                $el.find('.custom_media_image').attr('src', '').hide();
                $el.find('.custom_media_id').val('');
                $el.find('.custom_media_add, .custom_media_remove').toggle();
            });
        },

        // Update the selected image in the media library based on the attachment ID in the field.
        open: function () {
            var selection = this.get('library').get('selection'),
                attachment, selected;

            selected = customMediaSelector.el.id.val();

            if (selected && '' !== selected && -1 !== selected && '0' !== selected) {
                attachment = wp.media.model.Attachment.get(selected);
                attachment.fetch();
            }

            selection.reset(attachment ? [attachment] : []);
        },

        // Update the control when an image is selected from the media library.
        select: function () {
            var $el = customMediaSelector.el,
                selection = this.get('selection'),
                sizes = selection.first().get('sizes'),
                size;

            // Insert the selected attachment id into the target element.
            $el.id.val(selection.first().get('id'));

            // Update the image preview tag.
            if (sizes) {
                // The image size to show for the preview.
                size = sizes['thumbnail'] || sizes.medium;
            }

            size = size || selection.first().toJSON();
            $el.image.attr('src', size.url).show();
            $el.find('.custom_media_add, .custom_media_remove').toggle();
            selection.reset();
        },

        // Initialize a new frame or return an existing frame.
        frame: function () {
            if (this._frame)
                return this._frame;

            this._frame = wp.media({
                title: 'Set Custom Featured Image',
                library: {
                    type: 'image'
                },
                button: {
                    text: 'Set image'
                },
                multiple: false
            });

            this._frame.on('open', this.open).state('library').on('select', this.select);
            return this._frame;
        }
    };
});


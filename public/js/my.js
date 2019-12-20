$(document).ready(function() {

    if ($('div.header-message').length > 0) {

        $("div.header-message").removeClass( "gone" );
        $("div.content-page").css("padding-top", "116px");
    }

    $(document).on("click", "span.navigation-toggle-outer", function() {

        openNav();

        return false;
    });

    $(document).on("click", "button.close-message-button", function() {

        $("div.header-message").addClass("gone");

        return false;
    });

    $(document).on("click", "button.close-privacy-message", function() {

        $("div.header-message").remove();
        $("div.content-page").css("padding-top", "68px");

        $.cookie("privacy", "close", { expires : 7, path: '/' });

        return false;
    });

    $("#item-image-upload").fileupload({
        formData: {accountId: account.id, accessToken: account.accessToken},
        name: 'image',
        url: "/api/" + options.api_version + "/method/items.uploadImg",
        dropZone:  '',
        dataType: 'json',
        singleFileUploads: true,
        multiple: false,
        maxNumberOfFiles: 1,
        maxFileSize: constants.MAX_FILE_SIZE,
        acceptFileTypes: "", // or regex: /(jpeg)|(jpg)|(png)$/i
        "files":null,
        minFileSize: null,
        messages: {
            "maxNumberOfFiles":"Maximum number of files exceeded",
            "acceptFileTypes":"File type not allowed",
            "maxFileSize": "File is too big",
            "minFileSize": "File is too small"},
        process: true,
        start: function (e, data) {

            console.log("start");

            $('div.item-actions').addClass("hidden");
            $('div.item-image-progress').removeClass("hidden");

            $("#item-image-upload").trigger('start');
        },
        processfail: function(e, data) {

            console.log("processfail");

            if (data.files.error) {

                $infobox.find('#info-box-message').text(data.files[0].error);
                $infobox.modal('show');
            }
        },
        progressall: function (e, data) {

            console.log("progressall");

            var progress = parseInt(data.loaded / data.total * 100, 10);

            $('div.item-image-progress').find('.progress-bar').attr('aria-valuenow', progress).css('width', progress + '%').text(progress + '%');
        },
        done: function (e, data) {

            console.log("done");

            var result = jQuery.parseJSON(data.jqXHR.responseText);

            if (result.hasOwnProperty('error')) {

                if (result.error === false) {

                    if (result.hasOwnProperty('imgUrl')) {

                        Profile.addPostImg(result.imgUrl);

                        $("div.img_container").show();

                        $('div.item-actions').removeClass("hidden");
                        $('div.item-image-progress').addClass("hidden");

                        if ($("div.new-post-img-item").length >= options.post_max_images ) {

                            $('div.item-add-image').addClass("hidden");
                        }
                    }

                } else {

                    $infobox.find('#info-box-message').text(result.error_description);
                    $infobox.modal('show');
                }
            }

            $("#item-image-upload").trigger('done');
        },
        fail: function (e, data) {

            console.log(data.errorThrown);
        },
        always: function (e, data) {

            console.log("always");

            $('div.item-actions').removeClass("hidden");
            $('div.item-image-progress').addClass("hidden");

            if ($("div.new-post-img-item").length < options.post_max_images ) {

                $('div.item-add-image').removeClass("hidden");
            }

            $("#item-image-upload").trigger('always');
        }
    });


    $("textarea[name=postText]").autosize();

    $("textarea[name=postText]").bind('keyup mouseout', function() {

        var max_char = 1000;

        var count = $("textarea[name=postText]").val().length;

        $("span#word_counter").empty();
        $("span#word_counter").html(max_char - count);

        event.preventDefault();
    });

});
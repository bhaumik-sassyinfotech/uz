
jQuery(document).ready(function () {
    jQuery.validator.addMethod("alphanumeric", function (value, element)
    {
        console.log(value);
        console.log(element);
        return this.optional(element) || /^[a-zA-Z0-9 ]+$/.test(value);
    }, "Please enter proper data");
    jQuery.validator.addMethod("youtubelink", function (value, element)
    {
        console.log(value);
        console.log(element);
        return this.optional(element) || /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/.test(value);
    }, "Please enter proper link");

    $("#cmsEditForm").validate({
        rules: {
            page_title: {
                required: true,
                alphanumeric: true
            },
            page_content: {
                required: true,
                alphanumeric: true

            },
            page_link: {
                required: true,
                youtubelink: true
            }

        },
        messages: {
            page_title: {
                required: "Page title is required.",
            },
            page_content: {
                required: "Page content is required."
            },
            page_link: {
                required: "Page link is required.",
                pattern: "Please enter proper youtube embed link."
            }

        }

    });

});

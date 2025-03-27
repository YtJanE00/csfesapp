$(function() {
    $('#addTitleForm').validate({
        rules: {
            title: {
                required: true,
            },
            office: {
                required: true,
            },
            speaker: {
                required: true
            },
            training_date: {
                required: true
            },
            training_venue: {
                required: true
            },
        },
        messages: {
            title: {
                required: "Please enter Training Title",
            },
            office: {
                required: "Please enter Office Handling Training",
            },
            speaker: {
                required: "Please enter Speaker Name",
            },
            training_date: {
                required: "Please enter Training Date",
            },
            training_venue: {
                required: "Please enter Training Venue",
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12, .col-md-6').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});

$(function() {
    $('#addQuestionForm').validate({
        rules: {
            question: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Please enter Training Question",
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});

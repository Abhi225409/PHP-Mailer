
$(document).ready(function () {
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();
        $('.error').text('');
        var isValid = true;
        var recaptchaResponse = grecaptcha.getResponse();

        // Validate Name field
        if ($('#name').val() === '') {
            $('#nameError').text('Name is required.');
            isValid = false;
        }

        // Validate Email field
        if ($('#email').val() === '') {
            $('#emailError').text('Email is required.');
            isValid = false;
        } else if (!validateEmail($('#email').val())) {
            $('#emailError').text('Please enter a valid email address.');
            isValid = false;
        }

        // Validate Phone field
        if ($('#phone').val() === '') {
            $('#phoneError').text('Phone number is required.');
            isValid = false;
        }

        // Validate Notes field
        if ($('#notes').val() === '') {
            $('#notesError').text('Notes are required.');
            isValid = false;
        }

        // Validate reCAPTCHA
        if (recaptchaResponse.length === 0) {
            $('#captchaError').text('Please verify the captcha.');
            isValid = false;
        }

        // If form is valid, submit via AJAX
        if (isValid) {
            var formData = $(this).serialize();
            $('#submit_button').addClass('d-none');
            $('#loader').removeClass('d-none');
            $.ajax({
                url: 'add.php',
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#contactForm')[0].reset();
                    grecaptcha.reset();
                    $('.thankyou').removeClass('d-none');

                    $('#loader').addClass('d-none');
                    $('#submit_button').removeClass('d-none');

                    setTimeout(function () {
                        $('.thankyou').addClass('d-none');
                    }, 5000);
                },
                error: function () {
                    alert('Error occurred. Please try again.');
                }
            });
        }
    });

    // Email validation function
    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});

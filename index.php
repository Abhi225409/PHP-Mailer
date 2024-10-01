<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>

    <section class="contact_form">
        <h2 class="text-center mb-5">Contact Us</h2>
        <div class="thankyou mb-5 text-center d-none">
            <h4>Thankyou For Contacting Us!!</h4>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrapper">
                        <form id="contactForm">
                            <div>
                                <input type="text" placeholder="Name" id="name" name="name">
                                <span class="error" id="nameError"></span>
                            </div>
                            <div>
                                <input type="email" placeholder="Email" id="email" name="email">
                                <span class="error" id="emailError"></span>
                            </div>
                            <div>
                                <input type="tel" placeholder="Phone" id="phone" name="phone">
                                <span class="error" id="phoneError"></span>
                            </div>
                            <div>
                                <textarea id="notes" name="notes" rows="4" placeholder="Message....."></textarea>
                                <span class="error" id="notesError"></span>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="g-recaptcha" data-sitekey="6LdTqVQqAAAAAJVpoRe6MIb0Ubr2_yDzby8l_pzW"></div>
                                <span class="error" id="captchaError"></span>
                            </div>
                            <div class="mt-3 d-flex justify-content-center" id="submit_button">
                                <button type="submit">Submit</button>
                            </div>
                            <div class="mt-3 d-flex justify-content-center d-none" id="loader">
                                <span class="loader"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
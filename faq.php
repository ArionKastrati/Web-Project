<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>FAQ</title>

  <style type="text/css">
    body {
      background: white;
      font-family: monospace;
    }

    .faq-item {
      margin-bottom: 40px;
      margin-top: 30px;
    }

    .faq-body {
      display: none;
      margin-top: 30px;
    }

    .faq-wrapper {
      width: 100%;
      margin: 0 auto;
    }

    .faq-inner {
      padding: 5px;
      background: white;
      font-size: 15px;
    }

    .faq-plus {
      float: right;
      font-size: 1.2em;
      line-height: 1em;
      cursor: pointer;
    }

    hr {
      background-color: #9b9b9b;
    }

    
    .row {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}

.faq-wrapper {
  flex: 1;
  width: 70%; /* Adjust the width as needed */
  margin: 0 auto;
}

.col-lg-7 {
  flex: 0 0 30%; /* Adjust the width as needed */
  max-width: auto;
  margin: 0 auto;
  text-align: center;
}

#error-report-form {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 30px;
}

#error-description {
  width: 100%;
  height: 100px;
  margin-bottom: 15px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-family: monospace;
}

#user-email {
  width: 100%;
  margin-bottom: 15px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

#error-report-form button[type="submit"] {
  color: black;
  background-color: #c5837c;
  border-color: #bd726b;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

#error-report-form button[type="submit"]:hover {
  color: #fff;
  background-color: #c5837c;
  border-color: #c17a74;}


  </style>
  
  
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/style.css" rel="stylesheet">

</head>

<body>
  <!-- Topbar Start -->
  <?php
  include 'includes/topbar.php';
  ?>
  <!-- Topbar End -->


  <!-- Navbar Start -->
  <?php
  include 'includes/navbar.php';
  ?>
  <!-- Navbar End -->


  <!-- Page Header Start -->
  <div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
      <h1 class="font-weight-semi-bold text-uppercase mb-3">FAQs</h1>
      <div class="d-inline-flex">
        <p class="m-0"><a href="index.php">Home</a></p>
        <p class="m-0 px-2">-</p>
        <p class="m-0">FAQs</p>
      </div>
    </div>
  </div>
  <!-- Page Header End -->


  
    <div class="container">
    <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Contact For Any Questions</span></h2>
        </div>
        <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Your Name"
                            value="<?php 
                                if(isset($_SESSION["userid"]))
                                echo $_SESSION["fullname"]; 
                            ?>"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Your Email"
                            value="<?php 
                                if(isset($_SESSION["userid"]))
                                echo $_SESSION["email"]; 
                            ?>"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" placeholder="Subject"
                                required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="6" id="message" placeholder="Question"
                                required="required"
                                data-validation-required-message="Please enter your Question"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Submit
                                Question</button>
                        </div>
                    </form>
                </div>
            </div>
      <div class="row">
        <div class="faq-wrapper">
          <div class="faq-inner">
            <div class="faq-item">
              <h3>
                What is an FAQ page ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book.
              </div>
            </div>
            <hr>
            <div class="faq-item">
              <h3>
                What is an FAQ page ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book.
              </div>
            </div>
            <hr>
            <div class="faq-item">
              <h3>
                What is an FAQ page ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book.
              </div>
            </div>
            <hr>
            <div class="faq-item">
              <h3>
                What is an FAQ page ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book.
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
      <!-- Error report form -->
    <form id="error-report-form">
      <textarea id="error-description" name="error-description" placeholder="Please describe the error or bug"></textarea>
      <input type="email" id="user-email" name="user-email" placeholder="Your email (optional)">
      <button type="submit">Report Error</button>
    </form>
    <div id="error-report-notification" style="display: none;"></div>
  </div>
    
    <!-- Footer Start -->
    <?php
    include 'includes/footer.php';
    ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>

      <!-- Contact Javascript File -->
  <script src="mail/jqBootstrapValidation.min.js"></script>
  <script src="mail/contact.js"></script>

      <!-- Template Javascript -->
  <script src="js/main.js"></script>

            
  <script>
    $(document).ready(function() {
      // Capture form submission
      $('#error-report-form').submit(function(event) {
        event.preventDefault(); // Prevent form submission

        // Get form data
        var errorDescription = $('#error-description').val();
        var userEmail = $('#user-email').val();

        // Create AJAX request
        $.ajax({
          type: 'POST',
          url: 'report-error.php', // Replace with your API endpoint URL
          data: {
            errorDescription: errorDescription,
            userEmail: userEmail
          },
          success: function(response) {
            // Handle success response
            $('#error-report-notification').text('Report sent');
            $('#error-report-notification').show();

            // Reset form fields
            $('#error-description').val('');
            $('#user-email').val('');
          },
          error: function(xhr, status, error) {
            // Handle error response, if needed
            console.error('Error reporting error:', error);
          }
        });
      });
    });
  </script>


  <script type="text/javascript">
    $(document).ready(function() {
      $(".faq-plus").on('click', function() {
        var faqItem = $(this).closest('.faq-item');
        var faqBody = faqItem.find('.faq-body');
        var otherFaqItems = $(".faq-item").not(faqItem);
        var otherFaqBodies = $(".faq-body").not(faqBody);

        if (faqBody.is(':visible')) {
          faqBody.slideUp();
          $(this).removeClass('active');
        } else {
          otherFaqItems.removeClass('active');
          otherFaqBodies.slideUp();
          faqBody.slideDown();
          $(this).addClass('active');
        }
      });
    });
  </script>
</body>

</html>

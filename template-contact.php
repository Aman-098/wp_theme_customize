<?php
// Template Name:contact us

get_header();

?>
<!-- <?php echo get_template_directory_uri(); ?> -->


<main class="flex-shrink-0">
  <!-- Page content-->
  <section class="">
    <div class="container px-5">
      <!-- Contact form-->
      <div class="bg-light rounded-4 py-5 px-4 px-md-5">
        <div class="text-center mb-5">
          <div
            class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 mb-3"
          >
            <i class="bi bi-envelope"></i>
          </div>
          <h1 class="fw-bolder">Get in touch</h1>
          <p class="lead fw-normal text-muted mb-0">Let's work together!</p>
        </div>
        <div class="row gx-5 justify-content-center">
          <div class="col-lg-8 col-xl-6">
            <div id="alert-e" class="alert alert-danger" style="display:none;"></div>
            <div id="alert-s" class="alert alert-success" style="display:none;"></div>
            
            <form id="contactForm"  data-sb-form-api-token="API_TOKEN">
              <!-- Name input-->
              <div class="form-floating mb-3">
                <input
                  class="form-control"
                  id="name"
                  name="name"
                  type="text"
                  placeholder="Enter your name..."
                  data-sb-validations="required"
                />
                <label for="name">Full name</label>
                <div id="nameError" class="text-danger"></div>
              </div>
              <!-- Email address input-->
              <div class="form-floating mb-3">
                <input
                  class="form-control"
                  name="email"
                  id="email"
                  type="email"
                  placeholder="name@example.com"
                  data-sb-validations="required,email"
                />
                <label for="email">Email address</label>
                <div class="text-danger" id="emailError"></div>
                
              </div>
              <!-- Phone number input-->
              <div class="form-floating mb-3">
                <input
                  class="form-control"
                  name="phone"
                  id="phone"
                  type="tel"
                  placeholder="(123) 456-7890"
                  data-sb-validations="required"
                />
                <label for="phone">Phone number</label>
                <div class="text-danger" id="phoneError"></div>
               
              </div>
              <!-- Message input-->
              <div class="form-floating mb-3">
                <textarea
                  class="form-control"
                  id="message"
                  name="message"
                  type="text"
                  placeholder="Enter your message here..."
                  style="height: 10rem"
                  data-sb-validations="required"
                ></textarea>
                <label for="message">Message</label>
                <div id="messageError" class="text-danger"></div>
                
              </div>
            
      
              <!-- Submit Button-->
              <div class="d-grid">
                <button class="btn btn-primary btn-lg" id="submitButton" type="submit"> Submit </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>


<?php
get_footer();
?>


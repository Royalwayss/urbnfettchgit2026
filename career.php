<?php include 'include/header.php'; ?>

 <section class="rts__breadcrumb__area desktop-banner">
    <div class="rts__breadcrumb__content inner-banner has-overlay"
        data-bg-src="assets/images/urban/banner/career-banner.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- <ul class="list">
                        <li><a href="index.php">Home</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li><a href="#">Products</a></li>
                    </ul> -->
                    <h2 class="title rts-text-anime text-start">Join Our Team</h2>
                </div>
            </div>
        </div>
    </div>
</section>
 <section class="rts__breadcrumb__area mobile-banner">
    <div class="rts__breadcrumb__content inner-banner has-overlay"
        data-bg-src="assets/images/urban/banner/career-banner-m.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- <ul class="list">
                        <li><a href="index.php">Home</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li><a href="#">Products</a></li>
                    </ul> -->
                    <h2 class="title rts-text-anime text-start">Join Our Team</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="urbn-career-banner rts-section-gap">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-12 col-lg-9 text-center m-auto">
                <!-- <span class="urbn-career-subtitle">JOIN OUR TEAM</span>

                <h1 class="urbn-career-title mt-3">
                    Build Your Career with <span>URBNFETTCH</span>
                </h1> -->
                <h2 class="urba-heading-main">Build Your Career with URBNFETTCH</h2>
          

                <p class="urbn-career-text mt-4">
                    At URBNFETTCH, we believe our people are our greatest strength. We foster a culture of innovation,
                    collaboration, learning, and continuous growth, empowering our team to contribute meaningfully to
                    the development of advanced industrial chemical solutions.
                </p>

                <p class="urbn-career-text">
                    Whether you're an experienced professional or a passionate newcomer, we offer opportunities to
                    grow, innovate, and build a rewarding career in a dynamic manufacturing environment.
                </p>

                <a href="#career-form" class="btn urbn-career-btn mt-3">
                    Apply Now
                </a>

            </div>

            <!-- <div class="col-lg-6">
                <img src="assets/images/urban/career-banner.jpg" class="img-fluid rounded-4 w-100" alt="Career">
            </div> -->

        </div>
    </div>
</section>



<section class="urbn-career-benefits py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="urbn-career-heading">
                Why Join URBNFETTCH?
            </h2>
        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="urbn-career-card">
                    <div class="urbn-career-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>

                    <h5>Innovation</h5>

                    <p>
                        Work on advanced industrial chemical solutions with modern manufacturing practices.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="urbn-career-card">
                    <div class="urbn-career-icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <h5>Collaboration</h5>

                    <p>
                        Become part of a supportive team that values ideas and teamwork.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="urbn-career-card">
                    <div class="urbn-career-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>

                    <h5>Career Growth</h5>

                    <p>
                        Continuous learning and professional development opportunities.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="urbn-career-card">
                    <div class="urbn-career-icon">
                        <i class="fas fa-award"></i>
                    </div>

                    <h5>Recognition</h5>

                    <p>
                        We appreciate talent, dedication and reward outstanding performance.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- 
<section class="urbn-career-opening py-5">
    <div class="container">

        <div class="urbn-career-opening-box text-center">

            <h3>Current Openings</h3>

            <p>
                Current openings will be updated here.
            </p>

        </div>

    </div>
</section> -->



<section class="urbn-career-form-section py-5" id="career-form">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-12 col-lg-8">

                <div class="urbn-career-form-box">

                    <div class="text-center mb-4">
                        <h2 class="urbn-career-heading">
                            Apply for a Career
                        </h2>

                        <p>
                            Submit your details and our HR team will get in touch.
                        </p>
                    </div>

                    <div id="urbn-career-form-message" class="mb-3" tabindex="-1" style="display:none; outline:none;"></div>

                    <form id="urbnCareerForm" action="javascript:;" data-action="career-submit.php" method="post" enctype="multipart/form-data" novalidate>

                        <div class="row g-4">

                            <div class="col-md-6">
                                <input type="text" name="name" id="career_name" class="form-control urbn-career-input" placeholder="Full Name">
                                <label for="career_name" class="urbn-error-label text-danger small d-none"></label>
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="email" id="career_email" class="form-control urbn-career-input" placeholder="Email Address">
                                <label for="career_email" class="urbn-error-label text-danger small d-none"></label>
                            </div>

                            <div class="col-md-6">
                                <input type="tel" name="phone" id="career_phone" class="form-control urbn-career-input"
                                    placeholder="Phone Number">
                                <label for="career_phone" class="urbn-error-label text-danger small d-none"></label>
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="position" id="career_position" class="form-control urbn-career-input"
                                    placeholder="Position Applying For">
                                <label for="career_position" class="urbn-error-label text-danger small d-none"></label>
                            </div>

                            <div class="col-12">
                                <input type="file" name="resume" id="career_resume" class="form-control urbn-career-input" accept=".pdf,.doc,.docx">
                                <label for="career_resume" class="urbn-error-label text-danger small d-none"></label>
                                <small class="text-muted d-block mt-1">PDF or Word document, max 5MB.</small>
                            </div>

                            <div class="col-12">
                                <textarea rows="5" name="message" id="career_message" class="form-control urbn-career-input"
                                    placeholder="Cover Letter / Message"></textarea>
                                <label for="career_message" class="urbn-error-label text-danger small d-none"></label>
                            </div>

                            <div class="col-12 text-center">

                                <button type="submit" class="btn urbn-career-btn px-5" id="urbnCareerSubmit">
                                    Submit Application
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>



<?php include 'include/footer.php'; ?>

<!--
  jquery.min.js in footer.php loads with `defer`, so this must ALSO use `defer`
  (not a plain <script src>) and must come AFTER the footer include - otherwise
  it executes before jQuery exists and every $ call below throws.
-->
<script defer src="assets/js/jquery.validate.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
$(function () {
    $.validator.addMethod("filesize", function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, "File size must be less than 5MB.");

    $.validator.addMethod("fileext", function (value, element) {
        return this.optional(element) || /\.(pdf|doc|docx)$/i.test(value);
    }, "Please upload a PDF or Word document.");

    $("#urbnCareerForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                digits: true,
                minlength: 9,
                maxlength: 12
            },
            position: {
                required: true,
                minlength: 2
            },
            resume: {
                required: true,
                fileext: true,
                filesize: 5 * 1024 * 1024
            },
            message: {
                required: true,
                minlength: 10
            }
        },
        messages: {
            name: "Please enter your full name",
            email: "Please enter a valid email address",
            phone: "Please enter a valid phone number (9-12 digits)",
            position: "Please enter the position you're applying for",
            resume: "Please attach your resume (PDF or Word, max 5MB)",
            message: "Please enter a message (min 10 characters)"
        },
        errorElement: "label",
        errorPlacement: function (error, element) {
            error.addClass("urbn-error-label text-danger small");
            element.closest(".col-12, .col-md-6").find(".urbn-error-label").html(error.html() || error.text()).removeClass("d-none");
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
            $(element).closest(".col-12, .col-md-6").find(".urbn-error-label").addClass("d-none").html("");
        },
        submitHandler: function (form) {
            var $form = $(form);
            var $btn = $("#urbnCareerSubmit");
            var $msg = $("#urbn-career-form-message");

            $btn.prop("disabled", true).text("Submitting...");
            $msg.hide();

            var formData = new FormData(form);

            $.ajax({
                url: $form.attr("data-action"),
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json"
            }).done(function (res) {
                if (res.status === "success") {
                    $msg.removeClass("alert-danger").addClass("alert alert-success").text(res.message).show();
                    form.reset();
                } else {
                    $msg.removeClass("alert-success").addClass("alert alert-danger").text(res.message || "Something went wrong. Please try again.").show();
                }
                $msg[0].scrollIntoView({ behavior: "smooth", block: "center" });
                $msg.focus();
            }).fail(function () {
                $msg.removeClass("alert-success").addClass("alert alert-danger").text("Unable to submit your application right now. Please try again later.").show();
                $msg[0].scrollIntoView({ behavior: "smooth", block: "center" });
                $msg.focus();
            }).always(function () {
                $btn.prop("disabled", false).text("Submit Application");
            });

            return false;
        }
    });
});
});
</script>
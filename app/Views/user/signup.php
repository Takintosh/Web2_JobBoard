<section class="container mt-5 mb-4 px-4 pb-3 bg-primary" id="signup">

    <div class="row">
        <div class="col-12">
            <h4 class="mt-4 text-light text-center"><b>Sign Up</b></h4>
            <hr class="border-light">
        </div>
    </div>

    <form action="/signup" method="post" enctype="multipart/form-data">

        <div class="row px-4">

            <div class="col-12 col-lg-6 px-3 my-2">
                <label for="signup-name" class="form-label text-light" title="Required">Name:</label>
                <input type="text" id="signup-name" name="signup-name" class="form-control" placeholder="Full name" spellcheck="false" data-ms-editor="true" required>
            </div>
            <div class="col-12 col-lg-6 px-3 my-2">
                <label for="signup-email" class="form-label text-light">Email:</label>
                <input type="email" id="signup-email" name="signup-email" class="form-control" placeholder="Email address" spellcheck="false" data-ms-editor="true" required>
            </div>

            <div class="col-12 col-lg-6 px-3 my-2">
                <label for="signup-password" class="form-label text-light">Password:</label>
                <input type="password" id="signup-password" name="signup-password" class="form-control" placeholder="At least 8 characters" spellcheck="false" data-ms-editor="true" required pattern=".{8,}">
            </div>
            <div class="col-12 col-lg-6 px-3 my-2">
                <label for="signup-confirm-password" class="form-label text-light">Confirm Password:</label>
                <input type="password" id="signup-confirm-password" name="signup-confirm-password" class="form-control" placeholder="Confirm password" spellcheck="false" data-ms-editor="true" required>
            </div>

            <div class="col-12 col-lg-6 px-3 my-2">
                <label for="signup-linkedin" class="form-label text-light">LinkedIn:</label>
                <input type="text" id="signup-linkedin" name="signup-linkedin" class="form-control" placeholder="LinkedIn profile URL" spellcheck="false" data-ms-editor="true" required>
            </div>
            <div class="col-12 col-lg-6 px-3 my-2">
                <label for="signup-picture" class="form-label text-light">Profile Picture:</label>
                <input type="file" id="signup-picture" name="signup-picture" class="form-control" accept="image/*">
            </div>

        </div>

        <div class="row">
            <div class="col-12 text-center p-4">
                <button type="submit" class="btn btn-light" title="Complete required fields" disabled>Sign Up</button>
            </div>
        </div>

    </form>

    <script>
        const nameInput = document.getElementById('signup-name');
        const emailInput = document.getElementById('signup-email');
        const passwordInput = document.getElementById('signup-password');
        const confirmPasswordInput = document.getElementById('signup-confirm-password');
        const linkedinInput = document.getElementById('signup-linkedin');
        const submitButton = document.querySelector('button[type="submit"]');
        function validateForm() {
            if (nameInput.value && emailInput.value && passwordInput.value && confirmPasswordInput.value && passwordInput.value === confirmPasswordInput.value && linkedinInput.value) {
                submitButton.removeAttribute('disabled');
            } else {
                submitButton.setAttribute('disabled', 'true');
            }
        }
        nameInput.addEventListener('input', validateForm);
        emailInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);
        confirmPasswordInput.addEventListener('input', validateForm);
        linkedinInput.addEventListener('input', validateForm);
    </script>

</section>
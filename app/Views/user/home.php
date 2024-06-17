<section class="container mt-5 bg-primary" id="search-panel">
    <div class="row">
        <div class="col-12">
            <h4 class="mt-4 text-light text-center"><b>Search for Job Openings</b></h4>
            <hr class="border-light">
            <form>
                <div class="row py-3 px-5">
                    <div class="col-12 col-lg-6 px-3 py-1">
                        <input type="text" class="form-control" placeholder="Enter job title, description, keywords" id="inputDefault" spellcheck="false" data-ms-editor="true">
                    </div>
                    <div class="col-12 col-lg-6 px-3 py-1">
                        <select class="form-select" id="exampleSelect1">
                            <option selected disabled>Choose a category</option>
                            <option>Full time</option>
                            <option>Part time</option>
                            <option>Freelancer</option>
                            <option>All</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center pb-4">
                        <button type="submit" class="btn btn-light">Search</button>
                    </div>
                </div>
            </form>
        </div>
</section>

<section class="container mt-4 mb-4 px-4 pb-3 bg-primary" id="job-openings">

    <div class="row">
        <div class="col-12">
            <h4 class="mt-4 mx-2 text-light"><b>Recent Openings</b></h4>
            <hr class="border-light">
        </div>
    </div>

    <div class="row">

        <?php foreach ($jobOpenings as $jobOpening): ?>

        <div class="col col-lg-6 col-xxl-4">
            <div class="mt-2 mb-3 mx-1 bg-light px-3 pt-3 d-flex flex-column job-card">
                <div class="d-flex align-items-center mb-2">
                    <!-- Company logo -->
                    <img src="/uploads/companies/<?php echo htmlspecialchars($jobOpening->getCompany()->getLogo()); ?>" alt="<?php echo htmlspecialchars($jobOpening->getCompany()->getName()); ?>"
                         class="company-logo me-3">
                    <div>
                        <!-- Job title and company name -->
                        <h5 class="text-primary-emphasis fw-bolder m-0 mt-1"><?php echo htmlspecialchars($jobOpening->getTitle()); ?></h5>
                        <h6 class="text-primary fw-bolder m-0"><?php echo htmlspecialchars($jobOpening->getCompany()->getName()); ?></h6>
                    </div>
                </div>
                <!-- Job description -->
                <p class="text-primary m-0 mb-1">
                    <?php echo htmlspecialchars($jobOpening->getDescription()); ?>
                </p>
                <!-- Location and salary -->
                <p class="text-primary m-0">
                    <i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($jobOpening->getLocation()); ?>
                </p>
                <p class="text-primary m-0">
                    <i class="fa-solid fa-comment-dollar"></i> <?php echo htmlspecialchars($jobOpening->getSalary()); ?> per year
                </p>
                <!-- Badges -->
                <p class="mb-2">
                    <span class="badge bg-primary"><?php echo htmlspecialchars($jobOpening->getContract()); ?></span>
                    <span class="badge bg-primary">Min. <?php echo htmlspecialchars($jobOpening->getExperience()); ?> years</span>
                    <span class="badge bg-primary"><?php echo htmlspecialchars($jobOpening->getLevel()); ?></span>
                </p>
                <!-- Apply button -->
                <hr class="border-primary m-0">
                <button type="button" class="btn btn-primary mx-auto m-0 my-1" data-bs-toggle="modal" data-bs-target="#jobOpeningModal"
                        data-bs-title="<?php echo htmlspecialchars($jobOpening->getTitle()); ?>"
                        data-bs-company="<?php echo htmlspecialchars($jobOpening->getCompany()->getName()); ?>"
                        data-bs-location="<?php echo htmlspecialchars($jobOpening->getLocation()); ?>"
                        data-bs-contract="<?php echo htmlspecialchars($jobOpening->getContract()); ?>"
                        data-bs-salary="<?php echo htmlspecialchars($jobOpening->getSalary()); ?>"
                        data-bs-experience="<?php echo htmlspecialchars($jobOpening->getExperience()); ?>"
                        data-bs-level="<?php echo htmlspecialchars($jobOpening->getLevel()); ?>"
                        data-bs-description="<?php echo htmlspecialchars($jobOpening->getDescription()); ?>"
                        data-bs-website="<?php echo htmlspecialchars($jobOpening->getCompany()->getWebsite()); ?>"
                        data-bs-email="<?php echo htmlspecialchars($jobOpening->getCompany()->getContactEmail()); ?>"
                        data-bs-phone="<?php echo htmlspecialchars($jobOpening->getCompany()->getContactPhone()); ?>"
                        data-bs-companydescription="<?php echo htmlspecialchars($jobOpening->getCompany()->getDescription()); ?>"
                        data-bs-logo="<?php echo htmlspecialchars($jobOpening->getCompany()->getLogo()); ?>"
                >Apply</button>
            </div>
        </div>

        <?php endforeach; ?>

    </div>

    <!-- Job Opening Details Modal -->
    <div class="modal fade" id="jobOpeningModal" tabindex="-1" aria-labelledby="jobOpeningModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="mb-1 p-3 bg-light border rounded">
                        <div class="d-flex justify-content-start align-items-center mb-3">
                            <img src="" alt="Company Name" class="company-logo-modal me-3" id="modal-job-logo">
                            <div>
                                <h4 class="text-primary-emphasis fw-bolder" id="modal-job-title">Job Title</h4>
                                <h5 class="text-secondary fw-bolder" id="modal-job-company">Company Name</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-sm-6 col-md-4"><i class="fa-solid fa-location-dot"></i> <span id="modal-job-location"></div>
                            <div class="col-12 col-sm-6 col-md-4"><i class="fa-solid fa-briefcase"></i> <span id="modal-job-contract"></span></div>
                            <div class="col-12 col-sm-6 col-md-4"><i class="fa-solid fa-dollar-sign"></i> <span id="modal-job-salary"></span></div>
                            <div class="col-12 col-sm-6 col-md-4"><i class="fa-solid fa-chart-line"></i> <span id="modal-job-experience"></span>&nbsp;year/s</div>
                            <div class="col-12 col-sm-6 col-md-4"><i class="fa-solid fa-level-up-alt"></i> <span id="modal-job-level"></span></div>
                        </div>

                        <div class="mb-3">
                            <!--h6>Description:</h6-->
                            <p id="modal-job-description"></p>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <h6><b>Contact:</b></h6>
                            <p><i class="fa-solid fa-globe"></i> <a href="" id="modal-job-website" target="_blank" rel="noopener noreferrer"></a></p>
                            <p><i class="fa-solid fa-envelope"></i>&nbsp;<span id="modal-job-email"></span></p>
                            <p><i class="fa-solid fa-phone"></i>&nbsp;<span id="modal-job-phone"></span></p>
                        </div>

                        <div class="mb-3">
                            <h6><b>About the Company:</b></h6>
                            <p id="modal-job-companydescription">Company Description</p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <?php if (isset($_SESSION['user'])): ?>
                        <button type="button" class="btn btn-primary">Apply to Job</button>
                    <?php else: ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login to Apply</button>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

</section>

<script>
    var jobOpeningModal = document.getElementById('jobOpeningModal');
    jobOpeningModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget;

        // Extract info from data-bs-* attributes
        var title = button.getAttribute('data-bs-title');
        var company = button.getAttribute('data-bs-company');
        var location = button.getAttribute('data-bs-location');
        var contract = button.getAttribute('data-bs-contract');
        var salary = button.getAttribute('data-bs-salary');
        var experience = button.getAttribute('data-bs-experience');
        var level = button.getAttribute('data-bs-level');
        var description = button.getAttribute('data-bs-description');
        var website = button.getAttribute('data-bs-website');
        var email = button.getAttribute('data-bs-email');
        var phone = button.getAttribute('data-bs-phone');
        var companyDescription = button.getAttribute('data-bs-companydescription');
        var logo = button.getAttribute('data-bs-logo');

        // Update the modal's content
        var modalJobTitle = jobOpeningModal.querySelector('#modal-job-title');
        var modalJobCompany = jobOpeningModal.querySelector('#modal-job-company');
        var modalJobLocation = jobOpeningModal.querySelector('#modal-job-location');
        var modalJobContract = jobOpeningModal.querySelector('#modal-job-contract');
        var modalJobSalary = jobOpeningModal.querySelector('#modal-job-salary');
        var modalJobExperience = jobOpeningModal.querySelector('#modal-job-experience');
        var modalJobLevel = jobOpeningModal.querySelector('#modal-job-level');
        var modalJobDescription = jobOpeningModal.querySelector('#modal-job-description');
        var modalJobWebsite = jobOpeningModal.querySelector('#modal-job-website');
        var modalJobEmail = jobOpeningModal.querySelector('#modal-job-email');
        var modalJobPhone = jobOpeningModal.querySelector('#modal-job-phone');
        var modalJobCompanyDescription = jobOpeningModal.querySelector('#modal-job-companydescription');
        var modalJobLogo = jobOpeningModal.querySelector('#modal-job-logo');

        //modalTitle.textContent = title;
        modalJobTitle.textContent = title;
        modalJobCompany.textContent = company;
        modalJobLocation.textContent = location;
        modalJobContract.textContent = contract;
        modalJobSalary.textContent = salary;
        modalJobExperience.textContent = experience;
        modalJobLevel.textContent = level;
        modalJobDescription.textContent = description;
        modalJobWebsite.textContent = website;
        modalJobEmail.textContent = email;
        modalJobPhone.textContent = phone;
        modalJobCompanyDescription.textContent = companyDescription;
        modalJobLogo.src = '/uploads/companies/' + logo;

        // Add protocol if missing
        if (website && !website.startsWith('http://') && !website.startsWith('https://')) {
            website = 'http://' + website;
        }
        modalJobWebsite.href = website;

    });
</script>

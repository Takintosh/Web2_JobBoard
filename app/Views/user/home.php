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
                    <img src="https://static.vecteezy.com/system/resources/previews/027/127/473/original/microsoft-logo-microsoft-icon-transparent-free-png.png"
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
                <button type="button" class="btn btn-primary mx-auto m-0 my-1">Apply</button>
            </div>
        </div>

        <?php endforeach; ?>

    </div>

</section>
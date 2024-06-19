    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create a Job Opening!</h1>
                        </div>
                        <form class="user" action="/admin/new-job-opening" method="post">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="publisher" value="<?= $_SESSION['user']['id'] ?>">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3">
                                    <label for="job-title">Job Title</label>
                                    <input type="text" class="form-control" id="job-title" name="title"
                                           placeholder="Job Position" required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="job-company">Company</label>
                                    <select class="form-control" id="job-company" name="company">
                                        <?php foreach ($companies as $company) : ?>
                                            <option value="<?php echo htmlspecialchars($company->getId()); ?>" class=""> <?php echo htmlspecialchars($company->getName()); ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="job-contract">Contract Type</label>
                                    <select class="form-control" id="job-contract" name="contract" required>
                                        <option value="full-time">Full-time</option>
                                        <option value="part-time">Part-time</option>
                                        <option value="freelancer">Freelancer</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="job-location">Location</label>
                                    <input type="text" class="form-control" id="job-location" name="location"
                                           placeholder="Job Location" required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="job-expertise">Expertise level</label>
                                    <select class="form-control" id="job-expertise" name="expertise">
                                        <option value="junior">Junior</option>
                                        <option value="semi-senior">Semi-senior</option>
                                        <option value="senior">Senior</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="job-experience">Minimum experience required</label>
                                    <input type="number" class="form-control" id="job-experience" name="experience" value="0" required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="job-salary">Salary (USD per year)</label>
                                    <input type="number" class="form-control" id="job-salary" name="salary" value="0" required>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label for="job-description">Job Description</label>
                                    <textarea class="form-control" id="job-description" name="description"
                                              placeholder="Job Description"></textarea>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-block" type="submit">
                                Register Job Opening
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
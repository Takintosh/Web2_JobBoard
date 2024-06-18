<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Applications</h1>

<!-- DataTales -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo htmlspecialchars($jobOpening->getTitle()); ?> at <?php echo htmlspecialchars($jobOpening->getCompany()->getName()); ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Linkedin</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Linkedin</th>
                </tr>
                </tfoot>
                <tbody>


                <?php foreach ($applications as $application): ?>
                    <tr>
                        <td>
                            <img src="/uploads/users/<?php echo htmlspecialchars($application->getUser()->getPicture()); ?>" alt="<?php echo htmlspecialchars($application->getUser()->getName()); ?>" class="img-thumbnail" style="width: 50px;">
                        </td>
                        <td><?php echo htmlspecialchars($application->getUser()->getName()); ?></td>
                        <td><?php echo htmlspecialchars($application->getUser()->getEmail()); ?></td>
                        <td>
                            <a href="<?php echo htmlspecialchars($application->getUser()->getLinkedin()); ?>" target="_blank" rel="noopener noreferrer">
                                <?php echo htmlspecialchars($application->getUser()->getLinkedin()); ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
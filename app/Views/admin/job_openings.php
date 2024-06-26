<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4 mx-2">
    <h1 class="h3 mb-0 text-gray-800">Job Openings</h1>
    <a href="/admin/new-job-opening" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus-square"></i> Create job opening</a>
</div>

<!-- DataTales -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Job Openings</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Position</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Position</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
                <tbody>


                <?php foreach ($jobOpenings as $jobOpening): ?>
                <tr>
                    <td><a href="/admin/applications/<?php echo $jobOpening->getId(); ?>"><?php echo htmlspecialchars($jobOpening->getTitle()); ?></a></td>
                    <td><?php echo htmlspecialchars($jobOpening->getCompany()->getName()); ?></td>
                    <td><?php echo htmlspecialchars($jobOpening->getStatus()); ?></td>
                    <td>
                        <form action="/admin/change-visibility/<?php echo htmlspecialchars($jobOpening->getId()); ?>" method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <input type="hidden" name="jobOpeningId" value="<?php echo htmlspecialchars($jobOpening->getId()); ?>">
                            <button type="submit" title="Change Visibility" class="btn btn-link">
                                <?php if ($jobOpening->getStatus() == 'inactive'): ?>
                                    <i class="fas fa-eye"></i>
                                <?php else: ?>
                                    <i class="fas fa-eye-slash"></i>
                                <?php endif; ?>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
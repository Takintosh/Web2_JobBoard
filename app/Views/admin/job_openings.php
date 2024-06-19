<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Job Openings</h1>

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
                    <th>Count</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Position</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Count</th>
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
                    <td>

                    </td>
                </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
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
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Position</th>
                    <th>Company</th>
                    <th>Status</th>
                </tr>
                </tfoot>
                <tbody>


                <?php foreach ($jobOpenings as $jobOpening): ?>
                <tr>
                    <td><?php echo htmlspecialchars($jobOpening->getTitle()); ?></td>
                    <td><?php echo htmlspecialchars($jobOpening->getCompany()->getName()); ?></td>
                    <td><?php echo htmlspecialchars($jobOpening->getStatus()); ?></td>
                </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
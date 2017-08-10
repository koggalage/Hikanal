
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login History</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>IP Address</th>
                                    <th>Success</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($history as $value) : ?>
                                    <tr>
                                        <td><?php echo get_user_name($value->user_id); ?></td>
                                        <td><?php echo $value->ip_address; ?></td>
                                        <td><?php echo $value->success?"Yes":"No"; ?></td>
                                        <td><?php echo $value->time; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
        // $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
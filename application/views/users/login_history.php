    <div class="row cont" >
        <div class="col-md-4 " style="background-image: url(<?php echo base_url('assets/img/bbc.png'); ?>); height:6000px; margin-top: -20px">
            <div>
            <img src="<?php echo base_url('assets/img/image2.png'); ?>" alt="" style=" width: 90%; margin-left: 5%; margin-top: 40%"> 
                
            </div>
        </div>   
        <div class="col-md-6 col-md-offset-1">
            <div class="row">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Attempts</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>Username or email</th>
                                    <th>IP Address</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($history as $value) : ?>
                                    <tr>
                                        <td><?php echo $value->username_or_email; ?></td>
                                        <td><?php echo $value->ip_address; ?></td>
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
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
        // $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
    <div class="row cont" >
        <div class="col-md-4 " style="background-image: url(<?php echo base_url('assets/img/bbc.png'); ?>); height:6000px; margin-top: -20px">
            <div>
                <img src="<?php echo base_url('assets/img/image2.png'); ?>" alt="" style=" width: 90%; margin-left: 5%; margin-top: 40%"> 
                
            </div>
        </div> 


            <div class="col-md-8">
                <div class="row" style=" margin-top: 5%">
                <div class="col-md-8 col-md-offset-2">
                    <?php if (isset($success_msg)) :?>
                        <div class="row">
                            <p class="text-success"><?php echo $success_msg; ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($error_msg)) :?>
                        <div class="row">
                            <p class="text-success"><?php echo $error_msg; ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-2 pull-right">
                            
                            <a href="<?php echo base_url("index.php/users/registration"); ?>"><!-- <i class="glyphicon glyphicon-plus"></i> --><button class="btn btn-primary">Add User</button></a>
                        </div>
                    </div> <br/><br/>
                    <div class="row">

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Users</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <?php if ($auth_level > 3) : ?>
                                                <th></th>
                                                <th></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) : ?>
                                            <tr data-user-id="<?php echo $user->user_id; ?>" data-user-name="<?php echo $user->username; ?>">
                                                <td><?php echo $user->username; ?></td>
                                                <td><?php echo $user->email; ?></td>
                                                <?php if ($auth_level > 3) : ?>
                                                    <?php if ($user->auth_level < 3) : ?>
                                                        <td><button type="button" class="btn btn-flat btn-warning make-admin">Make Admin</button></td>
                                                    <?php else: ?>
                                                        <td><button type="button" class="btn btn-flat btn-warning make-admin" disabled="true">Make Admin</button></td>
                                                    <?php endif; ?>
                                                    <td><a href="#" data-toggle="tooltip" title="Delete User" class="delete-user"><span class="glyphicon glyphicon-trash"></span></a></td>
                                                <?php endif; ?>
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

    </div>
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
        // $('[data-toggle="tooltip"]').tooltip();

        $(document).on('click','.make-admin',function(e){
            var t = $(this);
            e.preventDefault();
            var uname = t.closest('tr').data('user-name');
            var uid = t.closest('tr').data('user-id');
            swal({
                title: "Make "+uname+" an admin?",
                text: "He will gain access to add users and other admin functions",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-warning",
                confirmButtonText: "Make Admin",
                closeOnConfirm: false
            },
            function(){
                $.get('<?php echo base_url("index.php/users/make_admin/"); ?>'+uid,function(res){
                    if (res) {
                        swal("Done", "User "+uname+" is now an admin.", "success");
                        location.reload();
                    } else {
                        swal("Error", "Something is wrong. please try again", "danger");
                    }
                });
            });
        });

        $(document).on('click','.delete-user',function(e){
            var dl = $(this);
            e.preventDefault();
            var uname = dl.closest('tr').data('user-name');
            var uid = dl.closest('tr').data('user-id');
            swal({
                title: "Delete "+uname+" ?",
                text: "Are you sure?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Delete",
                closeOnConfirm: false
            },
            function(){
                $.get('<?php echo base_url("index.php/users/delete_user/"); ?>'+uid,function(result){
                    console.log(result);
                    if (result) {
                        swal("Done", "User "+uname+" deleted.", "success");
                        location.reload();
                    } else {
                        swal("Error", "Something is wrong. please try again", "error");
                    }
                });
            });
        });
    });
</script>
</body>
</html>
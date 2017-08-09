
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
    
            <h2>Users</h2>
            <table id="datatable">
                <thead>
                    
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Added Date</th>
                        <th>Type</th>
                        <th>Added By</th>
                        <th>Make Admin</th>
                        <th>Delete User</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php foreach ($users as $user) : ?>
                        <tr>
                            
                            <td><?php echo $user->username; ?></td>
                            <td><?php echo $user->name; ?></td>
                            <td><?php echo $user->contact_no; ?></td>
                            <td><?php echo $user->account_created; ?></td>
                            <td><?php echo ($user->user_type == "A")?"Admin":"User"; ?></td>
                            <td><?php echo get_user_name($user->added_by); ?></td>
                            <td></td>
                        </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('#datatable').DataTable();

});
  </script>
</body>
</html>
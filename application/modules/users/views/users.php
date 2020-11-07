<div class="container-fluid">
    <div class="mt-5">
        <table id="dttableUsers" class="table table-border table-striped">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($x = 0; $x < COUNT($userlist); $x++) : ?>
                    <tr>
                        <td><?= $userlist[$x]->fullname ?></td>
                        <td><?= $userlist[$x]->last_logged_in ?></td>
                        <td><?= ($userlist[$x]->is_logged_in == "Y" ? "logged in" : "not logged in") ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dttableUsers').DataTable();
    })
</script>
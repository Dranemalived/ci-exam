<div class="container-fluid">
    <table class="table table-border table-striped mt-5">
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
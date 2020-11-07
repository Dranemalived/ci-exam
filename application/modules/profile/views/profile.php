<div class="container-fluid mt-5">

    <div class="col-md-12">


        <div class="col-md-5">
            <img src="" alt="" height="200" width="200">
            <input type="hidden" name="" id="user_id" value="<?= $profile->id ?>">
            <div class="form-group mt-5">
                <label for="">Full Name</label>
                <input type="text" class="form-control" disabled id="fullname" value="<?= $profile->fullname ?>">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" disabled id="email" value="<?= $profile->email ?>">
            </div>

            <button class="btn btn-primary btn_edit">Edit</button>
            <button class="btn btn-success btn_update" style="display:none">Update</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.btn_edit').click(function() {
            $('.form-control').attr('disabled', false);
            $(this).hide();
            $('.btn_update').show();
        })

        $('.btn_update').click(function() {
            $('.form-control').attr('disabled', true);
            $(this).hide();
            $('.btn_edit').show();

            $.ajax({
                url: baseUrl + 'Profile/update',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: $('#user_id').val(),
                    fullname: $('#fullname').val(),
                    email: $('#email').val()
                },
                success: function(result) {

                }
            })
        })
    })
</script>
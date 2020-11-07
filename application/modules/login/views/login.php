<div class="container-fluid">
    <h1 class="mt-3">Login</h1>
    <hr>
    <div class="col-md-4">
        <form class="my-5">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password">
            </div>
            <p class="text-muted">
                Don't have an account? <a href="#" data-toggle="modal" data-target="#signupModal">Click here</a>
            </p>
            <button type="button" class="btn btn-primary col-md-3 btn_login">Login</button>
        </form>
    </div>
</div>

<!--registration modal-->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Registration Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="frm">
                    <div class="form-group">
                        <label for="regs_password">Full Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="regs_fullname">
                    </div>
                    <div class="form-group">
                        <label for="regs_email">Email address <span class="text-red">*</span> <small id="emailValid" class=""></small> </label>
                        <input type="email" class="form-control" id="regs_email" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="regs_password1">Password <span class="text-red">*</span></label>
                        <input type="password" class="form-control" id="regs_password1">
                    </div>
                    <div class="form-group">
                        <label for="regs_password2">Repeat Password <span class="text-red">*</span></label>
                        <input type="password" class="form-control" id="regs_password2">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="regs_terms" value="1">
                        <label class="form-check-label" for="regs_terms">I agree to the <a href="">Terms and Condition</a></label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn_register">Register</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.btn_login').click(function() {
            login();
        })

        $('#signupModal').on('show.bs.modal', function() {
            $('.alert-danger').remove();
            $('.alert-success').remove();
            $('.frm').show();
            $('.frm')[0].reset();
            $('#emailValid').text('');
            $('.btn_register').show();
        })

        $('.btn_register').click(function() {
            $.ajax({
                url: baseUrl + 'Registration/save',
                type: 'POST',
                dataType: 'json',
                data: {
                    fullname: $('#regs_fullname').val(),
                    email: $('#regs_email').val(),
                    password1: $('#regs_password1').val(),
                    password2: $('#regs_password2').val(),
                    terms: ($('#regs_terms').is(':checked') ? 1 : "")
                },
                success: function(result) {
                    if (result.error) {
                        $('.modal-body').prepend(`
                            <div class="alert alert-danger" role="alert">
                                ${result.message}
                            </div>
                        `);
                    } else {
                        $('.alert-danger').remove();
                        $('.modal-body').prepend(`
                            <div class="alert alert-success" role="alert">
                                <h6 class="alert-heading">Registration Success!</h6>
                            </div>
                        `);
                        $('.frm').hide();
                        $('.btn_register').hide();
                    }
                }
            });
        });

        $(document).on('input', '#regs_email', function() {
            var str = $(this).val();
            $.ajax({
                url: baseUrl + 'Registration/email_check/' + true,
                type: 'POST',
                dataType: 'json',
                data: {
                    email: str
                },
                success: function(result) {
                    if (result.error == false) {
                        $('#emailValid').removeClass('text-danger').addClass('text-success')
                            .text(result.message);
                    } else {
                        $('#emailValid').removeClass('text-success').addClass('text-danger')
                            .text(result.message);
                    }
                }
            });
        })
    });

    function login() {
        $.ajax({
            url: baseUrl + 'Login/auth',
            type: 'POST',
            dataType: 'json',
            data: {
                email: $('#email').val(),
                password: $('#password').val(),
            },
            success: function(result) {

                if (result.error == false) {
                    window.location.href = result.redirect;
                } else {
                    alert(result.message);
                }
            }
        });
    }
</script>
@include('publicLayout.header')

    <section class="section main-content img-center text-center" id="main">
        {{ HTML::image('css/assets/images/logo.png', 'Logo', ['title' => 'TVZskladište', 'class' => 'img-responsive']) }}                        
        <h1 class="section-header">Registracija</h1>

        <!-- login container -->
        <div class="container" id="login-block">
            <div class="row">
                <div class="loginMainBox">
                    <div class="login-box clearfix">
                        <hr>
                        <div class="login-form">
                            {{ Form::open(['url' => 'register', 'role' => 'form', 'id' => 'register']) }}
                            <div class="form-group-login">
                                {{ Form::label('full_name', 'Ime i prezime:') }}
                                {{ Form::text('full_name', null, ['class' => 'form-control', 'placeholder' => 'Ime i prezime', 'id' => 'full_name', 'required']) }}
                            </div>
                            <div class="form-group-login">
                                {{ Form::label('email', 'E-mail:') }}
                                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail', 'id' => 'email', 'required']) }}
                            </div>
                            <div class="form-group-login">
                                {{ Form::label('username', 'Korisničko ime:') }}
                                {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Korisničko ime', 'id' => 'username', 'required']) }}
                            </div>
                            <div class="form-group-login">
                                {{ Form::label('password', 'Lozinka:') }}
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Lozinka', 'id' => 'password', 'required']) }}
                            </div>
                            <div class="form-group-login">
                                {{ Form::label('password_again', 'Ponovite lozinku :') }}
                                {{ Form::password('password_again', ['class' => 'form-control', 'placeholder' => 'Ponovite lozinku', 'id' => 'password_again', 'required']) }}
                            </div>

                            <div class="space"></div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-padded" id="registerSubmit">Registracija <i class="fa fa-sign-in"></i></button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end login container -->

        <div class="space">
	        <a href="{{ URL::route('home') }}">
	            <button class="btn btn-primary">Povratak <i class="fa fa-home"></i></button>
	        </a>
        </div>
    </section> <!-- end main-content -->

<script>
    jQuery(document).ready(function() {
        $("#register").submit(function (event) {
            event.preventDefault();

            //disable button click
            $('button#registerSubmit').addClass('disabled');

            //get input fields values
            var values = {};
            $.each($(this).serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            var token = $('#register > input[name="_token"]').val();

            //user output
            var outputMsg = $('#outputMsg');
            var errorMsg = "";
            var successMsg = "";

            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                dataType: 'json',
                headers: {'X-CSRF-Token': token},
                data: {_token: token, formData: values},
                success: function (data) {
                    //check status of validation and query
                    if (data.status === 'success') {
                        //enable button click
                        $('button#registerSubmit').removeClass('disabled');

                        //output message of success and redirect user
                        successMsg = "<h3>Uspješno ste se registirali. Pričekajte dok Vas preusmjernimo na prijavu.</h3>";
                        outputMsg.append(successMsg).addClass('successNotif').slideDown();
                        setTimeout(function () {
                            //redirect to intended page
                            window.location = "<?php echo url('login'); ?>";
                        }, 2000);
                    }
                    else {
                        $.each(data.errors, function(index, value) {
                            $.each(value, function(i){
                                errorMsg += "<h3>" + value[i] + "</h3>";
                            });
                        });
                        outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                        //timer
                        var numSeconds = 3;
                        function countDown(){
                            numSeconds--;
                            if(numSeconds == 0){
                                clearInterval(timer);
                            }
                            $('#notificationTimer').html(numSeconds);
                        }
                        var timer = setInterval(countDown, 1000);

                        function restoreNotification(){
                            outputMsg.fadeOut(1000, function(){
                                //enable button click
                                $('button#registerSubmit').removeClass('disabled');

                                setTimeout(function () {
                                    outputMsg.empty().attr('class', 'notificationOutput');
                                }, 1000);
                            });
                        }

                        //hide notification if user clicked
                        $('#notifTool').click(function(){
                            restoreNotification();
                        });

                        setTimeout(function () {
                            restoreNotification();
                        }, numSeconds * 1000);
                    }
                }
            });

            return false;
        });
    });
</script>

@include('publicLayout.footer')
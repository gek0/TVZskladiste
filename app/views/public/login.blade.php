@include('publicLayout.header')

    <section class="section main-content img-center text-center" id="main">
        {{ HTML::image('css/assets/images/logo.png', 'Logo', ['title' => 'TVZskladište', 'class' => 'img-responsive']) }}                        
        <h1 class="section-header">Prijava</h1>

        <!-- login container -->
        <div class="container" id="login-block">
            <div class="row">
                <div class="loginMainBox">
                    <div class="login-box clearfix">
                        <hr>
                        <div class="login-form">
                            {{ Form::open(['url' => 'login', 'role' => 'form', 'id' => 'adminLogin']) }}
                            <div class="form-group-login">
                                {{ Form::label('username', 'Korisničko ime:') }}
                                {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Korisničko ime', 'id' => 'username', 'required']) }}
                            </div>
                            <div class="form-group-login">
                                {{ Form::label('password', 'Lozinka:') }}
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Lozinka', 'id' => 'password', 'required']) }}
                            </div>
                            <div class="form-group-login text-center">
                                <div class="checkbox checkbox-primary">
                                    {{ Form::checkbox('rememberMe', 1, true, ['id' => 'rememberMe']) }}
                                    {{ Form::label('rememberMe', 'Zapamti me?', ['class' => 'checkbox-inline', 'id' => 'check-adjust', 'checked']) }}
                                </div>
                            </div>

                            <div class="space"></div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-padded" id="loginSubmit">Prijava <i class="fa fa-sign-in"></i></button>
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
        $("#adminLogin").submit(function (event) {
            event.preventDefault();

            //disable button click and show loader
            $('button#loginSubmit').addClass('disabled');
            $('#adminLoginLoad').css('visibility', 'visible').fadeIn();

            //get input fields values
            var values = {};
            $.each($(this).serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            var token = $('#adminLogin > input[name="_token"]').val();

            //user output
            var outputMsg = $('#outputMsg');
            var errorMsg = "";

            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                dataType: 'json',
                headers: {'X-CSRF-Token': token},
                data: {_token: token, formData: values},
                success: function (data) {
                    //check status of validation and query
                    if (data.status === 'success') {
                        //enable button click and hide loader
                        $('button#loginSubmit').removeClass('disabled');
                        $('#adminLoginLoad').css('visibility', 'hidden').fadeOut();

                        //redirect to intended page
                        window.location = "<?php echo $intended_url; ?>";
                    }
                    else {
                        errorMsg = '<h3>' + data.errors + '</h3>';
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
                                //enable button click and hide loader
                                $('button#loginSubmit').removeClass('disabled');
                                $('#adminLoginLoad').css('visibility', 'hidden').fadeOut();

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
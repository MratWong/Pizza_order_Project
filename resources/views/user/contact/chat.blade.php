@extends('user.layouts.master')

@section('content')
    {{-- it's still error  --}}
    <section>
        <div class="">
            <div class="row " style="height: 400px">
                <div class="col-8 offset-2 bg-light">
                    <div class="text-muted">
                        <a href="{{ route('user#homePage') }}" class="text-black-50 text-decoration-none">
                            <i class="fa-solid fa-angle-left"></i>
                            <span>To admin</span>
                        </a>

                    </div>
                    <hr>
                    <div class=" ms-2 mt-2">
                        {{-- {{ $message->message }} --}}
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="row bg-white">
            <div class="col-8 offset-2 p-3 " style="background: rgb(234, 233, 230)">
                <div class="row">
                    <div class="col-8 offset-1">
                        <input type="text" class="form-control" id="message"
                            placeholder="Please write your question here">
                    </div>
                    <div class="col-2">
                        <button class="btn rounded" id="sendBtn" style="background: rgb(190, 202, 83)">
                            <span class="text-white">Send</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('scritSource')
    <script>
        $('#message').keypress(function(e) {
            var key = e.which;
            if (key == 13) // the enter key code
            {
                // alert("HII")
                $('#sendBtn').click();
            }
        });

        $('#sendBtn').click(function() {

            // $userName = $('#userName').val();
            // $userEmail = $('#userEmail').val();
            $userMessage = $('#message').val();

            $data = {
                'userMessage': $userMessage
            };
            $.ajax({
                type: 'get',
                url: '/user/ajax/user/send/message',
                data: $data,
                dataType: 'json',
            })

            // console.log("DONE")

            // location.reload();

            $("#message").val('');



        })
    </script>
@endsection

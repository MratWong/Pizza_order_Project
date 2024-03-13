@extends('admin.layouts.master')

@section('content')
    <div class="">
        <div class="row my-3" style="">
            <div class="col-8 offset-2 my-3 bg-white">
                <div class="text-muted mt-5">
                    <a href="{{ route('admin#userMessage') }}" class="text-black-50"">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <span class="ms-3">{{ $user->name }}</span>
                </div>
                <hr>

                @foreach ($contacts as $message)
                    @if ($message->sender_id != 0)
                        <div class="ms-2 col-12">
                            <div class="btn btn-warning ">
                                {{ $message->message }}
                            </div>
                        </div>
                    @else
                        <div class="me-2 col-12" style="text-align: right">
                            <div class="btn btn-success">
                                {{ $message->message }}
                            </div>
                        </div>
                    @endif



                    {{-- @if ($message->receiver_id == auth()->id())
                    <div class="btn btn-warning ms-2 my-2">
                        {{ $message->message }}
                    </div>

                @else
                    <br>
                    <div class="btn btn-warning ms-2 my-2 float-right">
                        {{ $message->message }}
                    </div>

                @endif --}}


                    <br>
                @endforeach


                {{-- <div class="btn btn-warning ms-2">
                    {{ Auth::user()->message }}
                </div> --}}
            </div>



        </div>
        {{-- 11 --}}
        <div class="row">
            <div class="col-8 offset-2 p-3 bg-white">
                <div class="row">
                    <div class="col-8 offset-1 ">
                        <input type="text" class="form-control bg-light" id="message" placeholder="Answer message"
                            autofocus>
                        <input type="hidden" value="{{ $user->id }}" id="receiver_id" placeholder="Answer message">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn rounded  sendBtn" id="sendBtn"
                            style="background: rgb(190, 202, 83)">
                            <span class="text-white">Send</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scriptSection')
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

            $userMessage = $('#message').val();
            $receiver_id = $('#receiver_id').val();

            $data = {
                'replyMessage': $userMessage,
                'receiver_id': $receiver_id
            };

            var token = $('meta[name="csrf-token"]').attr('content')

            // console.log(token)

            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-Token': token
                },
                url: '/contact/ajax/reply/message',
                data: $data,
                dataType: 'json',
            })

            location.reload();

            // $("#message").val('');

        })
    </script>
@endsection

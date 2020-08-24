<div class="flash-message">

    @if ( $errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!!  $error  !!}</li>
                @endforeach
            </ul>
        </div>
    @endif

        @if ( !$errors->any() &&   session('errors') )
            <div class="alert alert-danger">
                {!!  session('errors')  !!}
                @php
                    session()->forget('errors')
                @endphp
            </div>
        @endif
</div>

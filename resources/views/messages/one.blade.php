@extends('main')

@section('content')
    <div class="container">

        @include('partials.errors')
        <div class="card-content">
            <div class="card-body mb-5 mt-4">
                {!! Form::open(['url' => route( ($message->id)?'messages.update':'messages.store', $message->id), 'method' => ($message->id)?'PUT':'POST',
                         'class' => 'm-form m-form--label-align-right',
                        'enctype' => 'multipart/form-data']) !!}


                <div class="m-portlet__body row ml-5">
                    <label class="form-group m-form__group field-size">
                        Select
                    </label>
                    <div class="col-md-4">
                        {!! Form::select('select[]', $select, $oldSelect, array('multiple' => 'multiple')) !!}
                    </div>


                </div>

                <div class="m-portlet__body row ml-5">
                    <label class="form-group m-form__group field-size">
                        Subject
                    </label>
                    <div class="col-md-4">
                        {!! Form::text('subject', old('subject',$message->subject ), ['class' => 'form-control m-input']) !!}
                    </div>
                </div>

                <div class="m-portlet__body row ml-5">
                    <label class="form-group m-form__group field-size">
                        Body
                    </label>
                    <div class="col-md-4">
                        {!! Form::text('body', old('body',$message->body ), ['class' => 'form-control m-input']) !!}
                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <button type="submit" class="btn btn-primary">
                        Send
                    </button>
                </div>


                {!! Form::close() !!}
            </div>

        </div>


    </div>
@endsection

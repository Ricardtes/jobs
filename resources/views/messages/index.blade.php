@extends('main')

@section('content')
    <div class="container">
        @include('partials.success')

        <div class="row">
            <div>
                <a class="btn btn-secondary" href="{{route('messages.create')}}">create</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Recipients count</th>
                <th scope="col">Sent</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($messages as $message)
            <tr>
                <th scope="row">{{$message->subject}}</th>
                <td>{{$message->messageRecipients->count()}}</td>
                <td>{{$message->sent ? 'Yes' : 'No'}}</td>
                <td>
                        <span>
                             <a class="btn btn-secondary mr-1" href="{{route('send.email', $message->id)}}" >
                            Send
                        </a>
                        </span>
                       <span>
                             <a class="btn btn-secondary" href="{{route('messages.edit', $message->id )}}" >
                            Edit
                        </a>
                       </span>

                        {!! Form::open(['method' => 'DELETE', 'route' => ['messages.destroy', $message->id],
                                      'style' => 'display:inline-block'
                                      ]) !!}

                        <button type="submit" class="btn btn-danger ml-1" >
                           Delete
                        </button>
                        {!! Form::close() !!}

                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

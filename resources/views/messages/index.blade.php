@extends('layouts.app')

@section('content')
<link href="{{ asset('css/messages-index.css') }}" rel="stylesheet">
<div class="container">

<h1>Inbox</h1>

    <section>
        <h2>Received Messages</h2>
        @forelse ($receivedMessages as $message)
            <div class="message">
                <p><strong>From:</strong> {{ $message->sender->name }}</p>
                <p><strong>About:</strong> {{ $message->product->name }} - {{ $message->product->description }}</p>
                <img src="{{ $message->product->image }}" alt="{{ $message->product->name }}" style="max-width: 100px;">
                <p><strong>Message:</strong></p>
                <p>{{ $message->message }}</p>
                <p><small>Received on: {{ $message->created_at->toFormattedDateString() }}</small></p>
                <a href="{{ route('messages.reply', ['message' => $message->id]) }}" class="btn btn-primary">Reply</a>
            </div>
        @empty
            <p>No received messages.</p>
        @endforelse
    </section>

    <section>
        <h2>Sent Messages</h2>
        @forelse ($sentMessages as $message)
            <div class="message">
                <p><strong>To:</strong> {{ $message->receiver->name }}</p>
                <p>{{ $message->message }}</p>
                <p><small>Sent on: {{ $message->created_at->toFormattedDateString() }}</small></p>
            </div>
        @empty
            <p>No sent messages.</p>
        @endforelse
    </section>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reply to Message</h1>
    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $originalMessage->sender_id }}">
        <input type="hidden" name="product_id" value="{{ $originalMessage->product_id }}">
        <div class="form-group">
            <label for="message">Your Message</label>
            <textarea name="message" id="message" rows="4" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Reply</button>
    </form>
</div>
@endsection

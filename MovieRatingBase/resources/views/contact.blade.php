<!-- resources/views/contact.blade.php -->
@extends('layouts.app') <!-- Använd din grundlayout om du har en -->

@section('content')
<div class="container">
    <h2>Kontakta Oss</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="firstname" class="form-label">Förnamn</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Efternamn</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <!-- Lägg till fler fält här efter behov -->
        <div class="mb-3">
            <label for="message" class="form-label">Meddelande</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Skicka</button>
    </form>
</div>
@endsection

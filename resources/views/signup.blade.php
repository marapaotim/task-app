<?php use Illuminate\Support\Facades\Auth; ?>
@if (Auth::check())
    @php
        header("Location: " . URL::to('/tasks'), true, 302);
        exit();
    @endphp
@endif
@include('header')
        <h4>SIGNUP</h4>
        <hr>
        <form id="form_signup">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-success form-control">SUBMIT</button>
        </form>
@include('footer')

<?php use Illuminate\Support\Facades\Auth; ?>
@if (Auth::check())
    @php
        header("Location: " . URL::to('/tasks'), true, 302);
        exit();
    @endphp
@endif
@include('header')
    <h4>Login</h4>
    <hr>
        <form id="form_login">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-success form-control">LOGIN</button>
            <br>
            <br>
            <a href="/signup" class="btn btn-primary form-control">SIGN UP</a>
        </form>
@include('footer')

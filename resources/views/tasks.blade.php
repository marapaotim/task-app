<?php use Illuminate\Support\Facades\Auth; ?>
@if (!Auth::check())
    @php
        header("Location: " . URL::to('/'), true, 302);
        exit();
    @endphp
@endif
@include('header')

<center>
Welcome: <h5>{{Auth::user()->name}}</h5>
<button type="submit" class="btn btn-danger" onclick="logout()">Logout</button>
</center>
<br>
<br>

<div class="row">
    <div class="col-md-3">
        <h4>Add/Update Task</h4>
        <hr>
        <form id="form_task">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <input type="text" class="form-control" id="content" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status">
                    <option value="to-do">Todo</option>
                    <option value="in-progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Save Status:</label>
                <select class="form-control" id="save-status">
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success form-control">Save Task</button>
        </form>
    </div>
    <div class="col-md-9">
        <form class="form-inline" id="searchFrm">
            <div class="form-group mb-2">
                <label for="title-search">Search By Title:</label>
                <input type="text" class="form-control" id="title-search">
            </div>
            <button type="submit" class="btn btn-primary mb-2" id="search">Search</button>
            <div class="form-group mx-sm-3 mb-2">
                <label for="limit">Limit:</label>
                <select class="form-control" id="limit">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="search-status">
                    <option value="all">All</option>
                    <option value="to-do">Todo</option>
                    <option value="in-progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>
            <div class="form-group">
                <label for="save-status">Save Status:</label>
                <select class="form-control" id="search-save-status">
                    <option value="all">All</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="headerSortDown" onclick="sortTitle()" id="titleTable">TITLE</th>
                    <th>CONTENT</th>
                    <th>STATUS</th>
                    <th>SAVE STATUS</th>
                    <th class="headerSortDown" onclick="sortDateCreated()" id="dateCreatedTable">DATE CREATED</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody id="data"> 
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            Pages
            <ul class="pagination" id="pagination"></ul>
        </nav>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('task.js') }}" href="{{ asset('task.js') }}"></script>
</body>
</html>

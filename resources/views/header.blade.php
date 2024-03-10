<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .headerSortDown:after,
        .headerSortUp:after{
            content: ' ';
            position: relative;
            left: 10px;
            border: 7px solid transparent;
        }
        .headerSortDown:after{
            top: 10px;
            border-top-color: silver;
        }
        .headerSortUp:after{
            bottom: 15px;
            border-bottom-color: silver;
        }
        .headerSortDown,
        .headerSortUp{
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">

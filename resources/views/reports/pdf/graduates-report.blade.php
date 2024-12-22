<!DOCTYPE html>
<html lang="en">

<head>
    <title>OCF LIBERIA | {{ $title }}</title>
</head>
@php
    $count = 1;
@endphp
<style type="text/css">
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .heading-1 {
        font-size: 2em;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .heading-2 {
        font-size: 1.5em;
        font-weight: bold;
        margin-bottom: 5px;
        color: #005abb;
    }

    .paragraph {
        font-size: 1em;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th,
    .table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .table th {
        background-color: #005abb;
        color: white;
    }

    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

<body>
    <h2><span class="heading-2">{{ $title }}</span></h2>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Fullname</th>
                <th>School Type</th>
                <th>School Graduated</th>
                <th>Class Graduated</th>
                <th>Date Graduated</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($graduates as $graduate)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $graduate->fullname }}</td>
                    <td>{{ $graduate->schoolType->name }}</td>
                    <td>{{ $graduate->school_graduated }}</td>
                    <td>{{ $graduate->class_graduated }}</td>
                    <td>{{ $graduate->date_graduated }}</td>
                </tr>
                @php
                    $count++;
                @endphp
            @endforeach
        </tbody>
    </table>
    <footer style="margin-top: 20">
        <p>&copy; {{ date('Y') }} OCFLIBERIA, All Rights Reserved</p>
    </footer>
</body>

</html>

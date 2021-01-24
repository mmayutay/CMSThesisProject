<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        
    </head>
    <body class="antialiased">
        <h1>Sample</h1>
        <table>
        @foreach($users as $user)
            <tr>
               <td>Lastname: {{$user->lastname}}</td>   
            </tr>
            <tr>
                <td>Firstname:{{$user->firstname}}</td>
            </tr>
            <tr>
                <td>Birthdate:{{$user->birthday}}</td>
            </tr>
            <tr>
                <td>Age:{{$user->age}}</td>
            </tr>
            <tr>
                <td>Address: {{$user->address}}</td>
            </tr>
            <tr>
                <td>Marital Status: {{$user->marital_status}}</td>
            </tr>
            <tr>
                <td>Email: {{$user->email}}</td>
            </tr>
            <tr>
                <td>Contact: {{$user->contact_number}}</td>
            </tr>
            <tr>
                <td>Facebook: {{$user->facebook}}</td>
            </tr>
            <tr>
                <td>Instagram: {{$user->instagram}}</td>
            </tr>
            <tr>
                <td>Twitter: {{$user->twitter}}</td>
            </tr>
            <tr>
                <td>Leader: {{$user->leader}}</td>
            </tr>
            <tr>
                <td>Categories: {{$user->category}}</td>
            </tr>
            
        @endforeach 
        </table>
    </body>
</html>

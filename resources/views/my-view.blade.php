<!DOCTYPE html>
<html lang="">
<head>
    <title>API Data</title>
</head>
<body>
<h1>Users</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user['id'] }}</td>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['email'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h1>User Posts</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Body</th>
    </tr>
    </thead>
    <tbody>
    @foreach($userPosts as $post)
        <tr>
            <td>{{ $post['id'] }}</td>
            <td>{{ $post['title'] }}</td>
            <td>{{ $post['body'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h1>User Todos</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
    </tr>
    </thead>
    <tbody>
    @foreach($userTodos as $todo)
        <tr>
            <td>{{ $todo['id'] }}</td>
            <td>{{ $todo['title'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>


</body>
</html>


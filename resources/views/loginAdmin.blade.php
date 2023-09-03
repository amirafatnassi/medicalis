<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin Login</title>
</head>

<body>
    <div>
        <h2>Admin Login</h2>
        <form method="POST" action="{{ url('loginAdmin') }}">
            {{ csrf_field() }}
            <div>
                <label for="name">Username:</label>
                <input type="text" name="name" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>

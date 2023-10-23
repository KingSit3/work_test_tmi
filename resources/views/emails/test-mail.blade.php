<!DOCTYPE html>
<html lang="en">
<head>
  <title>Test Email</title>
</head>
<body>
  <div class="">
    Test email on: {{ now() }}
    <p>name: {{ $user["name"] }}</p>
    <p>email: {{ $user['email'] }}</p>
  </div>
</body>
</html>

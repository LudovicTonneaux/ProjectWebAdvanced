<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login - Monkey Business</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- JS Libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<h1>Home</h1>
<h2>Welcome <?php echo $username; ?>!</h2>
<h3><?php echo anchor('person', 'Person', 'class="link-class"') ?></h3>
<h3><?php echo anchor('event', 'Event', 'class="link-class"') ?></h3>
<a href="home/logout" class="btn btn-success">Logout</a>
</body>
</html>
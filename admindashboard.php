<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <style>
    body {
      background-color:darkred;
      background-image: url('./bloodimage/img2.jpg');
      
      background-repeat:no-repeat;
      background-size:cover;
    }
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h2 {
      text-align: center;
    }

    .dashboard-menu {
      display: flex;
      flex-direction: column;
      padding: 10px;
      background-color: red;
      margin-bottom: 20px;
    }

    .dashboard-menu li {
      margin-bottom: 10px;
      width: 400px;
    }

    .dashboard-menu li a {
      color: white;
      text-decoration: none;
      padding: 5px 10px;
      display: block;
      text-align:right;
    }

    .dashboard-menu .logout-link {
      background-color: darkred;
    }

    .dashboard-menu .logout-link:hover {
      background-color: maroon;
    }
    
    .dashboard-menu-column {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
    }

    .dashboard-menu-column:not(:last-child) {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Welcome, Admin</h2>
    <div class="dashboard-menu-column">
      <ul class="dashboard-menu">
        <li><a class="logout-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="dashboard-menu-column">
      <ul class="dashboard-menu">
        <li><a href="inbox.php">Inbox</a></li>
        <li><a href="searchdonors.php">Search Donors</a></li>
        <li><a href="activedonors.php">Active Donors</a></li>
        <li><a href="notactivedonors.php">Not Active Donors</a></li>
        <li><a href="needblood.php">Need Blood</a></li>
        <li><a href="settings.php">Settings</a></li>
      </ul>
    </div>
  </div>
</body>
</html>
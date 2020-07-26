@extends('layouts.main')
@section('content')
<br><br><br>
<head>
    <title>Create Employees</title>
</head>
<body>
    <h1>Create Employees</h1>
               
<form method="GET" action="create">
    @csrf

    <label for="fname">First name:</label>
    <input type="text" id="fname" name="fname" value=""><br>

    <label for="lname">Last name:</label>
    <input type="text" id="lname" name="lname" value=""><br>

    <label for="nic">NIC:</label>
    <input type="text" id="nic" name="nic" value=""><br>

    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" value=""><br>

    <label for="birthday">Birthday:</label>
    <input type="date" id="birthday" name="birthday" value=""><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value=""><br>

    <label for="target">Target:</label>
    <input type="text" id="target" name="target" value=""><br>

    <label for="salary">Salary:</label>
    <input type="text" id="salary" name="salary" value=""><br>

    <label for="salary_type">Salary Type:</label>
    <input type="text" id="salary_type" name="salary_type" value=""><br>

    <label for="commission">Commission:</label>
    <input type="text" id="commission" name="commission" value=""><br>

    <label for="joined_date">Joined Date:</label>
    <input type="date" id="joined_date" name="joined_date" value=""><br><br>
    
    <input type="submit" value="Save">
    
  </form>
</body>
   
@endsection
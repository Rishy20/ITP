@extends('layouts.main')
@section('content')
{

    <div class="container">
       <div class="jumbotron">

     @if(\Session::has('success'))
     <div class="alert alert-danger">
     <p>{{\Session::get('success')}}</p>
     </div>
     @endif


    <form method ="POST" action="{{action('BankAccountController@store')}}">
{{csrf_field()}}

  <div class="form-group">
    <label>Account Number</label>
    <input type="text" class="form-control" name="number" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Account Number">
  </div>

  <div class="form-group">
    <label>Account Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Account Name">
  </div>

  <div class="form-group">
    <label>Account Type</label>
    <input type="text" class="form-control" name="type" id="type" placeholder="Enter Account Type">
  </div>

  <div class="form-group">
    <label>Bank Name</label>
    <input type="text" class="form-control" id="bankname" name="bankname" placeholder="Enter Bank Name">
  </div>

  <div class="form-group">
    <label>Branch Name</label>
    <input type="text" class="form-control" id="branchname" name="branchname" placeholder="Enter Branch Name">
  </div>

  <button type="submit" name="submit" class="btn btn-primary " style="width:80%">Submit</button>

  </form>

<br><br><br>

<table class="table table-bordered">

    <thead class="thead-dark">
       <tr>
        <th>ID</th>
        <th>Number</th>
        <th>Name</th>
        <th>Type</th>
        <th>Bank Name</th>
        <th>Branch Name</th>
        <th>Edit</th>
        <th>Delete</th>

        </tr>
    </thead>
       <tbody>
           @foreach($banks as $row)
           <tr>
             <td>{{ $row->id }}</td>
             <td>{{ $row->number }}</td>
             <td>{{ $row->name }}</td>
             <td>{{ $row->type }}</td>
             <td>{{ $row->bankname }}</td>
             <td>{{ $row->branchname }}</td>
             <td>
                 <a href="{{action('BankAccountController@edit',$row['id'])}}" class="btn btn-success">EDIT</a>
              </td>
              <td>
                 <form action="{{action('BankAccountController@destroy', $row['id'])}}" method="POST">

                 {{csrf_field()}}

                 <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">DELETE</button>

              </td>
           </tr>
    @endforeach
    </tbody>


</table>

       </div>
    </div>
}
@endsection

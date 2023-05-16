@extends('layout.app')

@section('title-block')Task 1
@endsection

@section('content')
<div class="company-header"></div>
<div class="company-text">
	<p></p>
	
    <hr class="hr-horizontal-gradient">
</div>
<!-- <div class="company-text"> -->
    <div></div>


<div class="container text-center">
<!-- <div class="container"> -->
    <div class="row align-items-start">
@if($data)
    
    <table class="table table-striped">
	    <thead class="table-primary">
		    <tr>
                <th>Id</th>
			    <th>Name</th>
	    		<th>Author</th>
	    		<th>Books</th>
	    	</tr>
	    </thead>
	    <tbody>
            @foreach($data['result'] as $key => $item)
	    	<tr>
                <td>{{ $item->ID }}</td>
	    		<td>{{ $item->Name }}</td>
	    		<td>{{ $item->Author }}</td>
	    		<td>{{ $item->Books }}</td>
	    	</tr>
            @endforeach
	    </tbody>
    </table>
@endif
    </div>
    <hr class="hr-horizontal-gradient">
  <div class="row row align-items-start">
    <div class="col">
        users
        <table class="table table-striped">
	        <thead class="table-secondary">
	        	<tr>
                    <th>Id</th>
	        		<th>first_name</th>
	        		<th>last_name</th>
	        		<th> birthday </th>
	        	</tr>
	        </thead>
	        <tbody>
            @foreach($data['users'] as $item)
	        	<tr>
                    <td>{{ $item['id'] }}</td>
	        		<td>{{ $item['first_name'] }}</td>
	        		<td>{{ $item['last_name'] }}</td>
	        		<td>{{ $item['birthday'] }}</td>
	        	</tr>
            @endforeach
	        </tbody>
        </table>
    </div>
    <div class="col">
        books
        <table class="table table-striped">
	        <thead class="table-secondary">
	            <tr>
                    <th></th>
                    <th>Id</th>
	          		<th>name</th>
	          		<th>author</th>
	          	</tr>
	        </thead>
	        <tbody>
            @foreach($data['books'] as $item)
	        	<tr>
                    <td><?//=$user['id'];?></td>
                    <td>{{ $item['id'] }}</td>
	        		<td>{{ $item['name'] }}</td>
	        		<td>{{ $item['author'] }}</td>
	        	</tr>
            @endforeach

	        </tbody>
        </table>
    </div>
    <div class="col">
    books
        <table class="table table-striped">
	        <thead class="table-secondary">
	            <tr>
                    <th>id</th>
                    <th>user_id</th>
                    <th>book_id</th>
	          		<th>get_date</th>
	          		<th>return_date</th>
	          	</tr>
	        </thead>
	        <tbody>
            @foreach($data['userBooks'] as $item)
	        	<tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->user_id }}</td>
                    <td>{{ $item->book_id }}</td>
	        		<td>{{ $item->get_date }}</td>
	        		<td>{{ $item->return_date }}</td>
	        	</tr>
            @endforeach
	        </tbody>
        </table>
    </div>
  </div>
</div>

@endsection
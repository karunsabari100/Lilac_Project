
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<style>

    body{
        background-color: #dee2e6;
    }
.card{
    margin-bottom: 15px;
    margin-left: 10px;
    margin-right: 10px;
    width: 80%;
    
}
    </style>
<body>

<br><br><br><br>


    <form class="form-inline my-6 my-lg-0 ml-auto">
        <center>
          <h4>Search</h4>  
      <input class="form-control" type="search" id="search" placeholder="Search name / department / designation" aria-label="Search" style="width:60%;" oninput="SearchResult()">
    
    </form>


  <br><br>

<div class="row" id="user_list">

    @foreach ($usr as $u)
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{$u->name}}</h5>
          <p class="card-text">{{$u->UserDesignation->name}}</p>
          <p class="card-text">{{$u->UserDepartment->name}}</p>
          
          
        </div>
      </div>
    </div>
   
    @endforeach   
      
  </div>
</center>
</body>
</html>


<script>
function SearchResult()
      {
        var search_data=$('input#search').val();
        $('#user_list').css({ 'opacity' : 0.1 });
          $.ajax({
    url:"/search-user",
    method:"POST",
    data:{search_data:search_data,_token: @json(csrf_token())},
   success:function(data)
   {
    $('#user_list').css({ 'opacity' : 1 });
        $('#user_list').show();
        $('#user_list').html(data);
   }
  });
      }


</script>
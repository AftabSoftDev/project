@extends('layout')

@section('content')
<div class="container">
    @if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
{{ session('msg') }}
    <form id="UserData">
        <div class="row">

            <div class="col-md-2">
                <button type="button" class="btn btn-success submit">Add New Company</button>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="co_name" required id="co_name" />
                <input type="hidden"  name="csrf" id="csrf" value="{{Session::token()}}">
            </div>

        </div>
    </form>

    <a href="/home"></a>
    <table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Company Name</th>
        <th scope="col">Assign Users</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody >

        <?php
      $num=1;

   foreach ($comData as $info) {
      echo "<tr>";


  ?>
        <th scope="row"><?php echo $num; ?></th>
        <td><?php echo $info->name; ?></td>
        <td>
        <a href='/AssignUser/{{ $info->id; }}'><button type="button"  class="btn btn-primary">Assign Users</button></a>
        </td>
        <td>
            <a href='#' data-edit_id="{{ $info->id; }}"><button type="button" class="btn btn-dark updateUser">Edit</button></a>
  </td>
  <td>
    <a href='/comDelete/{{$info->id;}}'><button type="button"  class="btn btn-danger">Delete</button></a>
    </td>

        <?php

        echo "</tr>";
       $num++;//
     }//
        ?>

    </tbody>
  </table>
  <form id="ComUpdate"  style="display:none;">
    <div class="row">

        <div class="col-md-2">
            <button type="button" class="btn btn-primary Saveupdate">Update Company</button>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" name="nameup" required id="nameup" />
            <input type="text" class="form-control" name="id_update" hidden required id="id_update" />
        </div>

    </div>
</form>


      </div>

      <script>
      $(document).ready(function() {

$('.submit').on('click', function() {
  var name = $('#co_name').val();
  if(name!=""){
    /*  $("#butsave").attr("disabled", "disabled"); */
      $.ajax({
          url: "/storeCompany",
          type: "POST",
          data: {
              _token: $("#csrf").val(),
              name: name
          },
          cache: false,
          success: function(data){
            var dataResult = JSON.parse(data);
            if (dataResult.msg==200) {
                $('#UserData')[0].reset();
                    alert('Successfully Added !!');
                    location.reload();

                }else if(dataResult.msg==201){
                    $('#UserData')[0].reset();
                        alert('Unble to Add !!');
                  }
                  else if(dataResult.msg==404){
                    $('#UserData')[0].reset();
                             alert("Something Went Wrong !!");
                  }


                }

          })
        }else{
      alert('Please fill all the field !');
  }

});
});

  $(document).ready(function() {

    $('#delete').on('click', function() {
      var del_id = $('#del_id').val();
          $.ajax({
              url: "/comDelete",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                  id: del_id

              },
              success: function(dataResult){
                  console.log(dataResult);
                  window.location="http://localhost:8000/show";
              }
          });

  });
});

$(document).ready(function() {

$('.Saveupdate').on('click', function() {
  var nameup = $('#nameup').val();
  var id_update = $('#id_update').val();

  if(nameup!=""){
      $.ajax({
          url: "/ComUpdateSave",
          type: "POST",
          data: {
              _token: $("#csrf").val(),
              name: nameup,
              id: id_update
          },
          cache: false,
          success: function(data){
            var dataResult = JSON.parse(data);
            if (dataResult.msg==200) {
                // $('#UserUpdate')[0].reset();
                    alert('Successfully Updated !!');
                    location.reload();
                // window.location="/home";


                }else if(dataResult.msg==201){

                        alert('Unble to Updated !!');
                        location.reload();
                  }



                }

          })
        }else{
      alert('Please fill all the field !');
  }

});
});


$(document).ready(function() {
$('.updateUser').on('click', function() {

    var id=  $(this).closest('a').data('edit_id');
  if(id!=""){

      $.ajax({
          url: "/comGetUpdate",
          type: "POST",
          data: {
              _token: $("#csrf").val(),
              id: id
          },
          cache: false,
          success: function(data){
            var dataResult = JSON.parse(data);
            if (dataResult.msg==200) {
                $("#ComUpdate").show();
                $("#ComUpdate #nameup").val(dataResult.data.comUpdateData.name);
                $("#ComUpdate #id_update").val(dataResult.data.comUpdateData.id);

                }else if(dataResult.msg==201){
                    $('#ComUpdate')[0].reset();
                        alert('Unble to Add !!');
                  }
                  else if(dataResult.msg==404){
                    $('#ComUpdate')[0].reset();
                             alert("Something Went Wrong !!");
                  }


                }

          })
        }else{
      alert('Please fill all the field !');
  }

});
});
      </script>

@endsection

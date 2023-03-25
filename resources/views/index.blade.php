@extends('layout')

@section('content')
<div class="container">
    <form id="UserData">
        <div class="row">

            <div class="col-md-2">
                <button type="button" class="btn btn-success submit">Add New User</button>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="name" required id="name" />
                <input type="hidden"  name="csrf" id="csrf" value="{{Session::token()}}">
            </div>

        </div>
    </form>


    <a href="/home"></a>
    <table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody >

        <?php
      $num=1;

   foreach ($userData as $info) {
      echo "<tr>";


  ?>
        <th scope="row"><?php echo $num; ?></th>
        <td>{{ $info->name; }}</td>
        <td>
            <a href='/userDelete/{{ $info->id; }}'><button type="button"  class="btn btn-danger">Delete</button></a>
        </td>
        <td>
        <a href='#' data-edit_id="{{ $info->id; }}"><button type="button" class="btn btn-dark updateUser">Edit</button></a>
  </td>

        <?php

        echo "</tr>";
       $num++;
     }
        ?>

    </tbody>
  </table>
  <form id="UserUpdate"  style="display:none;">
    <div class="row">

        <div class="col-md-2">
            <button type="button" class="btn btn-primary Saveupdate">Update User</button>
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
  var name = $('#name').val();
  if(name!=""){
    /*  $("#butsave").attr("disabled", "disabled"); */
      $.ajax({
          url: "/AddData",
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
                // window.location="/home";


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

$('.Saveupdate').on('click', function() {
  var nameup = $('#nameup').val();
  var id_update = $('#id_update').val();

  if(nameup!=""){
      $.ajax({
          url: "/UpdateSave",
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

    $('#userDelete').on('click', function() {
      var idArray=  $('#user_id').val();
      $.each(idArray, function(index, id) {
      console.log(idArray);

          $.ajax({
              url: "/userDelete",
              type: "post",
              dataType: "json",
              data: {
                _token: $("#csrf").val(),
                user_id: id
              },
              async: true,
              success: function(data){
                var dataResult = JSON.parse(data);
            if (dataResult.msg==200) {
                    alert('Successfully Deleted !!');
                    $('#userDelete').selectpicker('refresh');
                // window.location="/home";

                }else if(dataResult.msg==201){
                        alert('Unble to Delete !!');
                  }

              }
          });
        });

  });
});

$(document).ready(function() {
$('.updateUser').on('click', function() {

    var id=  $(this).closest('a').data('edit_id');
  if(id!=""){

      $.ajax({
          url: "/userGetUpdate",
          type: "POST",
          data: {
              _token: $("#csrf").val(),
              id: id
          },
          cache: false,
          success: function(data){
            var dataResult = JSON.parse(data);
            if (dataResult.msg==200) {
                $("#UserUpdate").show();
                $("#UserUpdate #nameup").val(dataResult.data.UserUpdateData.name);
                $("#UserUpdate #id_update").val(dataResult.data.UserUpdateData.id);

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
      </script>

@endsection

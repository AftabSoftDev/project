@extends('layout')

@section('content')
<div class="container">


        <div class="container">

            <form action="/AssigUser" method="POST">
                <div class="row">
                    @csrf
        <label><b>Add Users to "{{ $comData->name; }}"</b></label>
      <?php
      $num=1;

   foreach ($userData as $info) {
      echo "<tr>";


  ?>



                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="user_id[]" value="{{ $info->id; }}">
                    <label class="form-check-label" for="{{ $info->id; }}">
                        {{ $info->name; }}
                    </label>
                  </div>




        <?php

        echo "</tr>";
       $num++;//
     }//
        ?>

</div>
<input type="text" name="com_id" value="{{ $comData->id; }}" hidden />
<button type="submit" class="btn btn-success assign_submit">Assign User</button>
<a href="/getData"><button type="button" class="btn btn-dark assign_submit">Back</button></a>
</form>
</div>

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

<?php


  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "examples";
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  global $result;
    $sql = "SELECT * FROM cars";
    $result = $conn->query($sql);

  
  $conn->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>Bai3</title>
</head>
<body>
  <div class="container mt-5">
    <h1>Read Products</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New Product</button>
    <h3 id="addSuccess" class="text-danger"></h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Year</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="resbody">
        <?php if ($result->num_rows > 0) {?>
          <?php while($row = $result->fetch_assoc()) {?>
        <tr id="record<?php echo $row['id']?>">
          <th scope="row"><?php echo $row['id']?></th>
          <td><?php echo $row['name']?></td>
          <td><?php echo $row['year']?></td>
          <td>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-id="<?php echo $row['id']?>" data-bs-name="<?php echo $row['name']?>" data-bs-year="<?php echo $row['year']?>">Edit</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="<?php echo $row['id']?>">Delete</button>
          </td>
        </tr>
          <?php }?>
        <?php } else {?>
          <td colspan="4" style="width: 100%; text-align: center">Không có dữ liệu</td>
        <?php }?>
      </tbody>
    </table>
  </div>

  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Create New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
          <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="newname" name="name" required>
                <p class="text-danger" id="nameerr"></p>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" class="form-control" id="newyear" rows="3" name="year" required></input>
                <p class="text-danger" id="yearerr"></p>
            </div>
            <button type="button" class="btn btn-primary" id="addBtn" >Add Product</button>
            <button type="button" id="addclose" class="btn btn-secondary" data-bs-dismiss="modal" style="display: none">Close</button>
          </div>
        </div>
      </div>
  </div>

  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
          <input type="hidden" value="" name="id" id="editproduct">
          <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="editname" name="name" value="" required>
                <p class="text-danger" id="editnameerr"></p>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="text" class="form-control" id="edityear" rows="3" name="year" value="" required></input>
                <p class="text-danger" id="edityearerr"></p>
            </div>
            <button type="button" class="btn btn-primary" id="editBtn" >Confirm</button>
            <button type="button" id="editclose" class="btn btn-secondary" data-bs-dismiss="modal" style="display: none">Close</button>
          </div>
        </div>
      </div>
  </div>


  
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Confirm delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
            <div class="modal-body">
              Are you sure you want to delete?
              This action cannot be undone.
              <input type="hidden" value="" name="id" id="deleteid">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="deleteBtn">Confirm</button>
            </div>
          </div>
        </div>
    </div>

<script>
  $(document).ready(() => {
  var editModal = $('#editModal')
  editModal.on('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var idproduct = button.getAttribute('data-bs-id')
  var name = button.getAttribute('data-bs-name')
  var year = button.getAttribute('data-bs-year')
  var modalBodyId = $("#editproduct")
  var modalBodyName = $("#editname")
  var modalBodyYear = $("#edityear")
  modalBodyId.val(idproduct)
  modalBodyName.val(name)
  modalBodyYear.val(year)
  })


  var deleteModal = $('#deleteModal')
  deleteModal.on('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var recipient = button.getAttribute('data-bs-id')
  var modalBodyInput = $('#deleteid')
  modalBodyInput.val(recipient)
  })

  var flagAdd = 1
  $("#addBtn").click(function() {
    if ($("#newname").val().length < 5 || $("#newname").val().length > 40) {
      $("#nameerr").html("Name must be between 5 and 40 characters!")
      $("#newname").focus()
      flagAdd = 0
    }
    if ($("#newyear").val() < 1990 || $("#newyear").val() > 2022) {
      $("#yearerr").html("Year must be between 1990 and 2022!")
      $("#newyear").focus()
      flagAdd = 0
    }
    if (flagAdd == 1) {
      if(!$.active){
      $.ajax({
        cache: false,
        url: "b.php",
        method: "POST",
        data: {
          name: $("#newname").val(),
          year: $("#newyear").val()
        },
        success: function( result ) {
          $( "#addSuccess" ).html("Add New Product Successfully")
          $("#addclose").click()
          console.log(result)
          result = JSON.parse(result)
          $("#resbody").append(`<tr>
          <th scope="row">${result.id}</th>
          <td>${result.name}</td>
          <td>${result.year}</td>
          <td>
            <a href="c.php?id=${result.id}"><button type="button" class="btn btn-info">Edit</button></a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="${result.id}">Delete</button>
          </td>
        </tr>`)
        }
      })
    }
  }
  })


  var flagEdit = 1
  $("#editBtn").click(function() {
    if ($("#editname").val().length < 5 || $("#editname").val().length > 40) {
      $("#editnameerr").html("Name must be between 5 and 40 characters!")
      $("#editname").focus()
      flagEdit = 0
    }
    if ($("#edityear").val() < 1990 || $("#edityear").val() > 2022) {
      $("#edityearerr").html("Year must be between 1990 and 2022!")
      $("#edityear").focus()
      flagEdit = 0
    }
    if (flagEdit == 1) {
      if(!$.active){
      $.ajax({
        cache: false,
        url: "c.php",
        method: "POST",
        data: {
          id: $("#editproduct").val(),
          name: $("#editname").val(),
          year: $("#edityear").val()
        },
        success: function( result ) {
          $( "#addSuccess" ).html("Update Successfully")
          $("#editclose").click()
          console.log(result)
          result = JSON.parse(result)
          $("#record"+$("#editproduct").val()).replaceWith(`<tr>
          <th scope="row">${result.id}</th>
          <td>${result.name}</td>
          <td>${result.year}</td>
          <td>
            <a href="c.php?id=${result.id}"><button type="button" class="btn btn-info">Edit</button></a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="${result.id}">Delete</button>
          </td>
        </tr>`)
        }
      })
    }
  }
  })

  $("#deleteBtn").click(function () {
    if(!$.active){
      $.ajax({
        cache: false,
        url: "d.php",
        method: "POST",
        data: {
          id: $("#deleteid").val()
        },
        success: function( result ) {
          $( "#addSuccess" ).html("Delete Successfully")
          $("#deleteBtn").click()
     
      
          $("#record"+$("#deleteid").val()).remove()
          
        }
      })
    }
  })

  })
</script>
</body>
</html>
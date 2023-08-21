<?php
$insert = false;
$update = false;
$delete = false;
$server = "localhost";
$user = "root";
$password = "";
$databse = "Notebook";

$conn = mysqli_connect($server, $user, $password, $databse);
if (!$conn) {
  die("connection is not connected ".mysqli_connect_error());
}
?>

<!-- *****************Insert and update into php********************** -->

<?php
   if(isset($_GET['delete'])){
    $del = $_GET['delete'];
    $sql = "DELETE FROM `notes` WHERE `s no` = $del";
    $result = mysqli_query($conn, $sql);
    $delete = true;
   }
?>
<?php
  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snoEdit'])) {
    $snoEdit = $_POST['snoEdit'];
    $title = $_POST['titleEdit'];
    $desc = $_POST['DescriptionEdit'];
    $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$desc' WHERE `notes`.`s no` = '$snoEdit'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    }
    if (isset($_POST['snoDel'])) {
      
      echo "deleted successfully";
  }
    
  } else 
  {
    $title = $_POST['title'] ?? "";
    $desc = $_POST['Description'] ?? "";
    $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$desc')";
    $result = mysqli_query($conn, $sql);
    $insert = true;
  }

}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
  <!-- ************* Navbar ****************** -->
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-primary" href="#">Notebook</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Contact us</a>
          </li>

        </ul>
        <form class="d-flex" role="search">
          <input id="myInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>


  <!--Edit Modal -->
  <div class=" modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editmodalLabel">Edit this note!</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/crud/index.php" method="post">
            <div class="mb-3">
              <input type="hidden" name="snoEdit" id="snoEdit">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="border-dark form-control" id="titleEdit" name="titleEdit"
                aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label for="Description" class="form-label">Note Description</label>
              <textarea required class="border-dark form-control" name="DescriptionEdit" id="DescriptionEdit"
                rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update note</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php

  if ($insert) {
    echo
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your Note Has Been Successfully <strong>Inserted</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }

  if ($update) {
    echo
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your Note Has Been Successfully <strong>Updated</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  if ($delete) {
    echo
      '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your Note Has Been Successfully <strong>Deleted</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }

  ?>

  <!-- ****************Form*************** -->
  <div class="container col-md-8 my-4">
    <h2 class="text-primary" >Add A Note Here</h2>
    <form action="/crud/index.php" method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input placeholder="Enter Note Title..." type="text" class="border-dark form-control" id="title" name="title" aria-describedby="emailHelp"
          required>
      </div>
      <div class="mb-3">
        <label for="Description" class="form-label">Note Description</label>
        <textarea placeholder="Example : @journey of Knowledge...: Unveiling Insights Through Notes" required class="border-dark form-control" name="Description" id="Description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add note</button>
    </form>
  </div>
  <!-- ***********data fetching************* -->
  <div class="container">
    <hr >
  </div>
  <div class="container col-md-8 my-4 ">
    <h2 class="text-dark">Your Notes</h2>
    <input class=" my-3 form-control border-dark" id="myInput" type="text" placeholder="Search..">
    <br>
    <table class="table table-responsive table-striped table-light ">
      <thead>
        <tr>
          <th>Sno</th>
          <th>Title</th>
          <th>Description</th>
          <th class="col-2">Action</th>
        </tr>
      </thead>
      <tbody id="myTable">

        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $no = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $no = $no + 1;
          echo "<tr >
          <td  >" . $no . "</td>
          <td>" . $row['title'] . "</td>
          <td >" . $row['description'] . "</td>
          <td>
          <div class='div actionButton'>
            <button class='edit btn  btn-xs btn-primary' data-bs-toggle='modal' data-bs-target='#editmodal' id =" . $row['s no'] . ">Edit</button>

            <button class='btn btn-xs btn-danger del' id =d" . $row['s no'] . ">Delete</button>
          </div>
          </td>
          </tr>";
        }

        ?>
      </tbody>
    </table>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<!-- Jquery for searching -->
<script>
  $(document).ready(function () {
    $("#myInput").on("keyup", function () {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

<script>
  //edit script
  edits = document.getElementsByClassName("edit");
  Array.from(edits).forEach((element) => {
    element.addEventListener('click', (e) => {
      tr = e.target.parentNode.parentNode.parentNode;
      title = tr.getElementsByTagName("td")[ 1 ].innerText;
      description = tr.getElementsByTagName("td")[ 2 ].innerText;
      titleEdit.value = title;
      DescriptionEdit.value = description;
      snoEdit.value = e.target.id;
    });
  })
</script>

<script>
   //delete script
  del = document.getElementsByClassName("del");
  Array.from(del).forEach((element) => {
    element.addEventListener('click', (e) => {
      tr = e.target.parentNode.parentNode.parentNode;
      draft = e.target.id;
      snoDel =draft.slice(1);

      if (confirm("press a button")) {
        console.log("yes");
      }else{
        console.log("No");
      }
      console.log(snoDel.value);
      window.location = `/crud/index.php?delete= ${snoDel}`;

    });
  })
</script>

</html>
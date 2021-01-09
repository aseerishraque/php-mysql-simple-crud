<!doctype html>
<html lang="en">
<?php if (!isset($_SESSION)) {
  session_start();
  }
  ?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    
    <title>AWS | CRUD </title>
  </head>
  <body class="bg-light">
    <div class="container">
    <h2 class="text-center">Testing CRUD in AWS EC2</h2>
    <div class="row justify-content-center">
      <div class="col-md-10">
      <div class="card">
  
  <div class="card-body">
    <div class="card-title mb-4">
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add User
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
            <div class="col-md-12">
             <form action="process.php" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input name="name" type="text" class="form-control" >
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" type="email" class="form-control">
                
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input name="phone" type="number" class="form-control" >
                
                  </div>
              
                  <button name="add" type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>
    <table id="table_id" class="display">
                  <thead>
                      <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </tr>
                  </thead>
                  <tbody>

                  <?php
                      include_once('conn.php');
                      
                      $sql = "SELECT * FROM users";
                      $result = $conn->query($sql);
                      
                      if ($result->num_rows > 0) {
                        $i = 1;
                        // output data of each row
                        while($row = $result->fetch_assoc()) 
                        {
                            ?>
 <tr>
                          <td><?php echo $i++;  ?></td>
                          <td><?php echo $row['name']; ?> </td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                          <td>
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Edit_<?php echo $row['id']; ?>">
                            Edit
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="Edit_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                              <?php
                                    $sql1 = "SELECT * FROM users WHERE id = ".$row['id'];
                                    $result1 = $conn->query($sql1);
                                    $update = array();
                                    if ($result1->num_rows > 0) {
                                      // output data of each row
                                      while($row1 = $result1->fetch_assoc()) {
                                        $update = $row1;
                                      }
                                    } else {
                                      echo "0 results";
                                    }
                              ?>

                                
                                <div class="row">
                                              <div class="col-md-12">
                                <form action="process.php" method="post">
                                <input name="update_id" type="hidden" value="<?php echo $update['id'] ?>">
                                                    <div class="form-group">
                                                      <label for="exampleInputEmail1">Name</label>
                                                      <input value="<?php echo $update['name'] ?>" name="name" type="text" class="form-control" >
                                                      
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="exampleInputEmail1">Email address</label>
                                                      <input value="<?php echo $update['email'] ?>" name="email" type="email" class="form-control">
                                                  
                                                    </div>

                                                    <div class="form-group">
                                                      <label for="exampleInputEmail1">Phone</label>
                                                      <input value="<?php echo $update['phone'] ?>" name="phone" type="number" class="form-control" >
                                                  
                                                    </div>
                                              
                                              
                                              </div>
                                          </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button name="update" type="submit" class="btn btn-info">Update User</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          </td>
                          <td>
                          <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Delete_1">
                                      Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="Delete_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            Are you sure to delete the User?
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="process.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                          </td>
                      </tr>

                            <?php




                        }
                      } else {
                        echo "0 results";
                      }

                  ?>

                     
                     
                  </tbody>

                  <tfoot>
                      <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </tr>
                  </tfoot>
        </table>
  </div>
</div>       
      </div>
    </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    <script>
          $(document).ready( function () {
          $('#table_id').DataTable();
      } );
</script>

<script>
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}


<?php




  if(isset($_SESSION['warning'])){
    ?>
        // Display a warning toast, with no title
        toastr.warning('<?php echo $_SESSION['warning'] ?>', 'Warning!');
        
    <?php
    unset($_SESSION['warning']);
  }
  if(isset($_SESSION['success'])){
    ?>

        // Display a success toast, with a title
        toastr.success('<?php echo $_SESSION['success'] ?>', 'Success!');
        <?php
        unset($_SESSION['success']);
  }
  if(isset($_SESSION['error'])){
    ?>

        // Display an error toast, with a title
        toastr.error('<?php echo $_SESSION['error'] ?>', 'Error!');
<?php
unset($_SESSION['error']);
  }
?>

</script>
  </body>
</html>
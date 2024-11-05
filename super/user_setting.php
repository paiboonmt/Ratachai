<?php 
    include('./asset/middleware.php');
    $title = 'User Setting';
    $page = 'user_setting';

    require_once('../includes/connection.php');
    $sql = 'SELECT * FROM `tb_user`';
    $stmt = $conndb->query($sql);
    $stmt->execute();
?>

  <?php include('./asset/header.php') ?>
  <div class="wrapper">
      <?php include('./asset/aside.php') ?>
      <div class="content-wrapper">
          <div class="content">
              <div class="container-fluid">

              <div class="row">
                <div class="col p-1">
                    <div class="card p-2">
                        <div class="row" >
                            <div class="col">
                                <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#staticBackdrop">
                                CREATE USER
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modal Create user</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="./user/usersql.php" method="post">
                                <div class="modal-body">
                                        <div class="form-group">
                                            <label for="id">USERNAME : </label>
                                            <input type="text" name="username" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="id">PASSWORD : </label>
                                            <input type="text" name="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">USER TYPE : </label>
                                            <select class="form-control" id="role" name="role">
                                                <option selected>-Cloose-</option>
                                                <option value="account">account</option>
                                                <option value="admin">admin</option>
                                            </select>
                                        </div>
                                 
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="create" class="btn btn-primary">SAVE</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col p-1">
                    <div class="card p-2">
                        <table class="table" id="user_table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>User Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php foreach ( $stmt as $row) : ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td><?= $row['role'] ?></td>
                                        <td>
                                            
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $row['id'] ?>">
                                            <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="edit<?=$row['id']?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Edite User Type</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                    
                                                       <form action="./user/usersql.php" method="post">
                                                            <div class="form-group">

                                                                <label for="id">ID : </label>
                                                                <input type="text" name="id" class="form-control" value="<?= $row['id'] ?>">
                                                            
                                                                <label for="id">Username : </label>
                                                                <input type="text" name="username" class="form-control" value="<?= $row['username'] ?>">

                                                                <label for="id">Password : </label>
                                                                <input type="text" name="password" class="form-control" value="<?= $row['password'] ?>">
                                                        
                                                                    <?php
                                                                        $role = $conndb->query('SELECT * FROM `tb_user` GROUP BY `role` ');
                                                                        $role->execute();
                                                                    ?>
                                                                    <label>Role Type</label>
                                                                    <select name="role" class="custom-select" required>
                                                                        <option selected><?= $row['role'] ?></option>
                                                                        <?php foreach ($role as $role_row ) : ?>
                                                                            <option value="<?= $role_row['role']; ?>"><?= $role_row['role']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                            </div>
                                                      

                                                       <div class="modal-footer">
                                                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                           <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                       </div>
                                                     </form>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="./user/usersql.php?id=<?= $row['id']?>&action=delete" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                      

                                        </td>
                                    </tr>
                                 <?php endforeach ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>

            <?php if (isset($_SESSION['msg']) == true )  :?>
                
                <script>
                    Swal.fire({
                        title: "Good job!",
                        text: "You clicked the button!",
                        icon: "success"
                    });
                </script>
            
            <?php endif; unset($_SESSION['msg']) ?> 

              </div>
          </div>
      </div>
  </div>
  <?php include('./asset/footer.php') ?>
  </body>

  </html>
  <?php $conndb = null;?>
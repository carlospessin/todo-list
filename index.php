<!DOCTYPE html>

<?php include 'db.php'; 
$sql = "SELECT * FROM tasks";

$rows = $db->query($sql);
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="css/main.css">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">

  <title>Todo List</title>

</head>

<body>
  <div class="container">
    <div class="row">
      <center>
        <label id="switch" class="switch">
          <input type="checkbox" onchange="toggleTheme()" id="slider">
          <span class="slider round">
          </span>
        </label>
        <!-- <button id="switch" onclick="toggleTheme()">Switch</button> -->

        <h1>todo list</h1>
        <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add"></a>
        <a href="" class="btn btn-light"></a>

        <div class="col-md-6 col-md-offset-1">
          <table class="table">

            <tbody>
              <tr>
                <?php while($row = $rows->fetch_assoc()): ?>
                <th scope="row">
                  <p id="id"><?php echo $row['id'];?></p>
                </th>
                <td class="col-md-11">
                  <div class="tasks">
                    <?php if($row['checked']) {?>
                    <input type="checkbox" class="check-box" checked id="<?php echo $row['id'];?>"
                      data-todo-id="<?php echo $row['id'];?>" />
                    <label for="<?php echo $row['id'];?>"><?php echo $row['name'];?></label>
                    <?php } else { ?>
                    <input type="checkbox" class="check-box" id="<?php echo $row['id'];?>"
                      data-todo-id="<?php echo $row['id'];?>" />
                    <label for="<?php echo $row['id'];?>"><?php echo $row['name'];?></label>
                    <?php } ?>
                  </div>
                </td>

                <td>
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#update"
                    dataId="<?php echo $row['id'];?>" dataName="<?php echo $row['name'];?>"></button>
                </td>
                <td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger"></a></td>
              </tr>

              <!-- Modal add -->
              <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-body">
                      <form method="post" action="add.php">
                        <div class="form-group">
                          <input type="text" name="task" class="form-control">
                        </div>
                        <div>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"></button>
                          <button type="submit" name="send" class="btn btn-success"></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal update -->
              <div class="modal fade" id="update" tabindex="-1" aria-labelledby="updateLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-body">
                      <form method="post" action="edit.php">
                        <div class="form-group">

                          <input type="hidden" name="id" class="form-control" id="modalId">
                          <input type="text" name="task" class="form-control" id="modalName">

                        </div>
                        <div>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"></button>
                          <button type="submit" name="send" class="btn btn-success"></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <?php endwhile; ?>

            </tbody>
          </table>
        </div>
      </center>
    </div>
  </div>

  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
    integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
  </script>

  <script type="text/javascript">
  // Adicionar valores ao modal
  var update = document.getElementById('update')
  update.addEventListener('show.bs.modal', function(event) {

    var button = event.relatedTarget

    var dataId = button.getAttribute('dataId')
    var dataName = button.getAttribute('dataName')

    var modalName = update.querySelector('#modalName')
    var modalId = update.querySelector('#modalId')

    modalName.value = dataName
    modalId.value = dataId
  })
  </script>

  <script>
  // theme/color-scheme
  function setTheme(themeName) {
    localStorage.setItem('theme', themeName);
    document.documentElement.className = themeName;
  }

  // toggle light e dark theme
  function toggleTheme() {
    if (localStorage.getItem('theme') === 'theme-dark') {
      setTheme('theme-light');
    } else {
      setTheme('theme-dark');
    }
  }

  (function() {
    if (localStorage.getItem('theme') === 'theme-dark') {
      setTheme('theme-dark');
    } else {
      setTheme('theme-light');
    }
  })();
  </script>

  <script>
  $(".check-box").click(function(e) {
    const id = $(this).attr('data-todo-id');


    $.post('check.php', {
        id: id
      },
      (data) => {

        if (data != 'error') {
          const h2 = $(this).next();
          if (data === '1') {
            h2.removeClass('checked');
          } else {
            h2.addClass('checked');
          }
        }

      }

    );
  });
  </script>


</body>

</html>
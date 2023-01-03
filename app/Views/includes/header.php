<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags --> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/styles.css'); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Online Quiz System</title>
  </head>
  <body>
    <header>
    <div class="containerHead">
        <h1 class="text-center mt-4">Online Quiz System</h1>
        <?php 
          if(isset($_SESSION['user'])){

            echo "<a href='".base_url('logout')."' class='btn btn-outline-primary btnLogout'>Logout</a>";
          
          }
        ?>
      </div>
      <hr>
    </header>
    <?php 
      if(isset($_SESSION['user']) && $_SESSION['user']['category'] === 'teacher'){

        echo "<div class='containerBody' style='margin-left:20px'>
                <nav class='containerButtons border-right'>
                  <li> 
                    <button type='button' data-toggle='modal' data-target='#modalFormAddExam' class='btn btn-outline-primary'>Add exam</button>
                  </li>
                  <li> 
                    <a href='exams' class='btn btn-outline-primary'>Exams</a>
                  </li>
                  <li> 
                    <a href='scores' class='btn btn-outline-primary'>Scores</a>
                  </li>
                </nav>";

      }else echo "<div class='container'>";
    ?>
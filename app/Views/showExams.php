<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <div class='table-responsive'>
                <table id='dataTable' class='table table-bordered nowrap hover' style='width:100%'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Questions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if($exams){
                    foreach($exams as $row){ ?>
                        <tr>
                            <td>
                                <?php echo $row['idexam']; ?>
                            </td>
                            <td>
                                <?php echo $row['title']; ?>
                            </td>
                            <td>
                                <?php 
                                    if($row['status'] === 'ready'){

                                        echo '<a data-toggle="tooltip" data-placement="top" title="Change status">
                                        <button type="button" data-id="'. $row['idexam'] .'" class="btn btn-success btn-sm" id="btnState">Ready</button>
                                        </a>';
                    
                                    }else{
                                        echo '<a data-toggle="tooltip" data-placement="top" title="Change status">
                                        <button type="button" data-id="'. $row['idexam'] .'" class="btn btn-danger btn-sm" id="btnState">Not ready</button>
                                        </a>';
                                    }
                                
                                ?>
                            </td>
                            <td>
                                <a href="questions?idexam= <?php echo $row['idexam']; ?>" class="btn btn-primary">Show questions</a>
                                <a href="newQuestion?idexam= <?php echo $row['idexam']; ?>" class="btn btn-primary">Add question</a>
                            </td>
                        </tr>
                    <?php 
                    }} 
                    ?>
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php 
    include('modalAddExam.php');
?>

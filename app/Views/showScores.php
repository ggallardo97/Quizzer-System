<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <div class='table-responsive'>
                <table id='dataTable' class='table table-bordered nowrap hover' style='width:100%'>
                    <thead>
                        <tr>
                            <th>Exam</th>
                            <th>Name</th>
                            <th>Lastname</th>
                            <th>Score</th>
                            <th>Percentage</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>Ending Time</th>
                            <th>Total Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if($scores){
                    foreach($scores as $row){ ?>
                        <tr>
                            <td>
                                <?php echo $row['title']; ?>
                            </td>
                            <td>
                                <?php echo $row['username']; ?>
                            </td>
                            <td>
                                <?php echo $row['userlastname']; ?>
                            </td>
                            <td>
                                <?php echo $row['score']; ?>/<?php echo $row['totalq']; ?>
                            </td>
                            <td>
                                <?php echo (($row['score']/$row['totalq'])*100).'%'; ?>
                            </td>
                            <td>
                                <?php echo date('d-m-Y', strtotime($row['dateexam'])); ?>
                            </td>
                            <td>
                                <?php echo $row['timeexambegin']; ?>
                            </td>
                            <td>
                                <?php echo $row['timeexamend']; ?>
                            </td>
                            <td>
                                <?php 
                                    $time1 = new DateTime($row['timeexambegin']);
                                    $time2 = new DateTime($row['timeexamend']);
                                    $diff  = $time1->diff($time2);
                                    echo $diff->format('%H hours %i minutes %s seconds'); 
                                ?>
                            </td>
                        </tr>
                    <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php 
    include('modalAddExam.php');
?>
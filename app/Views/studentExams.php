<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <div class='table-responsive'>
                <table id='dataTable' class='table table-bordered nowrap hover' style='width:100%'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if($exams){
                    foreach($exams as $row){ 
                        if($row['status'] !== 'not ready'){ ?>
                        <tr>
                            <td>
                                <?php echo $row['idexam']; ?>
                            </td>
                            <td>
                                <?php echo $row['title']; ?>
                            </td>
                            <td>
                                <a href="exam?idexam=<?php echo $row['idexam']; ?>" class="btn btn-sm btn-primary">Go</a>
                            </td>
                        </tr>
                    <?php } } }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
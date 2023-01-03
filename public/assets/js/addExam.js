$(document).ready(function(){

    $(document).on('click','.submitBtnAddExam', function(){ 

        if($('#titleExam').val() != ''){

            let title = $('#titleExam').val();

            $.ajax({
                url   : 'dashboard/addExam',
                method: 'POST',
                data  :{ 
                    title : title
                }
            }).done(function(msg){
                if(msg === 'OK'){
                    swal({
                        title:  'Exam added successfully!',
                        icon :  'success'
                    }).then(() => {window.location.reload();});
                }else{
                    swal('Something went wrong!', {
                        icon: 'error'
                    });
                }
            });
        }

    });

});
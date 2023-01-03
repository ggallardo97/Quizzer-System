$(document).ready(function(){

    $(document).on('click','.showChoicesButton', function(){ 

        let idquestion = $(this).data('id');
        $('#res').empty();
        $('.lds-facebook').show();

        $.ajax({
            url   : 'dashboard/showChoices',
            method: 'POST',
            data  :{ 
                idquestion : idquestion
            }
            }).done(function(msg){
                
                $('.lds-facebook').hide();
                $('#res').html(msg);
            });

        $(document).on('click','.editChoicesButton', function(){ 

            $('#editChoicesForm').on('submit', function(e){

                e.preventDefault();
           
            });

            let idchoice = $(this).data('idchoice');
        
            if($('#choiceContent' + idchoice).val() != ''){
        
                let content = $('#choiceContent' + idchoice).val();
                
                $.ajax({
                    url   : 'dashboard/editChoice',
                    method: 'POST',
                    data  :{ 
                        idchoice  : idchoice,
                        content   : content
                    }
                }).done(function(msg){
                    
                    if(msg === 'OK'){
                        swal({
                            title: 'Choice modified!',
                            icon : 'success'}).then(() => {window.location.reload();});
                    }else{
                        swal({
                            title: 'Something went wrong!', 
                            icon : 'error'});
                        }
                });
            }
                        
        });
    });

});
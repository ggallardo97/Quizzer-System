$(document).ready(function(){

    $(document).on('click','#btnState', function(){

        let idexam  = $(this).data('id');
        let button  = $(this);

        swal({
            title     : 'Are you sure?',
            text      : 'The state will be changed',
            icon      : 'warning',
            buttons   : ['Cancel', true],
            dangerMode: true,
            }).then((willdelete) => { 

                if(willdelete){

                    $.ajax({

                        type: 'POST',
                        url : 'dashboard/changeExamState',
                        data: {
                            idexam : idexam
                        }
                        }).done(function(res){
                          
                            if(res === 'OK'){

                            swal({
                                title: 'State changed successfully',
                                icon : 'success'
                                }).then(() => { 
                                    
                                    if(button.hasClass('btn-success')){

                                        button.removeClass('btn-success');
                                        button.addClass('btn-danger');
                                        button.html('Not ready');

                                    }else{
                                        button.removeClass('btn-danger');
                                        button.addClass('btn-success');
                                        button.html('Ready');
                                    }
                                 });
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
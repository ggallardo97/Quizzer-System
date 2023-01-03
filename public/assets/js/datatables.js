$(document).ready(function(){

  $('#dataTable').DataTable({
      
        'language': {

            'emptyTable'    : 'No data available in table',
            'info'          : 'Showing _START_ to _END_ of _TOTAL_ entries',
            'infoEmpty'     : 'Showing 0 to 0 of 0 entries',
            'infoFiltered'  : '(filtered from _MAX_ total entries)',
            'infoThousands' : ',',
            'lengthMenu'    : 'Show _MENU_ entries',
            'loadingRecords': 'Loading...',
            'processing'    : 'Processing...',
            'search'        : 'Search:',
            'zeroRecords'   : 'No matching records found',
            'thousands'     : ',',
            'paginate'      : {
                'first'   : 'First',
                'last'    : 'Last',
                'next'    : 'Next',
                'previous': 'Previous'
            },
            'aria'          : {
                'sortAscending'   : ': activate to sort column ascending',
                'sortDescending'  : ': activate to sort column descending'
            }
        }
 });
});
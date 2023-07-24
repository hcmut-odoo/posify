(function () {
  $('.dt-datatable').dataTable({
    'order': [],
    'columnDefs': [{ 'targets': 'no-sort', 'orderable': false }] ,
    'language': {
      'url': '/js/admin/dataTables.vietnamese.json'
    },
  });
} ())

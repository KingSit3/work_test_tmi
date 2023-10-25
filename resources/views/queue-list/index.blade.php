<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Queue View</title>
  
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/Bootstrap-4-4.6.0/js/bootstrap.min.js') }}"></script>
  <link href="{{ asset('vendor/datatables.min.css') }}" rel="stylesheet">
</head>
<body>
  <div style="padding: 50px">
    <table id="queueTable" class="table table-bordered">
      <thead>
        <th>No</th>
        <th>Queue Name</th>
        <th>Queue ID</th>
        <th>Description</th>
        <th>Payload</th>
        <th>Status</th>
        <th>Priority</th>
        <th>Aksi</th>
      </thead>
      <tbody>
      </tbody>
    </table>
    

    </div>
    <script src="{{ asset('vendor/datatables.min.js') }}"></script>

  <script type="text/javascript">
    $(function () {
          var table = $('#queueTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: {url: "{{ route('datatable.queue-list') }}"},
              columns: [
                  {data: 'DT_RowIndex', searchable: false, orderable: false},
                  {data: 'display_name', className: 'dt-control'},
                  {data: 'id',},
                  {data: 'description'},
                  {data: 'payload_url'},
                  {data: 'status.status_name'},
                  {data: 'priority.priority_name'},
                  {data: 'action'},
              ]
          });

          function format(row) {
            return (
              `<table style="width: 100%">
                <thead>
                  <th>Note</th>
                  <th>Status</th>
                  <th>Last Update</th>
                  <th>Created Date</th>
                </thead>
                <tbody>` +
                row.log_queue_details.map(detail => {
                  return `<tr>
                              <td>${detail.note}</td>
                              <td>${detail.status.status_name}</td>
                              <td>${detail.updated_at}</td>
                              <td>${detail.created_at}</td>
                          </tr>`
                })
                + `</tbody>
                </table>`
            );
          }

          // Add event listener for opening and closing details
          table.on('click', 'td.dt-control', function (e) {
              let tr = e.target.closest('tr');
              let row = table.row(tr);
          
              if (row.child.isShown()) {
                  // This row is already open - close it
                  row.child.hide();
              }
              else {
                  // Open this row
                  row.child(format(row.data())).show();
              }
          });


          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });


    });

</script>

</body>
</html>

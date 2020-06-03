@extends('cms.layout')

@section('extraCSS')
  <style media="screen">

    a{
      color: #999;
    }

    a:hover{
      color: white;
    }

    .bg-read{
      background-color: #666;
      color: #999;
    }

    .checkbox-fix{
      height: 1.5em;
      width: 1.5em;
      box-shadow: 0px 0px 5px 0px rgba(0  , 0, 0, 0.4);
      cursor: pointer;
    }

    .bg-awesome{
      background-color: #D55858;
    }

    .bg-awesome:hover{
      background-color: #BC3F3F;
    }

  </style>
@endsection

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Manage Messages</h1>
  </div>

  <p>
    <button type="button" class="btn bg-awesome text-light" id="selectAll"><i class="far fa-square"></i> Select All</button>
    <button type="button" class="btn bg-awesome text-light" id="markRead" data-do="read"><i class="fas fa-envelope-open"></i> Mark as read</button>
    <button type="button" class="btn bg-awesome text-light" id="mardUnread" data-do="unread"><i class="fas fa-envelope"></i> Mark as unread</button>
    <button type="button" class="btn bg-awesome text-light" id="modalCaller" data-toggle="modal" data-target="#exampleModalCenter">
      <i class="fas fa-trash-alt"></i> Delete items
    </button>
  </p>

  {{-- Modal Delete items --}}

  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalCenterTitle">Delete Messages?</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete these messages?
        </div>
        <div class="modal-footer text-center">
          <div class="mx-auto">
            <button type="button" class="btn btn-danger" id="deleteItems" data-do="delete">Delete Messages</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Delete items END--}}

  <div class="table-responsive mt-3">
    <table class="table table-dark table-hover text-center mb-0">
      <thead class="thead-light">
        <tr>
          <th width="5%"></th>
          <th width="1%"></th>
          <th width="1%"></th>
          <th width="12%">Name</th>
          <th width="12%">Email</th>
          <th>Message Title</th>
          <th>Received at</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($messages as $item)

            <tr class="@if ($item->is_read == 1) bg-read @endif">
              <td><input type="checkbox" class="checkbox-fix" data-mid="{{ $item->id }}"></td>
              <td class="align-middle">
                @if ($item->is_read == 0)
                  <span class="badge badge-danger p-1 ml-2">New</span>
                @endif
                </td>
              <td class=""><a href="{{ url('cms/messages/' . $item->id) }}"><i class="far fa-eye ml-2"></i></a></td>
              <td class="align-middle">{{ $item->name }}</td>
              <td class="align-middle">{{ $item->email }}</td>
              <td class="align-middle">{{ $item->m_title }}</td>

              @if (date('Y') == date('Y', strtotime($item->created_at)))

                  @if (date('dmY') == date('dmY', strtotime($item->created_at)))

                    <td class="align-middle">{{ date('H:i', strtotime($item->created_at)) }}</td>
                  @else
                    <td class="align-middle">{{ date('M d', strtotime($item->created_at)) }}</td>
                  @endif

              @else

                <td class="align-middle">{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
              @endif

            </tr>

          @endforeach
      </tbody>
    </table>
  </div>

  <div class="product-pagination">
      {{ $messages->links() }}
  </div>

@endsection

@section('extraJS')

  <script>

      // Makes Delete Items Modal not open when no messages are checked
      $('#modalCaller').on('click',function (e) {
        if ($('input:checked').length == 0) {
          e.stopPropagation();
        }
      });

    // Select All button functionality
    $('button#selectAll').on('click', function(){
      if ($(this).html() == '<i class="far fa-square"></i> Select All') {
        $(this).html('<i class="far fa-check-square"></i> Unselect All');
        $(':checkbox').prop('checked',true);
      } else {
        $(this).html('<i class="far fa-square"></i> Select All');
        $(':checkbox').prop('checked',false);
      }
    });


    // Mark read / unread / Delete Messages functionality
    $('button#markRead , button#mardUnread , button#deleteItems').on('click',function () {

      let items = [];

      $('input:checked').each(function (pos,element) {
        items.push($(this).data('mid'));
      });

      $.ajax({
        url: `${BASE_URL}cms/messages/do-action`,
        type: 'GET',
        dataType: 'html',
        data: {
          mid: items,
          action: $(this).data('do')
        },
        success: function (res) {
          if (res != 0) {
            window.location.reload();
          }
        }
      });
    });

  </script>

@endsection

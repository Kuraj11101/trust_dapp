@extends('clients.layout')
@section('content')
                        <section class="panel">
                            <header class="panel-heading">
                               <b><h3>Transactions History</h3></b>
                            </header>
                            <table class="table display table-hover" id="trans-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Transaktion #ID</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Currency</th>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Transaktion #ID</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Currency</th>
                                        <th>Sender</th>
                                        <th>Receiver</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                @foreach($transaktions as $transaktion)
                                     <tr>
                                        <td>{{$transaktion->trans_id}}</td>
                                        <td>{{$transaktion->created_at}}</td>
                                        <td>{{$transaktion->type}}</td>
                                        <td>{{$transaktion->amount}}</td>
                                        <td>{{$transaktion->currency}}</td>
                                        <td>{{$transaktion->sender}}</td>
                                        <td>{{$transaktion->receiver}}</td>
                                        <td><button class="btn btn-primary">Details</button></div></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>

                        <style media="screen" type="text/css">
                        tfoot input {
                            width: 100%;
                            padding: 3px;
                            box-sizing: border-box;
                        }
                        </style>

@endsection
@section('scripts')

<script type="text/javascript">
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#trans-table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#trans-table').DataTable();

    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>
@endsection
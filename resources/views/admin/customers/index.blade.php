@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                        @if($customers->isNotEmpty())
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Celular</th>
                                    <th>Cadastrado em:</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{$customer->name}}</a></td>
                                            <td>{{$customer->email}}</td>
                                            <td>{{$customer->cellphone}}</td>
                                            <td>{{date('d/m/Y H:i:s', strtotime($customer->created_at))}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Nenhum registro encontrado</p>
                        @endif

                    {{ $customers->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('javascript')

@stop

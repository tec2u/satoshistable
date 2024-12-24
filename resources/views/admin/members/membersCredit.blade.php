@extends('adminlte::page')

@section('title', 'Members Credit')

@section('content_header')
<div class="alignHeader">
    <h4>Members credit list</h4>
</div>
<i class="fa fa-home ml-3"></i> - Members
@stop

@section('content')

<div class="card">
    <div class="card-header">

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div style="display: flex; justify-content:space-between">
                    <div class="card-tools" style="width: 100%;">
                        <div class="input-group input-group-sm my-1" style="width: 100%; float: left;">
                            <div style="width: 100%; display: inline-block; margin-bottom: 10px;"><span>Pesquisar por login/nome</span></div>
                            <form method="GET" class="d-flex" action="{{ route('admin.credit.credit_add') }}">
                                @csrf
                                <input type="text" name="login" class="form-control mr-2" placeholder="Digite o Login" value="{{ isset($login) ? $login : '' }}">
                                <input type="submit" value="@lang('admin.btn.search')" class="btn btn-dark">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body table-responsive">
    <span class="counter float-right"></span>
    <table class="table table-hover table-bordered results">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Login</th>
                <th>Credit</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($membersWithCredit as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>
                    <div style="font-size: 16px;">{{$member->name}}</div>
                </td>
                <td>
                    <div style="font-size: 16px;">{{$member->login}}</div>
                </td>
                <td>
                    <div class="d-flex">
                        <input type="number" name="credit" id="credit_{{ $member->id }}" class="form-control" value="{{ isset($member->bancoCredit) && count($member->bancoCredit) > 0 ? $member->bancoCredit[0]->price : 0 }}">
                        <button class="btn btn-primary ml-2" type="button" onclick="addCreditToMember('credit_{{ $member->id }}', '{{ $member->id }}')">ADD</button>
                    </div>
                </td>
                <td>{{ isset($member->bancoCredit) && count($member->bancoCredit) > 0 ? date('H:i d/m/Y ', strtotime($member->bancoCredit[0]->updated_at)) : '' }}</td>
            </tr>
            @empty
            <p class="m-4 fst-italic">Not found</p>
            @endforelse
        </tbody>

    </table>
</div>
</div>
<div class="card-footer clearfix py-3">
    {{ $membersWithCredit->links() }}
</div>

@stop
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function addCreditToMember(idCreditInput, userID) {
        const formData = {
            newPrice: $(`#${idCreditInput}`).val(),
            userID: userID
        }

        axios.post(`/api/add-credit`, formData).then((response) => {
            alert('Credit added successfully')
        })
    }
</script>
@section('css')
<link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop

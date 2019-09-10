@extends('oxygen::layouts.master-dashboard')

@section('breadcrumbs')
    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        [$pageTitle, null, true]
    ]) }}
@stop

@section('pageMainActions')
    @include('oxygen::dashboard.partials.searchField')
@stop

@section('content')
    @include('oxygen::dashboard.partials.table-allItems', [
        'tableHeader' => [
            'Device ID', 'Device Type', 'Push Token', 'Latest IP', 'User', 'Actions'
        ]
    ])

    @foreach ($allItems as $item)
        <tr>
            <td>
                <a href="{{ entity_resource_path() . '/' . $item->id }}">{{ $item->device_id }}</a>
            </td>
            <td>{{ $item->device_type }}</td>
            <td style="word-break: break-word">{{ $item->device_push_token }}</td>
            <td>{{ $item->latest_ip_address }}</td>
            <td>
                @if ($item->user)
                    {{ $item->user->full_name }}
                @endif
            </td>
            <td>
                <form action="{{ entity_resource_path() . '/' . $item->id }}" method="POST" class="form form-inline js-confirm">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger"><em class="fa fa-times"></em> Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
@stop

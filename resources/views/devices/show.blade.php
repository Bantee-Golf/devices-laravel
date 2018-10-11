@extends('oxygen::layouts.master-dashboard')

@section('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Devices', route('manage.devices.index')],
        [$pageTitle, null, true]
    ]) }}

    <table class="table table-hover">
        <tbody>
            @foreach ($entity->getShowable() as $field)
                <tr>
                    <td>{{ ucwords(reverse_snake_case($field)) }}</td>
                    <td width="75%">{{ $entity->$field }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection




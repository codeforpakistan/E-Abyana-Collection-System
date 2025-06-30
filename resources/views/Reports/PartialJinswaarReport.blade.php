@if(count($grouped))
<table class="table table-bordered">
    <thead class="table-primary">
        <tr>
            <th>S.#</th>
            <th>Channel Name</th>
            <th>Outlet Name</th>
            <th>Season</th>
            <th>Crop Name</th>
            <th>Cultivated Area (Acres)</th>
            <th>Total Abyana (Rs)</th>
        </tr>
    </thead>
@php $sn = 1; @endphp
@foreach($grouped as $division => $records)
    @foreach($records as $record)
    <tr>
        <td>{{ $sn++ }}</td>
        <td>{{ $record->channel_name }}</td>
        <td>{{ $record->outlet_name }}</td>
        <td>{{ ucfirst($record->season) }}</td>
        <td>{{ $record->final_crop }}</td>
        <td>{{ number_format($record->total_acres, 1) }}&nbsp;Acres</td>
        <td>RS:&nbsp;{{ number_format($record->total_abyana, 1) }}</td>
    </tr>
    @endforeach
@endforeach
</tbody>
</table>
@else
<p class="text-danger">No data available for selected filters.</p>
@endif
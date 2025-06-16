@if(count($grouped))
<table class="table table-bordered">
    <thead class="table-primary">
        <tr>
            <th>S.#</th>
            <th>Division Name</th>
            <th>Assessment of Kharif {{ request('session_year') }} (Acres)</th>
            <th>Assessment of Rabi {{ request('session_year') }} (Acres)</th>
            <th>Total Assessment {{ request('session_year') }} (Acres)</th>
            <th>Abyana Demand of Kharif {{ request('session_year') }} (Rs)</th>
            <th>Abyana Demand of Rabi {{ request('session_year') }} (Rs)</th>
            <th>Total Abyana {{ request('session_year') }} (Rs)</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach($grouped as $division_id => $rows)
            @php
                $division_name = $rows->first()->divsion_name;
                $kharif_area = $rows->firstWhere('crop_id', 2)?->total_acres ?? 0;
                $rabi_area   = $rows->firstWhere('crop_id', 1)?->total_acres ?? 0;
                $total_area  = $kharif_area + $rabi_area;

                $kharif_amount = $rows->firstWhere('crop_id', 2)?->total_abyana ?? 0;
                $rabi_amount   = $rows->firstWhere('crop_id', 1)?->total_abyana ?? 0;
                $total_amount  = $kharif_amount + $rabi_amount;
            @endphp
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $division_name }}</td>
                <td>{{ number_format($kharif_area, 2) }}</td>
                <td>{{ number_format($rabi_area, 2) }}</td>
                <td><strong>{{ number_format($total_area, 2) }}</strong></td>
                <td>{{ number_format($kharif_amount, 2) }}</td>
                <td>{{ number_format($rabi_amount, 2) }}</td>
                <td><strong>{{ number_format($total_amount, 2) }}</strong></td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<p class="text-danger">No data available for selected filters.</p>
@endif
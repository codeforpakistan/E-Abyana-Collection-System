@if(!empty($records) && count($records))
    <table class="table table-bordered table-hover table-sm">
        <thead class="table-primary text-center">
            <tr>
                <th>#</th>
                <th>Channel Name</th>
                <th>Crop Name</th>
                <th>Base Season Area (Acre)</th>
                <th>Compared Season Area (Acre)</th>
                <th>Difference (%)</th>
                <th>Base Abiyana</th>
                <th>Compared Abiyana</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $index => $row)
                @php
                    $area1 = $row['total_acres_base'];
                    $area2 = $row['total_acres_compare'];
                    $abyana1 = $row['total_abyana_base'];
                    $abyana2 = $row['total_abyana_compare'];

                    $area_diff_percent = ($area1 > 0) ? round((($area2 - $area1) / $area1) * 100, 2) : 0;
                    $remark = $area_diff_percent > 0 ? 'Increase' : ($area_diff_percent < 0 ? 'Decrease' : 'No Change');
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $row['channel_name'] }}</td>
                    <td>{{ $row['crop_name'] }}</td>
                    <td class="text-end">{{ number_format($area1, 2) }}</td>
                    <td class="text-end">{{ number_format($area2, 2) }}</td>
                    <td class="text-center">
                        @if($area_diff_percent > 0)
                            <span class="text-success"><strong>+{{ $area_diff_percent }}%</strong></span>
                        @elseif($area_diff_percent < 0)
                            <span class="text-danger"><strong>{{ $area_diff_percent }}%</strong></span>
                        @else
                            <span class="text-secondary">0%</span>
                        @endif
                    </td>
                    <td class="text-end">{{ number_format($abyana1, 0) }}</td>
                    <td class="text-end">{{ number_format($abyana2, 0) }}</td>
                    <td>{{ $remark }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-danger">No data available for selected filters.</p>
@endif

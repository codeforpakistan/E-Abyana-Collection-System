@if(count($grouped))
    <h4 class="text-center mb-3">
        <span style="font-size:16px;"><strong>Halqa Wise (Pending & Entered Arrears) Irrigators List Report -</strong></span> 
        <span style="font-size:18px;"><strong>{{ $division }}</strong></span>
    </h4>
    <h6>The table below shows irrigators whose arrears are entered and those still pending.</h6>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th class="text-center">S.NO</th>
                <th class="text-center">User (Patwari)</th>
                <th class="text-center">Halqa</th>
                <th class="text-center">Village</th>
                <th class="text-center">Arrears Entered</th>
                <th class="text-center">Pending Arrears</th>
                <th class="text-center">Total Irrigators</th>
            </tr>
        </thead>
        <tbody>
            @php $serial = 1; @endphp

            @foreach($grouped as $userName => $halqas)
                @php 
                    $userRowspan = $halqas->flatten(1)->count(); 
                    $firstUserRow = true;
                @endphp

                @foreach($halqas as $halqaName => $villages)
                    @php 
                        $halqaRowspan = count($villages); 
                        $firstHalqaRow = true;
                    @endphp

                    @foreach($villages as $village)
                        <tr>
                            @if($firstUserRow)
                                <td class="text-center align-middle" rowspan="{{ $userRowspan }}">{{ $serial }}</td>
                                <td class="text-center align-middle" rowspan="{{ $userRowspan }}"><strong>{{ $userName }}</strong></td>
                                @php $firstUserRow = false; $serial++; @endphp
                            @endif

                            @if($firstHalqaRow)
                                <td class="text-center align-middle" rowspan="{{ $halqaRowspan }}">{{ $halqaName }}</td>
                                @php $firstHalqaRow = false; @endphp
                            @endif

                            <td class="text-center">{{ $village->village_name ?? '-' }}</td>
                            <td class="text-center">{{ $village->arrears_entered }}</td>
                            <td class="text-center">{{ $village->arrears_pending }}</td>
                            <td class="text-center">{{ $village->total_irrigators }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach

            {{-- Grand Total --}}
            <tr class="table-secondary">
                <td colspan="4" class="text-end"><strong>Grand Total</strong></td>
                <td class="text-center"><strong>{{ $grouped->flatten(2)->sum('arrears_entered') }}</strong></td>
                <td class="text-center"><strong>{{ $grouped->flatten(2)->sum('arrears_pending') }}</strong></td>
                <td class="text-center"><strong>{{ $grouped->flatten(2)->sum('total_irrigators') }}</strong></td>
            </tr>
        </tbody>
    </table>
@else
    <p class="text-danger">No data available for selected filters.</p>
@endif

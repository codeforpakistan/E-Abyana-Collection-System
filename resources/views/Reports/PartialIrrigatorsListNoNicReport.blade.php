@if(count($grouped))
    <h4 class="text-center mb-3">
        <span style="font-size:16px;"><strong>Halqa Wise (No CNIC) Irrigators List Report -</strong></span> 
        <span style="font-size:18px;"><strong>{{ $division }}</strong></span>
    </h4>
     <h6>The table below shows the list of irrigators who either have no CNIC or have provided a CNIC in an invalid format.</h6>
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th class="text-center">S.NO</th>
                <th class="text-center">User (Patwari)</th>
                <th class="text-center">Halqa</th>
                <th class="text-center">Village</th>
                <th class="text-center">Irrigators with No CNIC</th>
            </tr>
        </thead>
        <tbody>
            @php $serial = 1; @endphp {{-- initialize counter --}}

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
                            {{-- S.NO + User column (merged per user) --}}
                            @if($firstUserRow)
                                <td class="text-center align-middle" rowspan="{{ $userRowspan }}">
                                    {{ $serial }}
                                </td>
                                <td class="text-center align-middle" rowspan="{{ $userRowspan }}">
                                    <strong>{{ $userName }}</strong>
                                </td>
                                @php $firstUserRow = false; $serial++; @endphp
                            @endif

                            {{-- Halqa column (merged per halqa) --}}
                            @if($firstHalqaRow)
                                <td class="text-center align-middle" rowspan="{{ $halqaRowspan }}">
                                    {{ $halqaName }}
                                </td>
                                @php $firstHalqaRow = false; @endphp
                            @endif

                            {{-- Village + irrigators --}}
                            <td class="text-center">{{ $village->village_name ?? '-' }}</td>
                            <td class="text-center">{{ $village->irrigators_count }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach

            {{-- Grand Total Row --}}
            <tr class="table-secondary">
                <td colspan="4" class="text-end"><strong>Total Irrigators</strong></td>
                <td class="text-center"><strong>{{ $grouped->flatten(2)->sum('irrigators_count') }}</strong></td>
            </tr>
        </tbody>
    </table>
@else
    <p class="text-danger">No data available for selected filters.</p>
@endif
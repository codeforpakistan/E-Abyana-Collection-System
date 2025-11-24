<h4 class="text-center mb-3">
    <span style="font-size:16px;"><strong>Area CCA Report Division Wise - </strong></span> 
    <span style="font-size:18px;"><strong>{{ $division }}</strong></span>
</h4>

{{-- 🔹 Existing Division-wise Table (unchanged) --}}
<table class="table table-bordered table-striped">
    <thead>
        <tr class="text-center">
            <th style="width: 50%;">Total Area CCA ({{ $division }})</th>
            <th style="width: 50%;">Assessment CCA ({{ $division }})</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td>{{ $total_cca_sum }} Acres</td>
            <td>{{ $assessment_cca_sum }} Acres</td>
        </tr>
    </tbody>
</table>

{{-- 🔹 New Canal-wise Table --}}
@if(!empty($canal_wise_data))
    <h5 class="mt-4 mb-2 text-center"><strong>Canal Wise Area CCA Report</strong></h5>

    <table class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th>Canal Name</th>
                <th>Total Area CCA (Acres)</th>
                <th>Assessment CCA (Acres)</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $total_area_sum = 0;
                $total_assessment_sum = 0;
            @endphp
            @foreach($canal_wise_data as $row)
                @php 
                    $total_area_sum += $row['total_area_cca'];
                    $total_assessment_sum += $row['assessment_cca'];
                @endphp
                <tr class="text-center">
                    <td>{{ $row['canal_name'] ?? 'N/A' }}</td>
                    <td>{{ number_format($row['total_area_cca'], 2) }}</td>
                    <td>{{ number_format($row['assessment_cca'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="fw-bold text-center">
                <td class="text-end"><strong>Total</strong></td>
                <td><strong>{{ number_format($total_area_sum, 2) }}</strong></td>
                <td><strong>{{ number_format($total_assessment_sum, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
@endif

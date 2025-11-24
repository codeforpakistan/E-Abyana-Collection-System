<h4 class="text-center mb-3">
    <span style="font-size:16px;"><strong>Patwari Halqa Wise CCA Report - </strong></span> 
    <span style="font-size:18px;"><strong>{{ $division }}</strong></span>
</h4>

<div class="mb-3 text-center">
    <strong>Total Division CCA (from Outlets):</strong> {{ number_format($total_cca_sum, 2) }} Acres
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">S.No</th>
            <th>Patwari Name</th>
            {{-- 🔹 NEW COLUMN --}}
            <th class="text-center">Halqa Total CCA (Acres)</th>
            <th class="text-center">Assessment CCA (Acres)</th>
        </tr>
    </thead>
    <tbody>
        @php 
            $total_assessment = 0; 
            $total_halqa_cca = 0;
        @endphp
        @foreach($assessment_cca_sum as $index => $item)
            @php 
                $total_assessment += $item->assessment_cca; 
                $halqa_cca = $halqa_cca_data[$item->user_id] ?? 0;
                $total_halqa_cca += $halqa_cca;
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->user_name }}</td>
                {{-- 🔹 NEW COLUMN VALUE --}}
                <td class="text-center">{{ number_format($halqa_cca, 2) }}</td>
                <td class="text-center">{{ number_format($item->assessment_cca, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="2" class="text-end">Total</th>
            {{-- 🔹 NEW COLUMN TOTAL --}}
            <th class="text-center">{{ number_format($total_halqa_cca, 2) }}</th>
            <th class="text-center">{{ number_format($total_assessment, 2) }}</th>
        </tr>
    </tfoot>
</table>

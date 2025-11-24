<h4 class="text-center mb-3">
    <span style="font-size:16px;"><strong>Area CCA Report Outlet Wise - </strong></span> 
    <span style="font-size:18px;"><strong>{{$outlet}} - {{$canal}} - {{ $division }}</strong></span>
</h4>

<table class="table table-bordered table-striped">
    <thead>
        <tr class="text-center">
            <th style="width: 50%;">Total Area CCA</th>
            <th style="width: 50%;">Assessment CCA</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td>{{ $total_cca_sum }} Acres</td>
            <td>{{$assessment_cca_sum}} Acres</td>
        </tr>
    </tbody>
</table>

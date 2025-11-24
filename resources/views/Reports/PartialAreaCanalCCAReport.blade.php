<h4 class="text-center mb-3">
    <span style="font-size:16px;"><strong>Area CCA Report Canal Wise - </strong></span> 
    <span style="font-size:18px;"><strong>{{ $canal }} - {{ $division }}</strong></span>
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
            <td>{{ $assessment_cca_sum }} Acres</td>
        </tr>
    </tbody>
</table>

<br><br>

{{-- ===================== MINOR GROUPS ===================== --}}
@foreach($outlets as $groupKey => $group)
@if(str_starts_with($groupKey, 'minor_'))

@php
    $id = str_replace('minor_', '', $groupKey);
    $name = $minorNames[$id] ?? 'Unknown Minor';

    $totalCCA = $group->sum('total_no_cca');
    $totalAssessment = $group->sum(fn($x) => $assessmentPerOutlet[$x->id] ?? 0);
@endphp

<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="3">Distributary: <u>{{ $name }}</u></th>
        </tr>
        <tr>
            <th>Outlet Name</th>
            <th>Total CCA</th>
            <th>Assessment CCA</th>
        </tr>
    </thead>

    <tbody>
        @foreach($group as $row)
        <tr>
            <td>{{ $row->outlet_name }}</td>
            <td>{{ $row->total_no_cca }}</td>
            <td>{{ number_format($assessmentPerOutlet[$row->id] ?? 0, 2) }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr style="font-weight:bold; background:#f4f4f4;">
            <td class="text-end">Total</td>
            <td>{{ $totalCCA }}</td>
            <td>{{ number_format($totalAssessment, 2) }}</td>
        </tr>
    </tfoot>
</table>

@endif
@endforeach



{{-- ===================== DISTRIBUTARY GROUPS ===================== --}}
@foreach($outlets as $groupKey => $group)
@if(str_starts_with($groupKey, 'distrib_'))

@php
    $id = str_replace('distrib_', '', $groupKey);
    $name = $distribNames[$id] ?? 'Unknown Distributary';

    $totalCCA = $group->sum('total_no_cca');
    $totalAssessment = $group->sum(fn($x) => $assessmentPerOutlet[$x->id] ?? 0);
@endphp

<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="3">Minor: <u>{{ $name }}</u></th>
        </tr>
        <tr>
            <th>Outlet Name</th>
            <th>Total CCA</th>
            <th>Assessment CCA</th>
        </tr>
    </thead>

    <tbody>
        @foreach($group as $row)
        <tr>
            <td>{{ $row->outlet_name }}</td>
            <td>{{ $row->total_no_cca }}</td>
            <td>{{ number_format($assessmentPerOutlet[$row->id] ?? 0, 2) }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr style="font-weight:bold; background:#f4f4f4;">
            <td class="text-end">Total</td>
            <td>{{ $totalCCA }}</td>
            <td>{{ number_format($totalAssessment, 2) }}</td>
        </tr>
    </tfoot>
</table>

@endif
@endforeach



{{-- ===================== BRANCH GROUPS ===================== --}}
@foreach($outlets as $groupKey => $group)
@if(str_starts_with($groupKey, 'branch_'))

@php
    $id = str_replace('branch_', '', $groupKey);
    $name = $branchNames[$id] ?? 'Unknown Branch';

    $totalCCA = $group->sum('total_no_cca');
    $totalAssessment = $group->sum(fn($x) => $assessmentPerOutlet[$x->id] ?? 0);
@endphp

<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="3">Branch: <u>{{ $name }}</u></th>
        </tr>
        <tr>
            <th>Outlet Name</th>
            <th>Total CCA</th>
            <th>Assessment CCA</th>
        </tr>
    </thead>

    <tbody>
        @foreach($group as $row)
        <tr>
            <td>{{ $row->outlet_name }}</td>
            <td>{{ $row->total_no_cca }}</td>
            <td>{{ number_format($assessmentPerOutlet[$row->id] ?? 0, 2) }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr style="font-weight:bold; background:#f4f4f4;">
            <td class="text-end">Total</td>
            <td>{{ $totalCCA }}</td>
            <td>{{ number_format($totalAssessment, 2) }}</td>
        </tr>
    </tfoot>
</table>

@endif
@endforeach

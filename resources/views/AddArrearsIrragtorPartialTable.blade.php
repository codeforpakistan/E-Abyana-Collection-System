<table id="example123" style="font-size:13px;" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Irrigator Name</th>
                                                        <th>Father Name</th>
                                                        <th>Khata #</th>
                                                        <th>Village</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            <tbody>
@foreach ($Irrigators as $Irrigator)
<tr>
    <td>{{ $Irrigator->id }}</td>
    <td>{{ $Irrigator->irrigator_name }}</td>
     <td>{{ $Irrigator->irrigator_f_name }}</td>
    <td>{{ $Irrigator->irrigator_khata_number }}</td>
    <td>{{ $Irrigator->village_name }}</td>
    <td class="align-middle text-center">
    <button type="button" class="btn btn-sm btn-primary open-arrear-modal"
    data-toggle="modal" data-target="#exampleModal"
    data-irrigator-id="{{ $Irrigator->id }}"
    data-div-id="{{ $Irrigator->div_id }}">
    + Add Arrear
    </button>
    </td>
</tr>
@endforeach
</tbody>
</table>   


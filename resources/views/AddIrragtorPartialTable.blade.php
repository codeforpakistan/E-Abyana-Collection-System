<table id="example123" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <!--<th><input type="checkbox" id="select-all"></th> -->
                                                        <th>#</th>
                                                        <th>Irrigator Name</th>
                                                        <th>Khata #</th>
                                                        <th>Village</th>
                                                        {{-- <th>Halqa /حلقہ</th> --}}
                                                        {{-- <th>CNIC</th> --}}
                                                        {{-- <th>Mobile No</th> --}}
                                                        
                                                        <!-- <th>Tehsil Name</th>
                                                        <th>District Name</th>
                                                        <th>Divsion</th> -->

                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            <tbody>
@foreach ($Irrigators as $Irrigator)
<tr>
    <td>{{ $Irrigator->id }}</td>
    <td>{{ $Irrigator->irrigator_name }}</td>
    <td>{{ $Irrigator->irrigator_khata_number }}</td>
    <td>{{ $Irrigator->village_name }}</td>
    <td class="align-middle text-center">
        <a href="{{ route('LandRecord.ListLandSurvey', ['id' => $Irrigator->id, 'abs' => $Irrigator->irrigator_khata_number, 'village_id' => $Irrigator->village_id, 'canal_id' => $Irrigator->canal_id,'div_id' => $Irrigator->div_id]) }}">
            <button class="btn btn-sm btn-primary" type="button">
                <span><i class="fa fa-plus"></i></span> Land Survey <span style="font-family: 'Noto Nastaliq Urdu', serif;">(خسرہ گرداوری)</span>
            </button>
        </a>

        <form action="{{ route('irrigators.destroy', $Irrigator->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this irrigator?');"
              style="display: inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-primary" type="submit">
                <i class="fa fa-trash"></i> Delete
            </button>
        </form>

        <a href="{{ route('edit.irrigator', $Irrigator->id) }}" class="btn btn-sm btn-primary">
            <i class="fa fa-edit"></i> Edit</a> 
    </td>
</tr>
@endforeach
</tbody>
                                            </table>   

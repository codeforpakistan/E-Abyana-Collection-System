<table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
    <thead>
        <tr>
            <th>#</th>
            <th>Irrigator Name</th>
            <th>CNIC</th>
            <th>Khata No</th>
            <th>Mobile No</th>
            <th>Halqa /حلقہ</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Irrigators as $Irrigator)
            <tr>
                <!-- <td><input type="checkbox" name="ids[]" value=""></td> -->
                <td>{{ $Irrigator->id }}</td>
                <td>{{ $Irrigator->irrigator_name }}</td>
                <td>{{ $Irrigator->cnic}}</td>
                <td>{{ $Irrigator->irrigator_khata_number }}</td>
                <td>{{ $Irrigator->irrigator_mobile_number }}</td>
                {{-- <td>{{ $Irrigator->village_name }}</td> --}}
                <td>{{ $Irrigator->halqa_name }}</td>
                <!--  <td>{{ $Irrigator->tehsil_name }}</td>
            <td>{{ $Irrigator->district_name }}</td>
            
            <td>{{ $Irrigator->divsion_name }}</td> -->

            <td class="align-middle text-center">
                <a href="{{ route('LandRecord.ListLandSurvey', ['id' => $Irrigator->id, 'abs' => $Irrigator->irrigator_khata_number, 'village_id' => $Irrigator->village_id, 'canal_id' => $Irrigator->canal_id]) }}">
                    <button class="btn btn-sm btn-primary" type="button">
                        <span><i class="fa fa-plus"></i></span> Add Survey
                    </button>
                </a>
                
                        <form
                            action="{{ route('irrigators.destroy', $Irrigator->id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this irrigator?');"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-primary"
                                type="submit">
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

@if ($Irrigators->hasPages())
    <div class="pagination-wrapper">
        {{ $Irrigators->links() }}
    </div>
@endif

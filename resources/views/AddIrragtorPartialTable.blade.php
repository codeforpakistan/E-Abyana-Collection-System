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
        <tr @if($Irrigator->survey_count > 0) style="background-color: #fff3cd;" @endif>
            <td>{{ $Irrigator->id }}</td>
            <td>
                {{ $Irrigator->irrigator_name }}&nbsp;&nbsp;
                @if($Irrigator->survey_count > 0)
                    <span class="badge badge-warning">{{ $Irrigator->survey_count }}</span>
                @endif
            </td>
            <td>{{ $Irrigator->irrigator_f_name }}</td>
            <td>{{ $Irrigator->irrigator_khata_number }}</td>
            <td>{{ $Irrigator->village_name }}</td>
            <td class="align-middle text-center">
                <a href="{{ route('LandRecord.ListLandSurvey', [
                    'id' => $Irrigator->id, 
                    'abs' => $Irrigator->irrigator_khata_number, 
                    'village_id' => $Irrigator->village_id, 
                    'canal_id' => $Irrigator->canal_id,
                    'div_id' => $Irrigator->div_id
                ]) }}">
                    <button class="btn btn-sm btn-primary" type="button">
                        <span><i class="fa fa-plus"></i></span> Land Survey 
                        <span style="font-family: 'Noto Nastaliq Urdu', serif;">(خسرہ گرداوری)</span>
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
                    <i class="fa fa-edit"></i> Edit
                </a> 
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

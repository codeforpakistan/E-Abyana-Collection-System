@foreach($divsions as $divsion)
<tr>
   <!-- <td>{{ $divsion->id }}</td> -->
    <td>{{ $loop->iteration }}</td>
    <td>{{ $divsion->divsion_name }}</td>
    <td>
        <a href="{{ route('edit_division', $divsion->id) }}">
            <button class="btn btn-sm btn-primary" type="submit">
                <i class="fa fa-pencil"></i> Edit
            </button>
        </a>
        <form action="{{ route('AddDivsion.destroy', $divsion->id) }}" method="POST"
            onsubmit="return confirm('Are you sure?');" style="display: inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-primary" type="submit">
                <i class="fa fa-trash"></i> Delete
            </button>
        </form>
    </td>
</tr>
@endforeach
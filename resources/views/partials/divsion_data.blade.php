@foreach($divsions as $divsion)
<tr>
    <td>{{ $divsion->id }}</td>
    <td>{{ $divsion->divsion_name }}</td>
    <td>
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
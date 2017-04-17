<form action="{{ route('admin:gaming_event_test') }}" method="post">
    <select class="form-control" name="action">
        <option>create</option>
        <option>update</option>
        <option>delete</option>
        <option>attach</option>
        <option>detach</option>
        <option>pivotUpdate</option>
    </select>
    <button class="btn btn-success">Submit</button>
</form>

<table class="table table-condensed">
    @foreach(\Jiko\Models\Activity::all() as $activity)
        <tr>
            <td>{{ $activity->category }}</td>
            <td>{{ $activity->action  }}</td>
            <td>{{ $activity->label }}</td>
            <td>{{ $activity->value }}</td>
        </tr>
    @endforeach
</table>
@foreach($likars as $likar)
    <option value="{{ $likar->id }}">{{ $likar->user->name }}</option>
@endforeach

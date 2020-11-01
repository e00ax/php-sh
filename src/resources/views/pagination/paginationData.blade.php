<table class="hover foundation">
    <thead>
        <tr>
            <th width="200">ID</th>
            <th width="200">Temperature</th>
            <th width="150">Humidity</th>
            <th width="150">Timestamp</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->temp }}</td>
                <td>{{ $row->hum }}</td>
                <td>{{ $row->timestamp }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="rowbox">
    <div style="width: 75%;">{{ $data->links() }}</div>

    <!-- Items per page -->
    <div style="width:15%;padding: 0 25px 0 0;">
        <label class="text-right">
            <select id="itemsPerPage">
                @foreach (config('sh.pagination.optionsTable') as $key => $val)
                    @php
                        $val == $itemsPerPage
                            ? $sel="selected" 
                            : $sel="" ;
                    @endphp
                    <option value="{{ $val }}" {{ $sel }}>{{ $val }}</option>
                @endforeach
            </select>
        </label>

        <input type="hidden" id="itemsPerPageHidden" name="itemsPerPageHidden" value="{{ $itemsPerPage }}">
    </div>

    <!-- Display data as chart -->
    <div style="width:10%;padding: 0 25px 10px 10px;text-align: right;">
        <a href="{{ url('canvasJs') }}"><img id="ChartImg" src="img/chartBig.png" style="border: 0px; width: 40px;"></a>
    </div>
</div>

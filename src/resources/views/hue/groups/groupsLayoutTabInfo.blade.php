<div>
    <table class="hover foundation">
        <thead style="background: #e1e1e1;">
            <tr>
                <th width="50%">Option</th>
                <th width="50%">Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ID</td>
                <td>{{ $i }}</td>
            </tr>

            <!-- Lights -->
            <tr>
                <td>Lights</td>
                <td>
                    @if (empty($groups[$i]['lights']))
                        <span>NA</span>
                    @else
                        @foreach ($groups[$i]['lights'] as $val)
                            <a href="{{ url('/hue/lights#deeplink'.$val) }}">{{ $val }}</a><br>
                        @endforeach
                    @endif
                </td>
            </tr>

            <!-- Sensors -->
            <tr>
                <td>Sensors</td>
                <td>
                    @if (empty($groups[$i]['sensors']))
                        <span>NA</span>
                    @else
                        @foreach ($groups[$i]['sensors'] as $val)
                            <a href="#">{{ $val }}</a><br>
                        @endforeach
                    @endif
                </td>
            </tr>

            <!-- Type -->
            <tr>
                <td>Type</td>
                <td>{{ $groups[$i]['type'] }}</td>
            </tr>

            <!-- Action -->
            <tr>
                <td>Action</td>
                <td>
                    @if (empty($groups[$i]['action']))
                        <span>NA</span>
                    @else
                        @foreach ($groups[$i]['action'] as $key => $val)
                            @if ($key !== 'xy')
                                <span>{{ $key }}:{{ $val }}</span><br>
                            @endif
                        @endforeach
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>

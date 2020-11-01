<div class="overflow">
    <table class="hover foundation">
        <thead style="background: #e1e1e1;">
            <tr>
                <th width="30%">Option</th>
                <th width="70%">Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ID</td>
                <td>{{ $i }}</td>
            </tr>
            @php
                echo HueHelper::recurseInfo($rules[$i]);
            @endphp
        </tbody>
    </table>
</div>

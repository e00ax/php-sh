<div class="overflow">
    <table class="hover foundation">
        <thead style="background: #e1e1e1;">
            <tr>
                <th>Option</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ID</td>
                <td>{{ $i }}</td>
            </tr>
            @php
                echo HueHelper::recurseInfo($lights[$i]);
            @endphp
        </tbody>
    </table>
</div>

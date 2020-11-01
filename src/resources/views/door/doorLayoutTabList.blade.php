@php
//echo "<pre>";
//print_r($nukiList);
//echo "</pre>";
@endphp

<div class="overflow">
    <table class="hover foundation">
        <thead style="background: #e1e1e1;">
            <tr>
                <th width="50%">Option</th>
                <th width="50%">Value</th>
            </tr>
        </thead>
        <tbody>
            @php
                echo HueHelper::recurseInfo($nukiList);
            @endphp
        </tbody>
    </table>
</div>

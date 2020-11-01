@php
    //echo "<pre>";
    //print_r($scenes);
    //echo "</pre>";
@endphp

<form action="{{ route('hueGroupsScenes.post') }}" method="post" id="hueGroupsScenes{{ $i }}" name="hueGroupsScenes">
    <div>
        <table class="hover foundation">
            <tbody>
                <!-- Scenes -->
                <tr>
                    <td>Scenes</td>
                    <td style="padding: 20px 10px 0 25px;">
                        <div class="rowbox">
                            <select class="foundation" id="scenes{{ $i }}" name="scenes">
                                @foreach (config('scenes') as $key => $val)
                                    <option value="{{ $key }}">{{ $key }}</option>
                                @endforeach
                            </select>

                            <!-- Hidden stuff 
                            <input type="text" id="id{{ $i }}" name="id" value="{{ $i }}">-->
                            <input type="hidden" id="id{{ $i }}" name="id" value="{{ $i }}">

                            <!-- Submit -->
                            <div>
                                <div style="width:50%;text-align:left;">
                                    <button type="submit" class="button" id="hueGroupsScenesSubmit{{ $i }}" name="hueGroupsScenesSubmit" style="width: 100px;height: 39px;">{{ trans('messages.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>

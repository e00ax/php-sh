<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">{{ trans('messages.paginationHeader') }}</div>
        <div style="text-align: right;padding-right: 10px;">
            <a href="{{ route('home') }}">
                <img id="back" src="{{ asset('img/arrowGrey.png') }}" style="width: 20px;border: 0;">
            </a>
        </div>
    </div>
    
    <!-- Pagination data -->
    <div class="contbox" style="padding: 10px;">
        <div id="paginationTable" style="text-align: left;background: #f2f5ff;">
            @include('pagination.paginationData')
        </div>
    </div>
</div>

@php
//echo $data->url(1);
@endphp

<script type="text/javascript">
    /**
     * Send data via ajax call
     *
     */
    function ajaxCall(url) {
        ajaxRequest = $.ajax({
            url: url
        });

        // Alerts the results
        ajaxRequest.done(function(response, textStatus, jqXHR) {
            //alert(response);
            $('#paginationTable').html(response);
        });

        // Alerts the errors
        ajaxRequest.fail(function(xhr, status, error) {
            alert(
                '|====================' + "\n" +
                '| Ajax Request failed!' + "\n" +
                '|====================' + "\n" +
                'Status: ' + xhr.status + "\n" +
                'Response: ' + xhr.responseText + "\n" +
                'Error: ' + error
            );
        });
    }


    /**
     * Paginate items per page
     *
     */
    $(document).on('change', '#itemsPerPage', function(event) {
    //$("#itemsPerPage").change(function(event) {
        var itemsPerPage = $("#itemsPerPage option:selected").val();
        //var url = $(location).attr('href');
        //var page = url.split('page=')[1];

        // [Debug]
        //alert(itemsPerPage);

        // HTTP page redirect
        //$(location).attr('href', "{!! $data->url(1) !!}&items=" + itemsPerPage);

        // Ajax Call
        ajaxCall("{{ route('pagination.get') }}?page=1&items=" + itemsPerPage);
    }); 


    /**
	 * Paginate links
     *
	 */
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var itemsPerPageHidden = $('#itemsPerPageHidden').val();

        // [Debug]
        //alert(itemsPerPageHidden);

        // HTTP page redirect
        //$(location).attr('href', "{{ $data->url(1) }}&items=" + "{{ $itemsPerPage }}&page=" + page);
        
        // Ajax call
        ajaxCall("{{ route('pagination.get') }}?page=" + page + "&items=" + itemsPerPageHidden);
    });    
</script>
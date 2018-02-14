$(document).ready(function() {
	document.title = 'OPT11 :: Series';
    seriesRefresh();
    $(document).on('click', ".addSerBtn", function() {
        $('.remoteModalContent').load('views/series_add.html',function(){
            $('#remoteModal').modal({show:true});
        });
    });
    $(document).on('click', ".editSerBtn", function() {
        $.ajax({
            url: "api/series/"+$(this).attr("data-value"),
            type: "get",
            success: function(response) {
                var data=JSON.parse(response);
                $('.remoteModalContent').load('views/series_update.html',function(){
                    $.ajax({
                        url: "api/teams",
                        type: "get",
                        async: false,
                        success: function(response) {
                            var teams=JSON.parse(response);
                            $.each(teams, function(key, tem){
                                $(".stx").append('<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" id="stx" name="stx[]" value="'+tem.temId+'">'+tem.temName+'</label></div>');
                            })
                        }
                    });
                    $(".remoteModalContent #serId").val(data[0].serId);
                    $(".remoteModalContent #serName").val(data[0].serName);
                    $(".remoteModalContent #serShortName").val(data[0].serShortName);
                    $(".remoteModalContent #serDisplayName").val(data[0].serDisplayName);
                    $(".remoteModalContent #serStartDt").val(data[0].serStartDt);
                    $(".remoteModalContent #serEndDt").val(data[0].serEndDt);
                    $(".remoteModalContent #serVisibleStartDt").val(data[0].serVisibleStartDt);
                    $(".remoteModalContent #serVisibleEndDt").val(data[0].serVisibleEndDt);
                    $(".remoteModalContent #serStatus").val(data[0].serStatus);
                    var temIds=(data[0].temIds).split(',');
                    $.each(temIds, function (index, value) {
                        $('#stx[value="' + value.toString() + '"]').prop("checked", true);
                    });
                    $('#remoteModal').modal({show:true});
                });
            }
        });
    });
} );
function seriesRefresh() {
    $('#seriesTbl').dataTable().fnDestroy(); 
    $('#seriesTbl').DataTable( {
        "processing": true,
        "bInfo": false,
        "paging": false,
        "ajax": "api/series_dt",
        "columns": [
            { "data": "serName" },
            { "data": "serDisplayName" },
            { "data": "serStartDt" },
            { "data": "serEndDt" },
            { "data": "teams" },
            { "data": "serStatus" , render: function (data, type, row) { return activeInactiveArr[data]; } },
            { "data": "serId", render: function (data, type, row) { return "<button class='btn btn-link btn-sm editSerBtn' data-value='"+data+"'>Edit</button>"; } }
        ]
    });
}
$(document).ready(function() {
	document.title = 'OPT11 :: Bowling Styles';
    bowlingStyleRefresh();
    $(document).on('click', ".addBwsBtn", function() {
        $('.remoteModalContent').load('views/bowling_style_add.html',function(){
            $('#remoteModal').modal({show:true});
        });
    });
    $(document).on('click', ".editBwsBtn", function() {
        $.ajax({
            url: "api/bowling_style/"+$(this).attr("data-value"),
            type: "get",
            success: function(response) {
                var data=JSON.parse(response);
                $('.remoteModalContent').load('views/bowling_style_update.html',function(){
                    $(".remoteModalContent #bwsId").val(data[0].bwsId);
                    $(".remoteModalContent #bwsStyle").val(data[0].bwsStyle);
                    $(".remoteModalContent #bwsStatus").val(data[0].bwsStatus);
                    $('#remoteModal').modal({show:true});
                });
            }
        });
    });
} );
function bowlingStyleRefresh() {
    $('#bowlingStyleTbl').dataTable().fnDestroy(); 
    $('#bowlingStyleTbl').DataTable( {
        "processing": true,
        "bInfo": false,
        "paging": false,
        "ajax": "api/bowling_styles_dt",
        "columns": [
            { "data": "bwsStyle" },
            { "data": "bwsStatus" , render: function (data, type, row) { return activeInactiveArr[data]; } },
            { "data": "bwsId", render: function (data, type, row) { return "<button class='btn btn-link btn-sm editBwsBtn' data-value='"+data+"'>Edit</button>"; } }
        ]
    });
}
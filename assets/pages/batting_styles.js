$(document).ready(function() {
	document.title = 'OPT11 :: Batting Styles';
    battingStyleRefresh();
    $(document).on('click', ".addBtsBtn", function() {
        $('.remoteModalContent').load('views/batting_style_add.html',function(){
            $('#remoteModal').modal({show:true});
        });
    });
    $(document).on('click', ".editBtsBtn", function() {
        $.ajax({
            url: "api/batting_style/"+$(this).attr("data-value"),
            type: "get",
            success: function(response) {
                var data=JSON.parse(response);
                $('.remoteModalContent').load('views/batting_style_update.html',function(){
                    $(".remoteModalContent #btsId").val(data[0].btsId);
                    $(".remoteModalContent #btsStyle").val(data[0].btsStyle);
                    $(".remoteModalContent #btsStatus").val(data[0].btsStatus);
                    $('#remoteModal').modal({show:true});
                });
            }
        });
    });
} );
function battingStyleRefresh() {
    $('#battingStyleTbl').dataTable().fnDestroy(); 
    $('#battingStyleTbl').DataTable( {
        "processing": true,
        "bInfo": false,
        "paging": false,
        "ajax": "api/batting_styles_dt",
        "columns": [
            { "data": "btsStyle" },
            { "data": "btsStatus" , render: function (data, type, row) { return activeInactiveArr[data]; } },
            { "data": "btsId", render: function (data, type, row) { return "<button class='btn btn-link btn-sm editBtsBtn' data-value='"+data+"'>Edit</button>"; } }
        ]
    });
}
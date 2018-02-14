$(document).ready(function() {
	document.title = 'OPT11 :: Teams';
    teamRefresh();
    $(document).on('click', ".addTemBtn", function() {
        $('.remoteModalContent').load('views/team_add.html',function(){
            $('#remoteModal').modal({show:true});
        });
    });
    $(document).on('click', ".editTemBtn", function() {
        $.ajax({
            url: "api/team/"+$(this).attr("data-value"),
            type: "get",
            success: function(response) {
                var data=JSON.parse(response);
                $('.remoteModalContent').load('views/team_update.html',function(){
                    $(".remoteModalContent #temId").val(data[0].temId);
                    $(".remoteModalContent #temName").val(data[0].temName);
                    $(".remoteModalContent #temShortName").val(data[0].temShortName);
                    $(".remoteModalContent #temDisplayName").val(data[0].temDisplayName);
                    $(".remoteModalContent #temStatus").val(data[0].temStatus);
                    $('#remoteModal').modal({show:true});
                });
            }
        });
    });
} );
function teamRefresh() {
    $('#teamTbl').dataTable().fnDestroy(); 
    $('#teamTbl').DataTable( {
        "processing": true,
        "bInfo": false,
        "paging": false,
        "ajax": "api/teams_dt",
        "columns": [
            { "data": "temName" },
            { "data": "temShortName" },
            { "data": "temDisplayName" },
            { "data": "temStatus" , render: function (data, type, row) { return activeInactiveArr[data]; } },
            { "data": "temId", render: function (data, type, row) { return "<button class='btn btn-link btn-sm editTemBtn' data-value='"+data+"'>Edit</button>"; } }
        ]
    });
}
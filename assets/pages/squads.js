$(document).ready(function() {
    document.title = 'OPT11 :: Squads';
    delete players, playerRoles;
    var players=[];
    var playerRoles=[];
    squadRefresh();
    $(document).on('click', ".editTemBtn", function() {
        $.ajax({
            url: "api/squad/"+$(this).attr("data-value"),
            type: "get",
            async: false,
            success: function(response) {
                var data=JSON.parse(response);
                $.ajax({
                    url: "api/players",
                    type: "get",
                    async: false,
                    success: function(response) {
                        if(jQuery.isEmptyObject(players))
                            players.push(response);
                    }
                });
                $.ajax({
                    url: "api/player_roles",
                    type: "get",
                    async: false,
                    success: function(response) {
                        if(jQuery.isEmptyObject(playerRoles))
                            playerRoles.push(response);
                    }
                });
                $('.remoteModalContent').load('views/squad_update.html',function(){
                    $(".remoteModalContent #stxId").val(data[0].stxId);
                    $(".remoteModalContent #serDisplayName").html(data[0].serDisplayName);
                    $(".remoteModalContent #temDisplayName").html(data[0].temDisplayName);
                    $('#remoteModal').modal({show:true});
                });
            }
        });
    });
});
function squadRefresh() {
    $('#squadTbl').dataTable().fnDestroy(); 
    $('#squadTbl').DataTable( {
        "processing": true,
        "bInfo": false,
        "paging": false,
        "ajax": "api/squads_dt",
        "columns": [
            { "data": "serDisplayName" },
            { "data": "temDisplayName" },
            { "data": "stxId", render: function (data, type, row) { return "<button class='btn btn-link btn-sm editTemBtn' data-value='"+data+"'>Edit</button>"; } }
        ]
    });
}
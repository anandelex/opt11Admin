$(document).ready(function() {
	document.title = 'OPT11 :: Players';
    playerRefresh();
    $(document).on('click', ".addPlrBtn", function() {
        $('.remoteModalContent').load('views/player_add.html',function(){
            $('#remoteModal').modal({show:true});
        });
    });
    $(document).on('click', ".editPlrBtn", function() {
        $.ajax({
            url: "api/player/"+$(this).attr("data-value"),
            type: "get",
            success: function(response) {
                var data=JSON.parse(response);
                $('.remoteModalContent').load('views/player_update.html',function(){
                    $(".remoteModalContent #plrId").val(data[0].plrId);
                    $(".remoteModalContent #plrName").val(data[0].plrName);
                    $(".remoteModalContent #plrShortName").val(data[0].plrShortName);
                    $(".remoteModalContent #plrDisplayName").val(data[0].plrDisplayName);
                    $(".remoteModalContent #plrDOB").val(data[0].plrDOB);
                    $(".remoteModalContent #plrStatus").val(data[0].plrStatus);
                    $.ajax({
                        url: "api/batting_styles",
                        type: "get",
                        success: function(response) {
                            var battingStyles=JSON.parse(response);
                            $.each(battingStyles, function(key, bts){
                                $(".remoteModalContent #plrBatStyle").append('<option value="' + bts.btsId + '"'+((data[0].plrBatStyle==bts.btsId)?' selected':'')+'>' + bts.btsStyle+ '</option>');
                            })
                        }
                    });
                    $.ajax({
                        url: "api/bowling_styles",
                        type: "get",
                        success: function(response) {
                            var bowlingStyles=JSON.parse(response);
                            $.each(bowlingStyles, function(key, bws){
                                $(".remoteModalContent #plrBowlStyle").append('<option value="' + bws.bwsId + '"'+((data[0].plrBowlStyle==bws.bwsId)?' selected':'')+'>' + bws.bwsStyle+ '</option>');
                            })
                        }
                    });
                    $.ajax({
                        url: "api/player_roles",
                        type: "get",
                        success: function(response) {
                            var playerRoles=JSON.parse(response);
                            $.each(playerRoles, function(key, prl){
                                $(".remoteModalContent #plrMajorRole").append('<option value="' + prl.prlId + '"'+((data[0].plrMajorRole==prl.prlId)?' selected':'')+'>' + prl.prlRole+ '</option>');
                            })
                        }
                    });
                    $('#remoteModal').modal({show:true});
                });
            }
        });
    });
} );
function playerRefresh() {
    $('#playerTbl').dataTable().fnDestroy(); 
    $('#playerTbl').DataTable( {
        "processing": true,
        "bInfo": false,
        "paging": false,
        "ajax": "api/players_dt",
        "columns": [
            { "data": "plrName" },
            { "data": "plrShortName" },
            { "data": "plrDisplayName" },
            { "data": "plrStatus" , render: function (data, type, row) { return activeInactiveArr[data]; } },
            { "data": "plrId", render: function (data, type, row) { return "<button class='btn btn-link btn-sm editPlrBtn' data-value='"+data+"'>Edit</button>"; } }
        ]
    });
}
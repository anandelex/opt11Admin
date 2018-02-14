$(document).ready(function() {
	document.title = 'OPT11 :: Player Roles';
    playerRoleRefresh();
    $(document).on('click', ".addPrlBtn", function() {
        $('.remoteModalContent').load('views/player_role_add.html',function(){
            $('#remoteModal').modal({show:true});
        });
    });
    $(document).on('click', ".editPrlBtn", function() {
        $.ajax({
            url: "api/player_role/"+$(this).attr("data-value"),
            type: "get",
            success: function(response) {
                var data=JSON.parse(response);
                $('.remoteModalContent').load('views/player_role_update.html',function(){
                    $(".remoteModalContent #prlId").val(data[0].prlId);
                    $(".remoteModalContent #prlRole").val(data[0].prlRole);
                    $(".remoteModalContent #prlStatus").val(data[0].prlStatus);
                    $('#remoteModal').modal({show:true});
                });
            }
        });
    });
} );
function playerRoleRefresh() {
    $('#playerRoleTbl').dataTable().fnDestroy(); 
    $('#playerRoleTbl').DataTable( {
        "processing": true,
        "bInfo": false,
        "paging": false,
        "ajax": "api/player_roles_dt",
        "columns": [
            { "data": "prlRole" },
            { "data": "prlStatus" , render: function (data, type, row) { return activeInactiveArr[data]; } },
            { "data": "prlId", render: function (data, type, row) { return "<button class='btn btn-link btn-sm editPrlBtn' data-value='"+data+"'>Edit</button>"; } }
        ]
    });
}
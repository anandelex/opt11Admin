$(document).ready(function() {
    document.title = 'OPT11 :: Codelist';
    codelistRefresh();
    $(document).on('click', ".addCdlBtn", function() {
        $('.remoteModalContent').load('views/codelist_add.html',function(){
            $('#remoteModal').modal({show:true});
        });
    });
    $(document).on('click', ".editCdlBtn", function() {
        $.ajax({
            url: "api/codelist/"+$(this).attr("data-value"),
            type: "get",
            success: function(response) {
                var data=JSON.parse(response);
                $('.remoteModalContent').load('views/codelist_update.html',function(){
                    $(".remoteModalContent #cdlId").val(data[0].cdlId);
                    $(".remoteModalContent #cdlName").val(data[0].cdlName);
                    $(".remoteModalContent #cdlStatus").val(data[0].cdlStatus);
                    $('#remoteModal').modal({show:true});
                });
            }
        });
    });
} );
function codelistRefresh() {
    $('#codelistTbl').dataTable().fnDestroy(); 
    $('#codelistTbl').DataTable( {
        "processing": true,
        "bInfo": false,
        "paging": false,
        "ajax": "api/codelists_dt",
        "columns": [
            { "data": "cdlName" },
            { "data": "cdlStatus" , render: function (data, type, row) { return activeInactiveArr[data]; } },
            { "data": "cdlId", render: function (data, type, row) { return "<button class='btn btn-link btn-sm editCdlBtn' data-value='"+data+"'>Edit</button>"; } }
        ]
    });
}
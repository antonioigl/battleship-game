$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('button').prop('disabled',true);

    // get request sunken ships to paint sunken ships
    $.get('/ships/my-ships', function(response){
        $('button').children('i').removeClass('fa-spinner');
        $('button').children('i').removeClass('fa-spin');
        if(response.ships.length){
            for (var i = 0; i < response.ships.length; i++){
                var x = response.ships[i]['x'];
                var y = response.ships[i]['y'];
                var axis = response.ships[i]['axis'];
                var length = response.ships[i]['length'];
                var shot_counter = response.ships[i]['shot_counter'];

                if (length == shot_counter){
                    for (var j = 0; j < length; j++){
                        var axisId = x.toString() + y.toString();
                        $('#' + axisId).removeClass('btn-primary');
                        $('#' + axisId).addClass('btn-danger');
                        $('#' + axisId).children('i').addClass('fa-ship');

                        if (axis === 'H'){
                            x++;
                        }
                        else {
                            y++;
                        }
                    }
                }
            }
        }
    });
});

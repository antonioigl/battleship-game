
const totalSizeShips = 14;

function fire(x, y) {
    var id = x.toString() + y.toString();
    $('#' + id).children('i').remove();
    $('#' + id).append( "<i class=\"fa fa-spinner fa-spin\"></i>" );
    $('button').prop('disabled',true);

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.post('/shots',
        {
            _token: CSRF_TOKEN,
            data: {x: x, y: y}
        },
        function(data,status){
            $('#' + id).removeClass('btn-light');
            $('#' + id).children('i').removeClass('fa-spinner');
            $('#' + id).children('i').removeClass('fa-spin');

            //success
            if (data.state){
                // sunken ship
                if (data.ship['length'] == data.ship['shot_counter']){
                    var axisXship = data.ship['x'];
                    var axisYship = data.ship['y'];

                    for (var i = 0; i < data.ship['length']; i++){
                        var axisId = axisXship.toString() + axisYship.toString();
                        $('#' + axisId).removeClass('btn-warning');
                        $('#' + axisId).addClass('btn-danger');
                        $('#' + axisId).children('i').removeClass('fa-bomb');
                        $('#' + axisId).children('i').addClass('fa-ship');

                        if (data.ship['axis'] === 'H'){
                            axisXship++;
                        }
                        else {
                            axisYship++;
                        }
                    }
                }
                //boat fired
                else {
                    $('#' + id).addClass('btn-warning');
                    $('#' + id).children('i').removeClass('fa-bomb');
                    $('#' + id).children('i').addClass('fa-ship');
                }
            }
            //water
            else {
                //add class primary if not has class danger or warning
                if (!($('#' + id).hasClass('btn-danger') || $('#' + id).hasClass('btn-warning'))) {
                    $('#' + id).addClass('btn-primary');
                }
                else {
                    $('#' + id).children('i').addClass('fa-ship');
                }
            }
            $('button').prop('disabled',false);
            $('#total-shots').text(data.shotsCount.toString());

            $.get('/ships/game-over', function(response){
                if (response.gameOver){
                    $('#gameOverModalCenter').modal();
                }
            });
        }
    );

    var shots = totalSizeShips/parseInt($('#total-shots').text());
    $('#score').html(shots.toFixed(4));

    $('#gameOverModalCenter').on('hidden.bs.modal', function(){
        $('button').prop('disabled',true);
    });
}

function storeScore()
{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.post('/scores',
        {
            _token: CSRF_TOKEN,
        },
        function(data,status){
            if (data.urlRedirect !== '') {
                // data.redirect contains the string URL to redirect to
                window.location.href = data.urlRedirect;
            }

        }
    );
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('button').prop('disabled',true);

    //get request paint shots user login.
    // if ship_id is not null is success else is water
    $.get('/shots/my-shots', function(response){

        if(response.shots.length){
            for (var i = 0; i < response.shots.length; i++){

                var x = response.shots[i]['x'];
                var y = response.shots[i]['y'];
                var id = x.toString() + y.toString();
                var shipId = response.shots[i]['ship_id'];

                $('#' + id).removeClass('btn-light');

                //success
                if (shipId){
                    $('#' + id).addClass('btn-warning');
                    $('#' + id).children('i').addClass('fa-ship');
                }
                //water
                else {
                    $('#' + id).children('i').removeClass('fa-bomb');
                    $('#' + id).addClass('btn-primary');
                }
            }

            $('#total-shots').text(response.shots.length.toString());
            var shots = totalSizeShips/parseInt($('#total-shots').text());
            $('#score').html(shots.toFixed(4));
        }
        $('button').prop('disabled',false);
    });


    // get request sunken ships to paint sunken ships
    $.get('/ships/my-ships', function(response){

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
                        $('#' + axisId).removeClass('btn-warning');
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
        $('button').prop('disabled',false);
    });

    $('#gameOverModalCenter').on('hidden.bs.modal', function(){
        $('button').prop('disabled',true);
    });

    $.get('/ships/game-over', function(response){
        if (response.gameOver){
            $('#gameOverModalCenter').modal();
        }
    });
});

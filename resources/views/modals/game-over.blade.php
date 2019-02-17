<div class="modal fade" id="gameOverModalCenter" tabindex="-1" role="dialog" aria-labelledby="gameOverCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gameOverModalLongTitle">GAME OVER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Your score is: <strong><span id="score"></span></strong> <br>
            </div>
            <div class="modal-body text-center">
                <a href="{{route('ships.create')}}" class="btn btn-primary">NEW GAME</a>
                <a href="" class="btn btn-primary">MY SCORES</a>
                <a href="" class="btn btn-primary">RANKING</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

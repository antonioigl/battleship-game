<div class="modal fade" id="resetGameModal" tabindex="-1" role="dialog" aria-labelledby="resetGameModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetGameModalLabel">RESET GAME</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Your current game will be deleted. Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="{{route('ships.reset')}}" class="btn btn-primary">Yes, I accept</a>
            </div>
        </div>
    </div>
</div>

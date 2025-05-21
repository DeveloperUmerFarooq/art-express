<!-- Edit Auction Modal -->
<div class="modal fade" id="editAuctionModal" tabindex="-1" aria-labelledby="editAuctionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{route($role.'.auction.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="auction-id" name="auction_id">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="editAuctionModalLabel"><i class="fas fa-edit"></i> Edit Auction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Auction Title</label>
                        <input type="text" name="title" class="form-control" id="auction-title" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="auction-description" rows="3"></textarea>
                    </div>
                </div>
                <div class="d-flex align-items-center py-3 justify-content-center">
                    <button class="btn btn-success"><i class="fas fa-save me-1"></i> Update Auction</button>
                </div>
            </form>
        </div>
    </div>
</div>

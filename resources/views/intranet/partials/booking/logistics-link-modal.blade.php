<div class="modal" id="logisticsLinkModal" tabindex="-1" role="dialog" aria-labelledby="logisticsLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {{ empty($booking->share_hash) ? "Logistics link is not created" : url('docs/logistics/') . '/' . $booking->share_hash }}
            </div>
        </div>
    </div>
</div>
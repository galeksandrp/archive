</div>
<!-- ��������� ���� �������-->
<div class="modal" id="bannerModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog @popupSize@">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close popup-close" data-id="@popupId@" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">@banerTitle@</h4>
            </div>
            <div class="modal-body">
                @banerContent@
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default popup-close" data-id="@popupId@" data-dismiss="modal">{�������}</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        
        // PopUp
        $("#bannerModal").modal("show");

        // ������� PopUp
        $('.popup-close').on('click', function (e) {
            e.preventDefault();
            $('#bannerModal').addClass('hide');
            $.cookie('popup'+$(this).attr('data-id')+'_close', 1, {
                path: '/',
                expires: 24
            });
        });
    });
</script>
<div class="visible-lg visible-md">
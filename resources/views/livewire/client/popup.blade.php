<div>
    <!--=========================-->
    <!--=   Popup 1: Báo lỗi có 2 button =-->
    <!--=========================-->
{{--    <div class="text-center">--}}
{{--        <a href="#myModal1" class="trigger-btn" data-toggle="modal">Click to Open Confirm Modal</a>--}}
{{--    </div>--}}

    <!-- Modal HTML -->
{{--    <div id="myModal1" class="modal fade show" style="display: block; padding-right: 17px;">--}}
    <div id="myModal1" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <div class="icon-box d-flex justify-content-center align-items-center" style="color: #f15e5e;">
                        <i class="material-icons" >&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title text-center" style="margin-right: 24px;">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <p>Do you really want to delete these records? <br> This process cannot be undone.</p>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <!--=========================-->
    <!--=   Popup 2: Thông báo thành công  =-->
    <!--=========================-->
{{--            <div class="text-center">--}}
{{--                <!-- Button HTML (to Trigger Modal) -->--}}
{{--                <a href="#myModal2" class="trigger-btn" data-toggle="modal">Click to Open Confirm Modal</a>--}}
{{--            </div>--}}

    <div id="myModal2" class="modal fade {{$show2}}" style="{{$style2}}">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <div class="icon-box align-items-center" style="color: green;">
                        <i class="material-icons" style="color: green;" >&#xE876;</i>
                    </div>
                    <h4 class="modal-title" style="margin-right: 40px;">Awesome!</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Your booking has been confirmed. <br> Check your email for details.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" data-dismiss="modal" wire:click="hide">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!--=========================-->
    <!--=   Popup 2: Thông báo thất bại  =-->
    <!--=========================-->
    {{--        <div class="text-center">--}}
    {{--            <!-- Button HTML (to Trigger Modal) -->--}}
    {{--            <a href="#myModal3" class="trigger-btn" data-toggle="modal">Click to Open Confirm Modal</a>--}}
    {{--        </div>--}}

    <!-- Modal HTML -->
    <div id="myModal3" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <div class="icon-box align-items-center" style="color: red;">
                        <i class="material-icons" style="color: red;" >&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title" style="margin-right: 70px;">Sorry!</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Your transaction has failed. <br> Please go back and try again.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

</div>

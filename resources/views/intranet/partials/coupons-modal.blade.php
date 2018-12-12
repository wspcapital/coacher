<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
                <h2 class="modal-title">Generate Coupons</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="/intranet/coupons" novalidate>
                    {{ csrf_field() }}

                    <div class="form-group form-group-lg">
                        <label for="couponsType" class="col-sm-4 control-label">Type</label>
                        <div class="col-sm-5">
                            <select class="form-control" v-model="formType" name="type" id="couponsType" required>
                                <option v-for="couponsType in couponsTypes" v-bind:value="couponsType.value">
                                   @{{ couponsType.text }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-lg" v-show="formType=='discount'">
                        <label for="couponsDiscount" class="col-sm-4 control-label">Discount %</label>
                        <div class="col-sm-5">
                            <input type="number" min="0" max="99" class="form-control" name="discount" id="couponsDiscount" placeholder="Coupons discount in %" ng-model="coupons.discount" ng-disabled="coupons.type!='discount'" required>
                        </div>
                    </div>
                    <div class="form-group form-group-lg" v-show="formType=='free'">
                        <label for="couponsVcoaches" class="col-sm-4 control-label">Free Vcoaches</label>
                        <div class="col-sm-5">
                            <input type="number" min="0" max="99" class="form-control" name="vcoaches" id="couponsVcoaches" placeholder="Virtual Coach Videos" ng-model="coupons.vcoaches" ng-disabled="coupons.type!='free'" required>
                        </div>
                    </div>
                    <div class="form-group form-group-lg" v-show="formType=='free'">
                        <label for="couponsSessions" class="col-sm-4 control-label">Free Sessions</label>
                        <div class="col-sm-5">
                            <input type="number" min="0" max="99" class="form-control" name="sessions" id="couponsSessions" placeholder="Coaching Sessions" ng-model="coupons.sessions" ng-disabled="coupons.type!='free'" required>
                        </div>
                    </div>
                    <div class="form-group form-group-lg" v-show="formType!=1">
                        <label for="couponsQuantity" class="col-sm-4 control-label">Coupons Quantity</label>
                        <div class="col-sm-5">
                            <input type="number" min="1" class="form-control" name="quantity" id="couponsQuantity" placeholder="Quantity" ng-model="coupons.quantity" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-fixed" style="margin: 0" v-show="formType!=1">
                            Generate
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
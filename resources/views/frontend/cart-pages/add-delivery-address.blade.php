<div class="checkbox-form">

    
    <div class="different-address">
        <div class="ship-different-title">
            <h3>
                <label class="editAddresslabel">Ship to a different address?</label>
                <input id="ship-box" type="checkbox" class="newAddress">
            </h3>
        </div>

        <div id="ship-box-info" class="row">
            <form action="javascript:void(0)" id="addressAddEditForm" method="post">
                @csrf
                <input type="hidden" name="delivery_id">
                <div class="col-md-12">
                    <div class="country-select clearfix">
                        <label>Country <span class="required">*</span></label>
                        <select class="nice-select wide" name="delivery_country">
                            <option data-display="India">India</option>
                            <option value="India">India</option>
                            <option value="rou">Romania</option>
                            <option value="fr">French</option>
                            <option value="de">Germany</option>
                            <option value="aus">Australia</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="checkout-form-list">
                        <label>Name <span class="required">*</span></label>
                        <input placeholder="" type="text" id="delivery_name" name="delivery_name">
                        <span class="text-danger error-text delivery_name_error"></span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="checkout-form-list">
                        <label>Address <span class="required">*</span></label>
                        <input placeholder="Street address" name="delivery_address" type="text">
                        <span class="text-danger error-text delivery_address_error"></span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="checkout-form-list">
                        <label>Town / City <span class="required">*</span></label>
                        <input type="text" name="delivery_city">
                        <span class="text-danger error-text delivery_city_error"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="checkout-form-list">
                        <label>State <span class="required">*</span></label>
                        <input placeholder="" type="text" name="delivery_state">
                        <span class="text-danger error-text delivery_state_error"></span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="checkout-form-list">
                        <label>Postcode / Zip <span class="required">*</span></label>
                        <input placeholder="" type="text" name="delivery_pincode">
                        <span class="text-danger error-text delivery_pincode_error"></span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="checkout-form-list">
                        <label>Phone <span class="required">*</span></label>
                        <input type="text" name="delivery_phone">
                        <span class="text-danger error-text delivery_phone_error"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="checkout-form-list">

                        <button type="submit" class="btn btn-info w-100">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="order-notes">
            <div class="checkout-form-list">
                <label>Order Notes</label>
                <textarea id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
            </div>
        </div>
    </div>












</div>
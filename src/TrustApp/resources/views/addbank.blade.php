@extends('layouts.admin')

@section('main-content')
<div class="panel-heading text-center">
    <h4 style="color: blue;"><span id="card_type"></span>Add Bank</h4>
</div>
    <div class="card">
        <div class="card-body">
        <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default">
            <!-- <div class="panel-heading text-center">
              <h4><span id="card_type"></span> Add a bank account</h4>
            </div> -->
            <div class="panel-body">
              <form action="" method="POST" id="payment-form">
                <div class="errors"></div>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Country</label>
                      <select class="form-control input-lg" id="country" data-stripe="country">
                        <option value="NG">Nigeria</option>
                        <option value="LR">Liberia</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Currency</label>
                      <select class="form-control input-lg" id="currency" data-stripe="currency">
                        <option value="usd">USD</option>
                        <option value="lrd">LRD</option>
                        <option value="nr">NAIRA</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Full Legal Name</label>
                      <input class="form-control input-lg account_holder_name" id="account_holder_name" type="text" data-stripe="account_holder_name" placeholder="Jane Doe" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Account Type</label>
                      <select class="form-control input-lg account_holder_type" id="account_holder_type" data-stripe="account_holder_type">
                        <option value="business">Current</option>
                        <option value="company">Savings</option>
                        <option value="salary">Salary</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6" id="routing_number_div">
                    <div class="form-group">
                      <label id="routing_number_label">Routing Number</label>
                      <input class="form-control input-lg bank_account" id="routing_number" type="tel" size="12" data-stripe="routing_number" placeholder="111000025" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label id="account_number_label">Account Number</label>
                      <input class="form-control input-lg bank_account" id="account_number" type="tel" size="20" data-stripe="account_number" placeholder="000123456789" autocomplete="off">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-lg btn-block btn-success submit" type="submit">Add bank account</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
</div>
<br>
@endsection
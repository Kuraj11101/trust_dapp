@extends('layouts.admin')

@section('main-content')
<header class="row justify-content-center" style="color: blue; font-size: 20px;">Add Bank Card</header>
<div class="card">
    <div class="card-body">
        <form accept-charset="UTF-8" action="/" class="require-validation justify-content-center" data-cc-on-file="false" id="payment-form" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="sk_test_51GrrIyKCyJL0SnmtUPl67iH7JqMOs7oHHlINOMYSE1ItdYJ7Z58t9phRwNVNo23Z1SSQiD1XI3B4IZBE1RXi8gI700XAgwNU2S" /><input name="_method" type="hidden" value="PUT" /><input name="authenticity_token" type="hidden" /></div>
            <div class='form-row justify-content-center'>
              <div class='col-xs-12 form-group justify-content-center required'>
                <label class='control-label justify-content-center'>Name on Card</label>
                <input class='form-control' size='20' type='text'>
              </div>
            </div>
            <div class='form-row justify-content-center'>
              <div class='col-xs-12 form-group card required'>
                <label class='control-label'>Card Number</label>
                <input autocomplete='off' class='form-control card-number' size='20' type='text'>
              </div>
            </div>
            <div class='form-row justify-content-center'>
              <div class='col-xs-4 form-group cvc required'>
                <label class='control-label'>CVC</label>
                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
              </div>
              <div class='col-xs-4 form-group expiration required'>
                <label class='control-label'>Expiration</label>
                <input class='form-control card-expiry-month justify-content-center' placeholder='MM' size='2' type='text'>
              </div>
              <div class='col-xs-4 form-group justify-content-center expiration required'>
                <label class='control-label'> </label>
                <input class='form-control card-expiry-year justify-content-center' placeholder='YYYY' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12'>

              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 form-group'>
                <button class='form-control btn btn-primary submit-button' type='submit'>Add Card</button>
              </div>
            </div>
            <div class='form-row'>
            </div>
          </form>
        </div>
</div>
<br>
@endsection
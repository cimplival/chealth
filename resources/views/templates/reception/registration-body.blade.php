@if (Session::has('info'))
@include('templates.sub-sections.alerts.info')
@endif
@if (Session::has('success'))
@include('templates.sub-sections.alerts.success')
@endif
@if (count($errors) > 0)
@include('templates.sub-sections.alerts.errors')
@endif
<div class="panel panel-default">
  <div class="panel-heading bg-primary text-left">Register a New Patient</div>
  <div class="panel-body">
    <form role="form" url="reception-registration" action="{{route('register-patient')}}" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
      <label class="col-md-12"><strong>Demographics</strong></label><br><br>
      <div class="form-group col-md-6">
        <input type="text" class="form-control focus" name="first_name" value="{{Request::old('first_name')}}" autocomplete="off" placeholder="First Name" title="Input the patient's first name." required/>
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="middle_name" value="{{Request::old('middle_name')}}" autocomplete="off" placeholder="Middle Name" title="Input the patient's middle name."/>
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="last_name" value="{{Request::old('last_name')}}" autocomplete="off" placeholder="Last Name" title="Input the patient's last name."/>
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="residence" value="{{Request::old('residence')}}" autocomplete="off" placeholder="Place of Residence" title="Input the residence of the patient."/>
      </div>
      <div class="form-group col-md-6">
        <select ui-jq="chosen" class="w-full form-control" name="county" value="{{Request::old('county')}}" >
          <optgroup label="County" title="Select a Kenyan County of Residence.">
            @include('templates.reception.select-counties')
          </optgroup>
        </select>
      </div>
      <div class="form-group col-md-6">
        <select ui-jq="chosen" class="w-full form-control" name="country_origin" value="{{Request::old('country_origin')}}">
          <optgroup label="Country" title="Select the country of Origin.">
            @include('templates.reception.select-countries')
          </optgroup>
        </select>
      </div>
      <div class="form-group col-md-6">
        <input type="phone" class="form-control" name="patient_phone" value="{{Request::old('patient_phone')}}" autocomplete="off" placeholder="Patient Phone i.e 0703 000 000" title="Input the patient's phone number.">
      </div>
      <div class="form-group col-md-6">
        <input type="email" class="form-control" name="email" value="{{Request::old('email')}}" autocomplete="off" placeholder="Email Address" title="Input the patient's email address.">
      </div>
      <div class="form-group col-sm-6">
        <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date_birth" placeholder="Date of Birth" value="{{Request::old('date_birth')}}"  data-date-format="dd MM yyyy"" onkeydown="return false" autocomplete="off" title="Choose the patient's date of birth."/>
      </div>
      <div class="form-group col-md-6">
        <input id="estimatedAge" name="estimated_age" ui-jq="TouchSpin" class="form-control" data-min="1" data-verticalbuttons="true" data-verticalupclass="fa fa-caret-up" data-verticaldownclass="fa fa-caret-down" style="display: block;" type="text" onkeydown="return false" value="{{Request::old('estimated_age')}}" autocomplete="off" title="Input the estimated age" placeholder="or estimated age (optional)" title="Input an estimated age. It is optional." />
      </div>
      <div class="form-group col-md-offset-6 col-md-10 radio">
        <span class="text-muted">Gender:</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label class="i-checks">
          <input type="radio" name="gender" value="Male" title="Check if the patient is male.">
          <i></i>&nbsp;&nbsp;&nbsp;Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </label>
        <label class="i-checks">
          <input type="radio" name="gender" value="Female" title="Choose if the patient is female.">
          <i></i>&nbsp;&nbsp;&nbsp;Female
        </label>
      </div><br><br><br>
      <div class="line line-dashed b-b line-lg"></div><br>
      <label class="col-md-12"><strong>Next of Kin</strong></label><br><br>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="kin_name" value="{{Request::old('kin_name')}}" autocomplete="off" placeholder="Full Name of Next of Kin" title="Input the name of next of Kin.">
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="kin_relashionship" value="{{Request::old('kin_relashionship')}}" autocomplete="off" placeholder="Next of Kin Relationship" title="Input the relationship of next of Kin.">
      </div>
      <div class="form-group col-md-6">
        <input type="phone" class="form-control" name="kin_phone" value="{{Request::old('kin_phone')}}" autocomplete="off" placeholder="Next of Kin Phone i.e 0703 000 000" title="Input the patient's next of Kin phone number.">
      </div>
      <div class="line line-dashed b-b line-lg"></div><br>
      <label class="col-md-12"><strong>Insurance Plan (If Applicable)</strong></label><br><br>
      <div class="form-group col-md-6">
        <select class="form-control w-full" ui-jq="chosen" name="provider_id" title="Search and select an Insurance Provider">
          <option class="text-muted" value="">Select an Insurance Provider...</option>
          @foreach($providers as $provider)
          <option value="{{ $provider->id }}">{{ $provider->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="insurance_identifier" value="{{Request::old('insurance_identifier')}}" autocomplete="off" placeholder="Insurance Patient Identifier" title="Input the name of next of Kin.">
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="national_id" value="{{Request::old('national_id')}}" autocomplete="off" placeholder="National ID." title="Input the National ID.">
      </div>
      <div class="line line-dashed b-b line-lg"></div><br>
    </div>
    <div class="panel-footer bg-light">
      <div class="row">
        <div class="col-md-3 col-md-offset-9">
          <button type="submit" class="form-control btn btn-sm btn-success text-center">Register New Patient</button>
        </div>
      </div>
    </form>
  </div>
</div>


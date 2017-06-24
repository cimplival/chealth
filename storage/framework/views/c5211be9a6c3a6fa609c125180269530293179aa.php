<?php if(Session::has('info')): ?>
<?php echo $__env->make('templates.sub-sections.alerts.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(Session::has('success')): ?>
<?php echo $__env->make('templates.sub-sections.alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(count($errors) > 0): ?>
<?php echo $__env->make('templates.sub-sections.alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<div class="panel panel-default">
  <div class="panel-heading bg-primary text-left">Register a New Patient</div>
  <div class="panel-body">
    <form role="form" url="reception-registration" action="<?php echo e(route('register-patient')); ?>" method="POST">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"><br>
      <label class="col-md-12"><strong>Demographics</strong></label><br><br>
      <div class="form-group col-md-6">
        <input type="text" class="form-control focus" name="first_name" value="<?php echo e(Request::old('first_name')); ?>" autocomplete="off" placeholder="First Name" title="Input the patient's first name." required/>
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="middle_name" value="<?php echo e(Request::old('middle_name')); ?>" autocomplete="off" placeholder="Middle Name" title="Input the patient's middle name."/>
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="last_name" value="<?php echo e(Request::old('last_name')); ?>" autocomplete="off" placeholder="Last Name" title="Input the patient's last name."/>
      </div>
      <div class="form-group col-sm-6">
        <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date_birth" placeholder="Date of Birth" value="<?php echo e(Request::old('date_birth')); ?>"  data-date-format="dd MM yyyy"" onkeydown="return false" autocomplete="off" title="Choose the patient's date of birth."/>
      </div>
      <div class="form-group col-md-12 radio">
        <label class="i-checks">
          <input type="radio" name="gender" value="Male" title="Check if the patient is male.">
          <i></i>&nbsp;&nbsp;&nbsp;Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </label>
        <label class="i-checks">
          <input type="radio" name="gender" value="Female" title="Choose if the patient is female.">
          <i></i>&nbsp;&nbsp;&nbsp;Female
        </label>
      </div>
      <div class="form-group col-md-6">
        <input id="estimatedAge" name="estimated_age" ui-jq="TouchSpin" class="form-control" data-min="1" data-verticalbuttons="true" data-verticalupclass="fa fa-caret-up" data-verticaldownclass="fa fa-caret-down" style="display: block;" type="text" onkeydown="return false" value="<?php echo e(Request::old('estimated_age')); ?>" autocomplete="off" title="Input the estimated age" placeholder="or estimated age (optional)" title="Input an estimated age. It is optional." />
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="residence" value="<?php echo e(Request::old('residence')); ?>" autocomplete="off" placeholder="Place of Residence" title="Input the residence of the patient."/>
      </div>
      <div class="form-group col-md-6">
        <select ui-jq="chosen" class="w-full form-control" name="county" value="<?php echo e(Request::old('county')); ?>" >
          <optgroup label="County" title="Select a Kenyan County of Residence.">
            <?php echo $__env->make('templates.reception.select-counties', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </optgroup>
        </select>
      </div>
      <div class="form-group col-md-6">
        <select ui-jq="chosen" class="w-full form-control" name="country_origin" value="<?php echo e(Request::old('country_origin')); ?>">
          <optgroup label="Country" title="Select the country of Origin.">
            <?php echo $__env->make('templates.reception.select-countries', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </optgroup>
        </select>
      </div>
      <div class="form-group col-md-6">
        <input type="phone" class="form-control" name="patient_phone" value="<?php echo e(Request::old('patient_phone')); ?>" autocomplete="off" placeholder="Patient Phone i.e 0703 000 000" title="Input the patient's phone number.">
      </div>
      <div class="form-group col-md-6">
        <input type="email" class="form-control" name="email" value="<?php echo e(Request::old('email')); ?>" autocomplete="off" placeholder="Email Address" title="Input the patient's email address.">
      </div>
      <div class="line line-dashed b-b line-lg"></div><br>
      <label class="col-md-12"><strong>Next of Kin</strong></label><br><br>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="kin_name" value="<?php echo e(Request::old('kin_name')); ?>" autocomplete="off" placeholder="Full Name of Next of Kin" title="Input the name of next of Kin.">
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="kin_relashionship" value="<?php echo e(Request::old('kin_relashionship')); ?>" autocomplete="off" placeholder="Next of Kin Relationship" title="Input the relationship of next of Kin.">
      </div>
      <div class="form-group col-md-6">
        <input type="phone" class="form-control" name="kin_phone" value="<?php echo e(Request::old('kin_phone')); ?>" autocomplete="off" placeholder="Next of Kin Phone i.e 0703 000 000" title="Input the patient's next of Kin phone number.">
      </div>
      <div class="line line-dashed b-b line-lg"></div><br>
      <label class="col-md-12"><strong>Insurance Plan (If Applicable)</strong></label><br><br>
      <div class="form-group col-md-6">
        <select class="form-control w-full" ui-jq="chosen" name="provider_id" title="Search and select an Insurance Provider">
          <option class="text-muted" value="">Select an Insurance Provider...</option>
          <?php foreach($providers as $provider): ?>
          <option value="<?php echo e($provider->id); ?>"><?php echo e($provider->name); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="insurance_identifier" value="<?php echo e(Request::old('insurance_identifier')); ?>" autocomplete="off" placeholder="Insurance Patient Identifier" title="Input the name of next of Kin.">
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="national_id" value="<?php echo e(Request::old('national_id')); ?>" autocomplete="off" placeholder="National ID." title="Input the National ID.">
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


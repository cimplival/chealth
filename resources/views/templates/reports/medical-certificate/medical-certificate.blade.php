<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>
		</title>
		<link rel="stylesheet" type="text/css" href="medical_files/style.css">
	</head>
	<body>
		<div class="stl_01">
			<object data="medical_files/img_01.svg" type="image/svg+xml" class="stl_02">
				<embed src="medical_files/img_01.svg" type="image/svg+xml" class="stl_02">
			</object>
			<div class="stl_03" style="width: 100%; left: 0px; text-align: center;"><span class="stl_04" style="font-size: 26px;">{{ $settings->name_of_institution }}</span></div>
			<div class="stl_05"><span class="stl_06">MEDICAL CERTIFICATE</span></div>
			<div class="stl_07"><span class="stl_06">Our Ref: {{ Carbon\Carbon::parse($vital->created_at)->format('ymdHis') }}</span></div>
			<div class="stl_08"><span class="stl_06">Date: {{ $appointment_created }}
			</span></div>

			<div class="stl_11"><span class="stl_06">Name: </span><span class="stl_12">&nbsp;{{$patient->first_name}} {{$patient->middle_name}} {{$patient->last_name}}</span></div>
			<div class="stl_13"><span class="stl_06">Sex: </span><span class="stl_12">&nbsp;{{$patient->gender}}</span></div>
			<div class="stl_14"><span class="stl_06">Age: </span>
				<span class="stl_12">&nbsp;
					{{ Carbon\Carbon::parse($patient->date_birth)->age }} years old
				</span></div>
			<div class="stl_15"><span class="stl_06">Weight: </span><span class="stl_12">&nbsp;{{$vital->weight}}</span></div>
			<div class="stl_16"><span class="stl_06">BP: </span><span class="stl_12">&nbsp;{{$vital->blood_pressure}} mmHg</span></div>
			<div class="stl_17"><span class="stl_06">Temperature: </span><span class="stl_12">&nbsp;{{$vital->temperature}}</span><span class="stl_18">°</span><span class="stl_12">C</span></div>
			<div class="stl_19"><span class="stl_06">Pulse: </span><span class="stl_12">&nbsp;{{$vital->pulse}}/min</span></div>
			<div class="stl_20"><span class="stl_06">Past Medical History: </span>
				<span class="stl_12"> 
					@if($diagnosis)
						{{$diagnosis->diagnosis}}
					@else
						Insignificant
					@endif
				</span></div>
			<div class="stl_21">
				<span class="stl_06">Family Medical History: </span>
				<span class="stl_12"> 
					@if($histories)
						{{$histories->history}}
					@else
						Insignificant
					@endif
				</span>
			</div>
			<div class="stl_22">
				<span class="stl_06">Cardiovascular System: </span>
				<span class="stl_12"> {{$vitals2->cardiovascular}}</span>
			</div>
			<div class="stl_23"><span class="stl_06">Respiratory System: </span>
				<span class="stl_12"> {{$vitals2->respiratory}}</span>
			</div>
			<div class="stl_24"><span class="stl_06">Allergies: </span>
				<span class="stl_12"> 
					@if($allergies)
						{{ $allergies->allergy }}
					@else
						Insignificant
					@endif
				</span>
			</div>
			<div class="stl_25"><span class="stl_06">Abdomen: </span>
				<span class="stl_12"> {{$vitals2->abdomen}}</span>
			</div>
			<div class="stl_26"><span class="stl_06">Random Blood Sugar: </span>
				<span class="stl_12"> {{$vitals2->blood_sugar}} mmol/L</span>
			</div>
			<div class="stl_27"><span class="stl_06">Stool: </span>
				<span class="stl_12"> {{$vitals2->stool}} </span>
			</div>
			<div class="stl_28"><span class="stl_06">Urine: </span>
				<span class="stl_12"> {{$vitals2->urine}} </span>
			</div>
			<div class="stl_29"><span class="stl_06">HIV I &amp; II: </span>
				<span class="stl_12"> {{$vitals2->hivI_II}}</span>
			</div>
			<div class="stl_30"><span class="stl_06">Full Haemogram: </span>
				<span class="stl_12"> {{$vitals2->haemoglobin}}</span>
			</div>
			<div class="stl_31"><span class="stl_06">Conclusion: </span>
				<span class="stl_12"> {{$vitals2->conclusion}}</span>
			</div>
			<div class="stl_32" style="padding-top: 38px;"><span class="stl_06">Name &amp; Designate:</span>
				<br><br>{{$vitals2->name_designate}}
			</div>
			<div class="stl_33"><span class="stl_06">Signature:</span></div>
			<div class="stl_34" style="padding-left: -80px;"><span class="stl_35">{{ $settings->name_of_institution }} - {{ $settings->tagline }} {{ $settings->postal_address}}. {{ $settings->location }}. </span></div>
			<div class="stl_36"><span class="stl_35">Telephone: {{ $settings->phone_no }} | Email: {{ $settings->email_address }}</span></div>
		</div>
	
</body></html>
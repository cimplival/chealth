<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE></TITLE>
	<META NAME="GENERATOR" CONTENT="LibreOffice 4.1.6.2 (Linux)">
	<META NAME="CREATED" CONTENT="20161221;182318902194956">
	<META NAME="CHANGED" CONTENT="20161222;20235188285390">
	<STYLE TYPE="text/css">
	<!--
		@page { margin: 0.79in }
		P { margin-bottom: 0.1in; line-height: 120% }
		TD P { margin-bottom: 0in }
		TH P { margin-bottom: 0in }
	-->
	</STYLE>
</HEAD>
<BODY LANG="en-US" DIR="LTR">
<P ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=5><B>{{$settings->name_of_institution}}</B></FONT></FONT></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=4><B>{{$report}}</B></FONT></FONT></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0in; font-weight: normal; line-height: 100%">
<FONT FACE="Times New Roman, serif"><FONT SIZE=3>Report Generated on: 
{{\Carbon\Carbon::now()->format('d/m/Y')}}</FONT></FONT></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0in; font-weight: normal; line-height: 100%">
<BR>
</P>
<TABLE STYLE="margin-left:-35px;" CELLPADDING=4 CELLSPACING=0>
	<TR VALIGN=TOP>
		<TH WIDTH=145 BGCOLOR="#dddddd" STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P>Name</P>
		</TH>
		<TH WIDTH=174 BGCOLOR="#dddddd" STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P>Activity</P>
		</TH>
		<TH WIDTH=97 BGCOLOR="#dddddd" STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P>Email</P>
		</TH>
		<TH WIDTH=85 BGCOLOR="#dddddd" STYLE="border: 1px solid #000000; padding: 0.04in">
			<P>Time</P>
		</TH>
	</TR>
	@if(count($activities)>0)
	@foreach($activities as $activity)
	<TR VALIGN=TOP>
		<TD WIDTH=145 STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in; text-align:center;">
			<P>{{ $activity->users->full_name }} ({{ $activity->users->staff_id }})
			</P>
		</TD>
		<TD WIDTH=174 STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=LEFT>{{ $activity->description }}
			</P>
		</TD>
		<TD WIDTH=97 STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in; text-align:center;">
			<P>{{ $activity->users->email }}
			</P>
		</TD>
		<TD WIDTH=85 STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0.04in; text-align:center;">
			<P>
			{{ Carbon\Carbon::parse($activity->created_at)->format('d/m/Y g:ia') }}
			</P>
		</TD>
	</TR>
	@endforeach
	@else
	<TR>
		<TD COLSPAN=4 WIDTH=452 STYLE="text-align:center;">
		<p>Sorry, there are no activity records of the selected date.</p>
		</TD>
	</TR>
	@endif

	@if(count($activities)>0)
	<TR VALIGN=TOP>
		<TD COLSPAN=3 WIDTH=452 STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0px; padding-right: 0in; text-align:center;">
			<P><FONT FACE="Times New Roman, serif"><FONT SIZE=3><B>Total no. of activity records</B></FONT></FONT></P>
		</TD>
		<TD WIDTH=85 STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0.04in; text-align:center;">
			<P>
				<strong>
				{{ count($activities) }}
				</strong>
			</P>
		</TD>
	</TR>
	@endif
</TABLE>
<P ALIGN=LEFT STYLE="margin-bottom: 0in; font-weight: normal; line-height: 100%">
<BR>
</P>
<DIV TYPE=FOOTER>
	<P ALIGN=CENTER STYLE="margin-top: 0.2in; margin-bottom: 0in; line-height: 100%">
	<FONT SIZE=1 STYLE="font-size: 8pt"><I>{{$settings->name_of_institution}}, {{ $settings->tagline }}. {{ $settings->postal_address}}. {{ $settings->location }}. <br>  Phone: {{ $settings->phone_no }}. Email: {{ $settings->email_address }}.</I></FONT></P>
</DIV>
</BODY>
</HTML>
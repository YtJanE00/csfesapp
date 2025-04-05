<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<style>
		.details-sm{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 11pt;
		}
		.styled-table {
			padding-left: 50px;
			padding-right: 20px;
		    border-collapse: collapse;
			font-family: Arial, Helvetica, sans-serif;
		    width: 100%;
		}

		.styled-table th,
		.styled-table td {
		    border: 1px solid black;
		    padding: 8px;
		    text-align: left;
		}

		.styled-table th {
		    background-color: #f2f2f2;
		}
		.details {			
			margin-left: 0px;
			font-size: 11pt;
		}
		.comment-lines hr {
	        border: none;
	        margin-top: 20px !important;
	        border-top: 1px solid #000;
	        padding-left: 50px;
			padding-right: 20px;
	    }

	    .comment-lines {
		    margin-top: 5px;
		}

		.line {
		    border-bottom: 1px solid black;
		    height: 20px; /* Adjust the height to match the lines in your image */
		    line-height: 20px;
		    margin-left: 50px !important;
			margin-right: 20px !important;
		}
	</style>
</head>
<body>
		@php
			$evaltitle = $surveyRatings->first()->title;
			$evalname = $surveyRatings->first()->name;
			$evaloffice = $surveyRatings->first()->office;
			$evalspeaker = $surveyRatings->first()->speaker;
			$evalcontact = $surveyRatings->first()->contact_information;
		@endphp

	<div align="center" style="margin-top: -20px !important;">
		<img src="{{ public_path('style/img/surveyheader2.png') }}" width="99%">
	</div>

	<div>
	<p class="details-sm" style="padding-left: 50px !important;">
			To help us improve our future trainings and activities, please spare us a moment to answer this survey.
		</p>

		<div class="details-sm" style="margin-top: 5px;">
			<span style="display: inline-block; width: 185px; vertical-align: top; padding-left: 50px;">Training/Workshop Title:</span>
			<div style="display: inline-block; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 495px; margin-left: -20px">
				<span>{{ $evaltitle }}</span>
			</div>
		</div>

		<div class="details-sm" style="margin-top: 5px;">
			<span style="display: inline-block; width: 100px; vertical-align: top; padding-left: 50px;">Speaker/s :</span>
			<div style="display: inline-block; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 480px; margin-left: -20px">
				<span>{{ $evalspeaker }}</span>
			</div>
		</div>

		<div class="details-sm" style="margin-top: 5px;">
			<span style="display: inline-block; width: 60px; vertical-align: top; padding-left: 50px;">Date:</span>
			<div style="display: inline-block; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 520px; margin-left: -20px">
				<span>{{ $surveyRatings->first()->training_month }} {{ $surveyRatings->first()->training_day }}, {{ $surveyRatings->first()->training_year }}</span>
			</div>
		</div>

		<div class="details-sm" style="margin-top: 5px;">
			<span style="display: inline-block; width: 70px; vertical-align: top; padding-left: 50px;">Venue: </span>
			<div style="display: inline-block; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 510px; margin-left: -20px">
				<span>{{ $surveyRatings->first()->training_venue }}</span>
			</div>
		</div>

		<p class="details-sm" style="padding-left: 50px !important; margin-top: -10px; font-weight: bold; margin-top: 10px">
			Please evaluate the following items by encircling the rating values following the legend below:
		</p>
		<p  class="details-sm" style="padding-left: 70px !important; ">
			(1)&nbsp;&nbsp;Poor &nbsp;&nbsp;&nbsp;&nbsp;
            (2)&nbsp;&nbsp;Unsatisfactory &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            (3)&nbsp;&nbsp;Satisfactory &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            (4)&nbsp;&nbsp;Very Satisfactory &nbsp;&nbsp;
            (5)&nbsp;&nbsp;Outstanding
		</p>
	</div>

	<div>
		<table class="styled-table">
			<thead>
				<tr>
					<th><strong><center>Areas for Evaluation</center></strong></th>
					<th><center>Rate</center></th>
				</tr>
			</thead>
			<tbody>
				@php 
					$no=1; 
					$sectionTotal = 0;
				@endphp
				@foreach($formtitle as $pdfdata)
					@php
						$savedRatings = json_decode($surveyRatings->first()->question_rate ?? '{}', true);
						$savedRating = $savedRatings[$pdfdata->id] ?? null;

						// Total score for the current question
						// if ($savedRating) {
						// 	$sectionTotal += $savedRating;
						// }
					@endphp
				<tr>
					<td>{{ $no++ }}. {{ $pdfdata->question }}</td>
					<td style="text-align: center;">
						<div style="display: flex; justify-content: space-evenly; align-items: center; width: 100%; gap: 80px;">
							@for ($i = 1; $i <= 5; $i++)
								{{-- <span style="font-size: 16px;">{{ $i }}</span> --}}
								@if ($savedRating == $i)
									<img src="{{ public_path('style/img/rate/' . $i . '.png') }}" alt="{{ $i }}" width="20">
								@else
									{{ $i }}
								@endif
							@endfor
						</div>
					</td>					
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div>
		<br>
		<p class="details-sm" style="padding-left: 50px !important;">
			What particular aspect of this training do you think needs improvement?
			<br>
			Please identify if there is any: 
			<div class="comment-lines">
		        @php
		            $comments = explode("\n", wordwrap($surveyRatings->first()->feedback ?? '', 500, "\n", true));
		        @endphp
		        @for($i = 0; $i < 2; $i++)
		            <div class="line">
		                {{ isset($comments[$i]) ? $comments[$i] : '' }}
		            </div>
		        @endfor
		    </div>
		</p>
		<p class="details-sm" style="padding-left: 50px !important;">
			Indicate the topics which you would need for future trainings or workshops.
			<div class="comment-lines">
		        @php
		            $comments = explode("\n", wordwrap($surveyRatings->first()->feedback2 ?? '', 500, "\n", true));
		        @endphp
		        @for($i = 0; $i < 2; $i++)
		            <div class="line">
		                {{ isset($comments[$i]) ? $comments[$i] : '' }}
		            </div>
		        @endfor
		    </div>
		</p>
		<br>
		<br>
		<p class="details-sm" style="padding-left: 50px !important; margin-top: 5px; font-weight: bold;">
			Contact Information: </p>

		<div class="details-sm" style="margin-left: 50px !important;">
			<span style="display: inline-block; width: 50px; vertical-align: top; margin-left: 50px !important;">Name:</span>
			<div style="display: inline-block; margin-left: -5px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 560px;">
				<span>{{ $evalname }}</span>
			</div>
		</div>

		<div class="details-sm" style="margin-left: 50px !important; margin-top: 2px">
			<span style="display: inline-block; width: 50px; vertical-align: top; margin-left: 50px !important;">Office:</span>
			<div style="display: inline-block; margin-left: -5px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 560px;">
				<span>{{ $evaloffice }}</span>
			</div>
		</div>

		<div class="details-sm" style="margin-left: 50px !important; margin-top: 2px">
			<span style="display: inline-block; width: 330px; vertical-align: top; margin-left: 50px !important;">Contact Information (Landline/Cp/Email Address):</span>
			<div style="display: inline-block; margin-left: -5px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 280px;">
				<span>{{ $evalcontact }}</span>
			</div>
		</div>

		<div class="details-sm" style="margin-left: 50px !important;">
			<span style="margin-left: 50px !important;">Signature: ________________________________&nbsp;&nbsp; Date:____________________________</span>
		</div>
 	</div>
 	<div style="position: fixed; bottom: -30px; left: 0; width: 100%; text-align: center; margin-bottom: 5px;">
		<img src="{{ public_path('style/img/surveyfooter2.png') }}" width="80%">
	</div>
</body>
</html>
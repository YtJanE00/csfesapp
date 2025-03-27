<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<style>
		.styled-table {
			padding-left: 50px;
			padding-right: 50px;
		    border-collapse: collapse;
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

	</style>
</head>
<body>
	<div align="center" style="margin-top: -20px !important;">
		<img src="{{ public_path('style/img/surveyheader2.png') }}" width="99%">
	</div>

	<div>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important;">
			To help us improve our future trainings and activities, please spare us a moment to answer this survey.
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important;">
			Training/Workshop Title: <u>{{ $formtitleID->title }}</u>
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important;">
			Office handling the training: <u>{{ $formtitleID->office }}</u>
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important; margin-top: -10px;">
			Speaker/s: <u>{{ $formtitleID->speaker }}</u>
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important; margin-top: -10px;">
    	Date: <u>{{ $formtitleID->training_month }} {{ $formtitleID->training_day }}, {{ $formtitleID->training_year }}</u>
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important; margin-top: -10px;">
			Venue: <u>{{ $formtitleID->training_venue }}</u>
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important; margin-top: -10px; font-weight: bold;">
			Please evaluate the following items by encircling the rating values following the legend below:
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 70px !important; ">
			(1)&nbsp;&nbsp;Poor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            (2)&nbsp;&nbsp;Unsatisfactory &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            (3)&nbsp;&nbsp;Satisfactory &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            (4)&nbsp;&nbsp;Very Satisfactory &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            (5)&nbsp;&nbsp;Outstanding
		</p>
	</div>

	<div>
		<table class="styled-table">
			<thead>
				<tr>
					<th><strong> Areas for Evaluation</strong></th>
					<th>Rate</th>
				</tr>
			</thead>
			<tbody>
				@php $no=1; @endphp
				@foreach($formtitle as $pdfdata)
				<tr>
					<td>{{ $no++ }}. {{ $pdfdata->question }}</td>
					<td style="text-align: center;">
						<div style="display: flex; justify-content: space-evenly; align-items: center; width: 100%; gap: 80px;">
							@for ($i = 1; $i <= 5; $i++)
								<span style="font-size: 16px;">{{ $i }}</span>
							@endfor
						</div>
					</td>					
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important;">
			What particular aspect of this training do you think needs improvement?
Please identify if there is any: ___
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important;">
			Indicate the topics which you would need for future trainings or workshops. ___
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important; margin-top: 5px; font-weight: bold;">
			Contact Information: </p>

		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important;">
			Name: 
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important;">
			Office:
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important;">
			Contact Information (Landline/CP/Email Address):
		</p>
		<p style="font-family: Arial; font-size: 10pt; padding-left: 50px !important;">
			Signature: _____________________&nbsp;&nbsp; Date:_____________________
            
		</p>
 	</div>

	<div style="position: fixed; bottom: 0; left: 0; width: 100%; text-align: center; margin-bottom: 10px;">
		<img src="{{ public_path('style/img/surveyfooter2.png') }}" width="60%">
	</div>
</body>
</html>
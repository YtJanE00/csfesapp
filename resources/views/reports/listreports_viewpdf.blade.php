<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey Report</title>

    <style>
        body {
            font-size: 10pt !important;
            font-family: Arial, Helvetica, sans-serif;
        }
        .styled-table {
            margin-top: 2rem;
            border-collapse: collapse;
            width: 100%;
            border: 1px solid black; /* Ensure full table border */
        }

        .styled-table th,
        .styled-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            border-right: 1px solid black; /* Ensure right-side border */
        }

        .styled-table th {
            background-color: yellow;
        }

        .parent-div {
            width: 100%;
        }

        .parent-div.pdf-title {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 4rem;
        }

        .title-box {
            width: auto;
            text-align: center;
            font-size: .7rem;
            border: 1px solid #727171;
            margin: 1rem 0;
        }

        .total, .mean {
            font-weight: bold;
            background-color: white;
            color: black;
            border: 1px solid black; /* Ensure border is visible */
        }

        .styled-table .text-color {
            background-color: red;
        }
    </style>
</head>
<body>
    <div align="center" style="margin-top: -20px !important;">
        <img src="{{ public_path('style/img/resultheader.png') }}" width="100%" height="140px">
    </div>

    <div class="parent-div">
        <div class="pdf-title">
            <div class="title-box">
                <h1>Title: {{ $pdfreportformtitleID->title }}</h1>
            </div>
        </div>

        @php
            $userCount = isset($reportformtitle) ? $reportformtitle->count() : 0;
            $columnTotals = [];
            $columnCounts = [];
            $grandTotal = 0; // Initialize grand total for TOTAL column

            if (isset($pdfreportformtitlequestion)) {
                $firstRates = json_decode($pdfreportformtitlequestion->question, true);
                $answer = json_decode($pdfreportformtitlequestion->question_rate, true);
                $flattenedArray = is_array($answer) ? $answer : [];
            } else {
                $firstRates = null;
                $flattenedArray = [];
            }
        @endphp

        <div class="questions">
            @foreach($getQuestion as $quesCount => $questions)
                <b>({{ $quesCount + 1 }})</b> {{ $questions->question }}
            @endforeach
        </div>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>#</th>
                    @if(isset($pdfreportformtitlequestion))
                        @php
                            $firstRates = json_decode($pdfreportformtitlequestion->question_rate, true);
                            $questionIndex = 1;
                        @endphp
                        @if(is_array($firstRates))
                            @foreach($firstRates as $index => $value)
                                <th>{{ $questionIndex }}</th>
                                @php
                                    $columnTotals[$index] = 0;
                                    $columnCounts[$index] = 0;
                                    $questionIndex++;
                                @endphp
                            @endforeach
                            <th class="total text-color">TOTAL</th>
                            <th class="mean text-color">MEAN</th>
                        @endif
                    @endif
                </tr>
            </thead>

            @php
                $sumOfRowMeans = 0;
                $totalRowCount = 0;
            @endphp

            <tbody>
                @php 
                    $row = 1; 
                @endphp
                @foreach ($getRate as $rate)
                    <tr>
                        <td>{{ $row }}</td>
                        @php
                            $answer = json_decode($rate->question_rate, true);
                            if (!is_array($answer)) $answer = [];

                            $rowTotal = array_sum($answer);
                            $rowMean = count($answer) ? $rowTotal / count($answer) : 0;

                            $grandTotal += $rowTotal;
                            $sumOfRowMeans += $rowMean;
                            $totalRowCount++;
                        @endphp
                        @foreach ($answer as $index => $value)
                            <td>{{ htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}</td>
                            @php
                                $columnTotals[$index] += $value;
                                $columnCounts[$index]++;
                            @endphp
                        @endforeach
                        <td class="total">{{ $rowTotal }}</td>
                        <td class="mean">{{ number_format($rowMean, 1) }}</td>
                    </tr>
                    @php $row++; @endphp
                @endforeach

                @php
                    // Compute final mean
                    $finalMean =+ number_format($rowMean, 1);

                    // Determine the interpretation
                    if ($finalMean >= 4.21) {
                        $interpretation = "Outstanding";
                    } elseif ($finalMean >= 3.41) {
                        $interpretation = "Very Satisfactory";
                    } elseif ($finalMean >= 2.51) {
                        $interpretation = "Satisfactory";
                    } elseif ($finalMean >= 1.81) {
                        $interpretation = "Poor";
                    } else {
                        $interpretation = "Needs Improvement";
                    }

                @endphp

               <!-- Total Row -->
                <tr class="total" style="background-color: green;">
                    <td style="background-color: green;"><strong></strong></td>
                    @foreach ($columnTotals as $total)
                        <td><strong>{{ $total }}</strong></td>
                    @endforeach
                    <td style="background-color: green;"><strong>{{ number_format($grandTotal) }}</strong></td>

                    <!-- Corrected: Display sum of right-side means -->
                    <td class="mean" style="background-color: green;">
                        <strong>{{ number_format($sumOfRowMeans / $totalRowCount, 2) }}</strong>
                    </td>
                </tr>


                <!-- Column Mean Row -->
                <tr class="mean">
                    <td style="background-color: yellow;"><strong></strong></td>
                    @php
                        $sumOfColumnMeans = 0;
                        foreach ($columnTotals as $index => $total) {
                            $mean = $columnCounts[$index] > 0 ? $total / $columnCounts[$index] : 0;
                            $sumOfColumnMeans += $mean;
                    @endphp
                        <td style="background-color: yellow"><strong></strong></td>
                    @php } @endphp

                    <td class="mean" style="background-color: yellow;"><strong></strong></td>
                    <td class="mean" style="background-color: yellow"><strong>{{ $interpretation }}</strong></td>
                </tr>
                  <!-- Rating Interpretation Row -->
                <tr>
                    <th colspan="3" style="background-color: white;">Rating Range</th>
                    <th colspan="4" style="background-color: white;">Interpretation</th>
                    <th colspan="3" style="background-color: white;">Frequency</th>
                    <th colspan="3" style="background-color: white;">Percentage</th>
                </tr>
                <tr>
                    <td style="padding: 1px" colspan="3">4.21 - 5.00</td>
                    <td style="padding: 1px" colspan="4">Outstanding</td>
                    <td style="padding: 1px" colspan="3">{{ $totalRowCount }}</td>
                    <td style="padding: 1px" colspan="3">100%</td>
                </tr>
                <tr>
                    <td style="padding: 1px" colspan="3">3.41 - 4.20</td>
                    <td style="padding: 1px" colspan="4">Very Satisfactory</td>
                    <td style="padding: 1px" colspan="3"></td>
                    <td style="padding: 1px" colspan="3"></td>
                </tr>
                <tr>
                    <td style="padding: 1px" colspan="3">2.61 - 3.40</td>
                    <td style="padding: 1px" colspan="4">Satisfactory</td>
                    <td style="padding: 1px" colspan="3"></td>
                    <td style="padding: 1px" colspan="3"></td>
                </tr>
                <tr>
                    <td style="padding: 1px" colspan="3">1.81 - 2.60</td>
                    <td style="padding: 1px" colspan="4">Poor</td>
                    <td style="padding: 1px" colspan="3"></td>
                    <td style="padding: 1px" colspan="3"></td>
                </tr>
                <tr>
                    <td style="padding: 1px" colspan="3">1.00 - 1.80</td>
                    <td style="padding: 1px" colspan="4">Needs Improvement</td>
                    <td style="padding: 1px" colspan="3"></td>
                    <td style="padding: 1px" colspan="3"></td>
                </tr>
                <tr>
                    <td style="padding: 1px" colspan="3"><b>Total</b></td>
                    <td style="padding: 1px" colspan="4"></td>
                    <td style="padding: 1px" colspan="3"><b>{{ $totalRowCount }}</b></td>
                    <td style="padding: 1px" colspan="3"><b>100%</b></td>
                </tr>
            </tbody>
        </table>

        <br><br>
    </div>

    <div>
        @php
            $coordinator = Auth::guard('web')->user()->fname . ' ' . Auth::guard('web')->user()->mname.'.' .' '.  Auth::guard('web')->user()->lname;

            $dean = $coordinatordean->first()->sfname .' '. $coordinatordean->first()->smname .'.' .' '. $coordinatordean->first()->slname;
            $rank = $coordinatordean->first()->srank;

            $deanpos = $coordinatordean->first()->srole;
            $deandept = $coordinatordean->first()->sdept;
            $deandeptFormatted = ucwords(strtolower($deandept), " \t\r\n\f\v");
            $deandeptFormatted = preg_replace('/\bOf\b/i', 'of', $deandeptFormatted);

            $sigdirector = $director->first()->dfname .' '. $director->first()->dmname .'.' .' '. $director->first()->dlname;
            $sigdirectorrank = $director->first()->drank;
            $sigdirectorrole = $director->first()->drole;
        @endphp
        
        <p class="details-sm" style="padding-left: 0px !important; margin-top: 5px;">
			Prepared by: </p>

		<div class="details-sm" style="margin-left: 50px !important;">
            <span style="display: inline-block; width: 190px; vertical-align: top; margin-left: 50px !important; font-weight: bold; text-transform: uppercase">
                {{ strtoupper($coordinator) }}
            </span><br>
            <span style="display: inline-block; width: 190px; vertical-align: top; margin-left: 50px !important;">
                {{ $coordinatorposition }}, Extension Coordinator
            </span>
		</div>

        <br>

        <p class="details-sm" style="padding-left: 0px !important; margin-top: 5px;">
			Noted by: </p>

		<div class="details-sm" style="margin-left: 50px !important;">
            <span style="display: inline-block; width: 190px; vertical-align: top; margin-left: 50px !important; font-weight: bold">
                {{ strtoupper($dean) }}, {{ $rank }} 
            </span><br>
            <span style="display: inline-block; width: 290px; vertical-align: top; margin-left: 50px !important;">
                {{ strtoupper($deanpos) }}, {{ $deandeptFormatted  }}
            </span>
		</div>

        <br>

        <p class="details-sm" style="padding-left: 0px !important; margin-top: 5px;">
			Approved by: </p>

		<div class="details-sm" style="margin-left: 50px !important;">
            <span style="display: inline-block; width: 190px; vertical-align: top; margin-left: 50px !important; font-weight: bold;">
                {{ strtoupper($sigdirector) }}, {{ $sigdirectorrank }}
            </span><br>
            <span style="display: inline-block; width: 290px; vertical-align: top; margin-left: 50px !important;">
                {{ $sigdirectorrole }}
            </span>
		</div>
    </div>

</body>
</html>

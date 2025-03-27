<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey Report</title>

    <style>
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
        <img src="{{ public_path('style/img/resultheader.png') }}" width="100%" height="90px">
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
                @php $row = 1; @endphp
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

               <!-- Total Row -->
<tr class="total" style="background-color: green;">
    <td style="background-color: white;"><strong></strong></td>
    @foreach ($columnTotals as $total)
        <td><strong>{{ $total }}</strong></td>
    @endforeach
    <td style="background-color: green;"><strong></strong></td>

    <!-- Corrected: Display sum of right-side means -->
    <td class="mean" style="background-color: green;">
        <strong>{{ number_format($sumOfRowMeans, 1) }}</strong>
    </td>
</tr>


                <!-- Column Mean Row -->
                <tr class="mean">
                    <td style="background-color: white;"><strong></strong></td>
                    @php
                        $sumOfColumnMeans = 0;
                        foreach ($columnTotals as $index => $total) {
                            $mean = $columnCounts[$index] > 0 ? $total / $columnCounts[$index] : 0;
                            $sumOfColumnMeans += $mean;
                    @endphp
                        <td style="background-color: yellow"><strong>{{ number_format($mean, 1) }}</strong></td>
                    @php } @endphp

                    <td class="mean" style="background-color: yellow;"><strong></strong></td>
                    <td class="mean" style="background-color: yellow"><strong>{{ number_format($sumOfRowMeans / $totalRowCount, 1) }}</strong></td>
                </tr>
                  <!-- Rating Interpretation Row -->
                <tr>
                    <th colspan="7" style="background-color: white;">Rating Range</th>
                    <th colspan="{{ count($columnTotals) + 2 }}" style="background-color: white;">Interpretation</th>
                </tr>
                <tr>
                    <td colspan="7">4.21 - 5.00</td>
                    <td colspan="{{ count($columnTotals) + 2 }}">Outstanding</td>
                </tr>
                <tr>
                    <td colspan="7">3.41 - 4.20</td>
                    <td colspan="{{ count($columnTotals) + 2 }}">Very Satisfactory</td>
                </tr>
                <tr>
                    <td colspan="7">2.51 - 3.40</td>
                    <td colspan="{{ count($columnTotals) + 2 }}">Satisfactory</td>
                </tr>
                <tr>
                    <td colspan="7">1.81 - 2.50</td>
                    <td colspan="{{ count($columnTotals) + 2 }}">Poor</td>
                </tr>
                <tr>
                    <td colspan="7">1.00 - 1.80</td>
                    <td colspan="{{ count($columnTotals) + 2 }}">Needs Improvement</td>
                </tr>
            </tbody>
        </table>

        <br><br>
    </div>

    @php
        // Compute final mean
        $finalMean = ($totalRowCount > 0) ? $sumOfRowMeans / $totalRowCount : 0;

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

    <p style="color: black;"><strong>Mean = </strong> {{ number_format($finalMean, 2) }} ,  {{ $interpretation }}</p>
  

</body>
</html>

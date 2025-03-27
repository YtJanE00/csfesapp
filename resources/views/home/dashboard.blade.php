@extends('layout.master_layout')

@section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>
             </div>
         </div>
     </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session ('success'))
                        <div class="alert alert-success" style="font-size: 10pt;">
                            <i class="fas fa-check"></i> {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-7">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $training_title }}</h3>
                            <p>Total Trainings</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-solid fa-bars-progress"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-7">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                             <h3>{{ $currentYearTrainings }}</h3>
                            <p>Current Year Trainings</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-solid fa-bars-progress"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-7">
                    <div class="small-box bg-warning">
                        <div class="inner">
                             <h3>{{ $currentMonthTrainings }}</h3>
                            <p>Current Month Trainings</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-solid fa-bars-progress"></i>
                        </div>
                    </div>
                </div>
                
               
                <div class="col-lg-3 col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="calendar-header">
                                <button id="prevMonth">&lt;</button>
                                <span id="calendarMonth"></span>
                                <button id="nextMonth">&gt;</button>
                            </div>
                            <div class="calendar-days">
                                <div>Su</div> <div>Mo</div> <div>Tu</div> <div>We</div> <div>Th</div> <div>Fr</div> <div>Sa</div>
                            </div>
                            <div class="calendar-dates" id="calendarDates"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .calendar-days, .calendar-dates {
        
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
    }

    .calendar-days div {
        font-weight: bold;
    }

    .date, .empty {
        padding: 10px;
        
    }

    .date, .today {
    padding: 10px;

    display: inline-block; /* Ensures numbers align properly */
    width: auto; /* Prevents forced circular shape */
    height: auto; /* Ensures it only fits the content */
    text-align: center;
}

.today {
    background-color: yellow;
    font-weight: bold;
}

</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const calendarMonth = document.getElementById("calendarMonth");
        const calendarDates = document.getElementById("calendarDates");
        const prevMonthBtn = document.getElementById("prevMonth");
        const nextMonthBtn = document.getElementById("nextMonth");

        let currentDate = new Date();

        function renderCalendar() {
            calendarDates.innerHTML = ""; // Clear previous dates

            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();

            calendarMonth.textContent = new Intl.DateTimeFormat("en-US", {
                month: "long",
                year: "numeric",
            }).format(currentDate);

            // Fill empty spaces before the first day
            for (let i = 0; i < firstDay; i++) {
                let emptyDiv = document.createElement("div");
                emptyDiv.classList.add("empty");
                calendarDates.appendChild(emptyDiv);
            }

            // Fill the calendar with actual dates
            for (let day = 1; day <= lastDate; day++) {
                let dateDiv = document.createElement("div");
                dateDiv.textContent = day;
                dateDiv.classList.add("date");

                // Highlight today's date
                let today = new Date();
                if (
                    day === today.getDate() &&
                    month === today.getMonth() &&
                    year === today.getFullYear()
                ) {
                    dateDiv.classList.add("today");
                }

                calendarDates.appendChild(dateDiv);
            }
        }

        prevMonthBtn.addEventListener("click", function () {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonthBtn.addEventListener("click", function () {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        renderCalendar();
    });
</script>

@endsection
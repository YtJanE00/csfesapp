<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }} ">
    <title>CSFES | Dashboard</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('style/plugins/fontawesome-free-V6/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('style/dist/css/adminlte.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('style/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('style/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Logo -->
    <link rel="shortcut icon" href="{{ asset('style/img/logo.png') }}">

    <style> 
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, 
        .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
            background-color: #1f5036 !important;
            color: #ffffff;
        }
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link, 
        .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link {
            color: #5e5e5e;
        }
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link i, 
        .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link i {
            color: #5e5e5e;
        }
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link i, 
        .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active i {
            color: #ffffff;
        }
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link:hover, 
        .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link:hover,
        .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link:hover i {
            background-color: #1f5036 !important;
            color: #ffffff;
        }
        .calendar-container {
            border-radius: 10px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
        }
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
            padding: 10px 0;
        }
        .calendar-header button {
            border: none;
            background: none;
            font-size: 20px;
            cursor: pointer;
        }
        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-weight: bold;
            color: #888;
            margin-bottom: 10px;
        }
        .calendar-dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-size: 16px;
        }
        .calendar-dates div {
            padding: 6px;
            cursor: pointer;
            border-radius: 50%;
        }
        .calendar-dates .today {
            background: #1f5036;
            color: white;
            font-weight: bold;
        }
        .calendar-dates .event {
            border: 2px solid #007bff;
            color: #007bff;
            font-weight: bold;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #ffffff;
            border-color: #28a745;
            color: #000000;
            /* font-size: 9pt; */
            font-weight: bold
            padding: 0 10px;
            margin-top: .31rem;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #1f5036;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: rgb(255, 255, 255) !important"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link text-light" role="button">
                        <i class="fas fa-power-off" style="color: rgb(255, 255, 255) !important"></i> Sign Out
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary" style= "background-color:#ffffff !important">
             <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                @include ('control.sidebar') 
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        @yield('body')
        
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Customer Satisfaction Feedback and Evaluation System
            </div>
            <strong>Developed By: BSIT 4-C .</strong> Capstone.
        </footer>
    </div>

    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('style/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('style/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('style/dist/js/adminlte.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('style/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('style/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('style/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('style/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('style/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('style/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- jquery-validation -->
    <script src="{{ asset('style/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('style/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('style/js/validation/addtitleValidation.js') }}"></script>

    @if (request()->routeIs('surveyformRead'))
        <script>
            let currentCard = 1;
            const totalCards = document.querySelectorAll('[id^="card-"]').length;

            $(document).ready(function () {
                function checkInputs(cardId, buttonId) {
                    let allFilled = true;

                    if ($(cardId + ' input[type="radio"]').length > 0) {
                        $(cardId + ' .radio-group').each(function () {
                            let radioGroupName = $(this).find('input[type="radio"]').attr('name');
                            if ($(`input[name="${radioGroupName}"]:checked`).length === 0) {
                                allFilled = false;
                                return false;
                            }
                        });
                    } else {
                        $(cardId + ' .required-input').each(function () {
                            if ($(this).val().trim() === '') {
                                allFilled = false;
                                return false;
                            }
                        });
                    }

                    $(buttonId).prop('disabled', !allFilled);
                }

                $('#card-1 .required-input').on('input change', function () {
                    checkInputs('#card-1', '#next-btn');
                });

                $('#card-2 input[type="radio"]').on('change', function () {
                    checkInputs('#card-2', '#submit-btn');
                });

                checkInputs('#card-1', '#next-btn');
                checkInputs('#card-2', '#submit-btn');

                updateProgressBar();
            });
        </script>
    @endif

    <script>
         $(function () {
            $("#example1").DataTable({
              "responsive": true,
              "lengthChange": true, 
              "autoWidth": false,
              //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
         $('#example2').DataTable({
             "paging": true,
             "lengthChange": false,
             "searching": false,
             "ordering": true,
             "info": true,
             "autoWidth": false,
             "responsive": true,
            });
        });
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            height: '100'
        })
    </script>

    @if (request()->routeIs('surveyformRead'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const calendarDates = document.getElementById("calendarDates");
                const calendarMonth = document.getElementById("calendarMonth");
                const prevMonthBtn = document.getElementById("prevMonth");
                const nextMonthBtn = document.getElementById("nextMonth");

                let currentDate = new Date();

                // Sample highlighted event dates (Adjust as needed)
                let events = [
                    new Date(2024, 3, 3),  // April 3 (Highlighted)
                    new Date(2024, 3, 14), // April 14 (Red)
                    new Date(2024, 3, 25)  // April 25 (Blue)
                ];

                function renderCalendar() {
                    let firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                    let lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
                    let firstDayIndex = firstDay.getDay();
                    let lastDate = lastDay.getDate();

                    calendarMonth.textContent = currentDate.toLocaleString("default", { month: "long", year: "numeric" });
                    calendarDates.innerHTML = "";

                    // Fill empty slots before first day
                    for (let i = 0; i < firstDayIndex; i++) {
                        let emptyCell = document.createElement("div");
                        calendarDates.appendChild(emptyCell);
                    }

                    // Populate dates
                    for (let i = 1; i <= lastDate; i++) {
                        let dateCell = document.createElement("div");
                        dateCell.textContent = i;
                        let thisDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);

                        // Highlight today
                        let today = new Date();
                        if (thisDate.toDateString() === today.toDateString()) {
                            dateCell.classList.add("today");
                        }

                        // Highlight event dates
                        events.forEach(eventDate => {
                            if (eventDate.toDateString() === thisDate.toDateString()) {
                                dateCell.classList.add("event");
                            }
                        });

                        calendarDates.appendChild(dateCell);
                    }
                }

                prevMonthBtn.addEventListener("click", function() {
                    currentDate.setMonth(currentDate.getMonth() - 1);
                    renderCalendar();
                });

                nextMonthBtn.addEventListener("click", function() {
                    currentDate.setMonth(currentDate.getMonth() + 1);
                    renderCalendar();
                });

                renderCalendar(); // Initial render
            });
        </script>
    @endif

    @if (request()->routeIs('formQuestion'))
        <script>
            $(document).ready(function() {
            // Open Edit Modal and Populate Data
            $('.editBtn').click(function() {
                var id = $(this).data('id');
                var question = $(this).data('question');
        
                $('#edit_question_id').val(id);
                $('#edit_question_text').val(question);
                $('#editQuestionModal').modal('show');
            });
        
            // Handle Form Submission for Editing
            $('#editQuestionForm').submit(function(e) {
                e.preventDefault();
                var id = $('#edit_question_id').val();
                var question = $('#edit_question_text').val();
                var _token = $('input[name="_token"]').val();
        
                $.ajax({
                    url: "{{ route('updateQuestion', ':id') }}".replace(':id', id),
                    type: "POST",
                    data: {
                        _token: _token,
                        question: question,
                    },
                    success: function(response) {
                        $('#editQuestionModal').modal('hide');
                        location.reload(); // Refresh table to show updates
                    },
                    error: function(xhr) {
                        alert("Something went wrong!");
                    }
                });
            });
        });
        </script>
    @endif
</body>
</html>
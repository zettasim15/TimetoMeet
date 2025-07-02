<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Tugas & Kalender</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FullCalendar & jQuery -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
        }
        .btn {
            padding: 0.5rem 1rem;
            margin-right: 0.5rem;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-success { background-color: #38a169; color: white; }
        .btn-danger { background-color: #e53e3e; color: white; }
        .btn-secondary { background-color: #718096; color: white; }
    </style>
</head>
<body class="bg-gray-100">
<div class="sidebar">
    <div class="logo_details">
        <img src="{{ asset('meetingsreminder.png') }}" alt="logo_icon">
        <div class="logo_name">TimetoMeet</div>
        <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav-list">
        <li>
            <i class="bx bx-search"></i>
            <input type="text" placeholder="Search...">
            <span class="tooltip">Search</span>
        </li>
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="bx bxs-home"></i>
                <span class="link_name">Home</span>
            </a>
            <span class="tooltip">Home</span>
        </li>
        <li>
            <a href="{{ route('schedule.index') }}">
                <i class="bx bxs-calendar-check"></i>
                <span class="link_name">Schedule</span>
            </a>
            <span class="tooltip">Schedule</span>
        </li>
        <li>
            <a href="{{ route('group.index') }}">
                <i class="bx bxs-group"></i>
                <span class="link_name">Teams</span>
            </a>
            <span class="tooltip">Teams</span>
        </li>
        <li>
            <a href="{{ route('attendance.index') }}">
                <i class='bx bx-user-check'></i>
                <span class="link_name">Attendance</span>
            </a>
            <span class="tooltip">Attendance</span>
        </li>
        <li>
            <a href="{{ route('task.index') }}">
                <i class='bx bx-task-x'></i>
                <span class="link_name">Tasks</span>
            </a>
            <span class="tooltip">Tasks</span>
        </li>
        <li>
            <a href="{{ route('history.index') }}">
                <i class="bx bx-history"></i>
                <span class="link_name">History</span>
            </a>
        </li>
        <li class="profile">
            <div class="profile_details">
                <img src="{{ asset('storage/profile_images/' . $profile_image) }}" alt="profile image">
                <div class="profile_content">
                    <div class="name">{{ $user->display_username }}</div>
                    <div class="designation">{{ $user->role }}</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" id="log_out" class="bx bx-log-out"></button>
            </form>
        </li>
    </ul>
</div>

<main class="ml-64 p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div id="calendar" class="bg-white rounded-lg shadow-md p-4"></div>
    <div class="bg-white rounded-lg shadow-md p-4 w-full">
        <div class="flex items-center justify-between mb-4">
            <select class="border p-1 rounded text-sm"><option>Next 7 days</option><option>Today</option></select>
            <select class="border p-1 rounded text-sm"><option>Sort by dates</option><option>Sort by name</option></select>
            <input type="text" placeholder="Search by task or name" class="border p-1 rounded text-sm w-1/3">
        </div>
        <table class="w-full text-sm border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2 border-b">Tanggal</th>
                    <th class="p-2 border-b">Tugas</th>
                    <th class="p-2 border-b">Deskripsi</th>
                    <th class="p-2 border-b">Waktu</th>
                    <th class="p-2 border-b">Status</th>
                    <th class="p-2 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="{{ $task->deadline < now() ? 'bg-red-50 border-l-4 border-red-500' : '' }}">
                        <td class="p-2">{{ \Carbon\Carbon::parse($task->deadline)->format('l, j F Y') }}</td>
                        <td class="p-2 font-semibold">{{ $task->nama }}</td>
                        <td class="p-2 text-gray-600">{{ $task->deskripsi }}</td>
                        <td class="p-2 text-xs text-gray-500">20:00</td>
                        <td class="p-2">
                            <span class="text-xs px-2 py-0.5 rounded 
                                {{ $task->status === 'Selesai' ? 'bg-green-500 text-white' :
                                   ($task->deadline < now() ? 'bg-red-500 text-white' : 'bg-yellow-500 text-white') }}">
                                {{ $task->status }}
                            </span>
                        </td>
                        <td class="p-2">
                            <a href="{{ route('task.submit', $task->id) }}" class="text-blue-600 border border-blue-600 px-2 py-1 rounded hover:bg-blue-50">
                                Add submission
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button class="mt-4 text-blue-600 hover:underline text-sm">Show more activities</button>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: '{{ route('schedule.load') }}',
            eventClick: function(event) {
                $('#schedule-description').text(event.description || '(tidak ada deskripsi)');
                $('#accept-schedule').attr('data-schedule-id', event.id);
                $('#reject-schedule').attr('data-schedule-id', event.id);
                $('#schedule-modal').show();
            }
        });

        $('#accept-schedule').click(function() {
            var id = $(this).data('schedule-id');
            $.post('{{ route('schedule.accept') }}', { schedule_id: id, action: 'accept' }, function(res) {
                $('#schedule-modal').hide();
                location.reload();
            });
        });

        $('#reject-schedule').click(function() {
            var id = $(this).data('schedule-id');
            $.post('{{ route('schedule.reject') }}', { schedule_id: id, action: 'reject' }, function(res) {
                $('#schedule-modal').hide();
                location.reload();
            });
        });

        $('#close-modal').click(function() {
            $('#schedule-modal').hide();
        });
    });
</script>
</body>
</html>

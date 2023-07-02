<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-left"> <!-- Added 'text-left' class -->
                <table id="users-table" class="min-w-full table">
                    <thead>
                        <tr>
                            <th class="py-2">ID</th>
                            <th class="py-2">Profile<br>Picture</th>
                            <th class="py-2">Name</th>
                            <th class="py-2">Email</th>
                            <th class="py-2">Password</th>
                            <th class="py-2">Role</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-4 py-2">{{ $user->id }}</td>
                                <td class="px-4 py-2">   @if ($user->profile_picture)
                                        <div class="mt-4">
                                            <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="Comment Image" height="10" width="100">
                                        </div>
                                    @else
                                        <p>No image available</p>
                                    @endif</td>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">{{  Str::limit($user->password, 10) }}</td>
                                <td class="px-4 py-2">{{ $user->role}}</td>
                                <td class="px-4 py-2">
                                    <!-- Actions for each user -->
                            <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">&nbsp;<i class="fas fa-trash-alt"></i>&nbsp;
                            
                            </button>
                            </form><br>
                            <a href="{{ route('admin.users.show', ['id' => $user->id]) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                <i class="far fa-eye mr-2"></i>
                            </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "paginate": {
                    "previous": '<button class="btn btn-primary prev-btn"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>&nbsp;Prev</button>&nbsp;',
                    "next": '&nbsp;<button class="btn btn-primary next-btn">Next&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i</button>'
                }
            },
            "lengthMenu": [10, 25, 50, 100],
            "drawCallback": function() {
                var dataTable = this.api();
                $(dataTable.table().container()).find('.dataTables_paginate .pagination .prev-btn').addClass('btn btn-primary');
                $(dataTable.table().container()).find('.dataTables_paginate .pagination .next-btn').addClass('btn btn-primary');
            },
            "initComplete": function() {
                var dataTable = this.api();
                $(dataTable.table().container()).find('.dataTables_filter input').addClass('text-right');
            }
        });
    });
</script>


    </script>

    <style>
        .dataTables_filter {
            text-align: right;
            margin-bottom: 10px;
        }

        .dataTables_paginate {
            text-align: right;
        }

        .dataTables_paginate .pagination {
            display: inline-block;
            padding: 0;
            margin: 0;
        }

        .dataTables_paginate .pagination li {
            display: inline;
            margin-right: 5px;
        }

        .dataTables_paginate .pagination li a {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            background-color: #f2f2f2;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .dataTables_paginate .pagination li a:hover {
            background-color: #ddd;
        }

        .dataTables_paginate .pagination .active a {
            background-color: #337ab7;
            color: white;
        }

        /* Custom pagination icons */
        .prev-icon:before {
            content: "<";
        }

        .next-icon:before {
            content: ">";
        }
    </style>

</x-app-layout>

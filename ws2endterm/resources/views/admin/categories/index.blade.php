<x-app-layout>
<x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Management') }}
        </h2>
        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        <i class="fa fa-plus" aria-hidden="true"></i>  Create Category
        </a>
    </div>
</x-slot>
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-left"> 
                <table id="users-table" class="min-w-full table">
                    <thead>
                        <tr>
                            <th class="py-2">ID</th>
                            <th class="py-2">Title</th>
                            <th class="py-2">Date Created</th>
                            <th class="py-2">Date Updated</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="px-4 py-2">{{ $category->id }}</td>
                                <td class="px-4 py-2">{{ $category->title }}</td>
                                <td class="px-4 py-2">{{ $category->created_at }}</td>
                                <td class="px-4 py-2">{{ $category->updated_at }}</td>
                                <td class="px-4 py-2">
                                <form action="{{ route('admin.categories.edit', ['category' => $category->id]) }}" method="GET">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                <i class="fas fa-edit"></i>
                            </button>
                        </form><br>

                            <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
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
                    "next": '&nbsp;<button class="btn btn-primary next-btn">Next&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i</button>&nbsp;'
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

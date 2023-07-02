<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('admin.forums.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
            </a>
            {{ $post->title }} {{ __('Comments') }}      ({{ count($post->comments) }})
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-left">
          

                    <table id="comments-table" class="min-w-full table">
                        <thead>
                            <tr>
                                <th class="py-2">ID</th>
                                <th class="py-2">Content</th>
                                <th class="py-2">Image</th>
                                <th class="py-2">Files</th>
                                <th class="py-2">Commented by</th>
                                <th class="py-2">Date Created</th>
                                <th class="py-2">Date Updated</th>
                                <th class="py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post->comments as $comment)
                      
                    
                                <tr>
                                    <td class="px-4 py-2">{{ $comment->id }}</td>
                                    <td class="px-4 py-2">{{ $comment->content }}</td>
                                    <td class="px-4 py-2">
                                        @if ($comment->image)
                                            <div class="mt-4">
                                                <img src="{{ asset('storage/'.$comment->image) }}" alt="Comment Image" height="100" width="100">
                                            </div>
                                        @else
                                            <p>No image available</p>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($comment->files && count(json_decode($comment->files)) > 0)
                                            <div class="alert alert-primary" role="alert">
                                                <ul>
                                                    @foreach(json_decode($comment->files) as $file)
                                                        <li>
                                                            <a href="{{ route('downloadCommentFile', ['filename' => $file->name]) }}" download>{{ $file->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <p>No files available</p>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @php
                                            $user = \App\Models\User::find($comment->user_id);
                                            $username = $user ? $user->name : 'Unknown User';
                                        @endphp
                                        {{ $username }}
                                    </td>
                                    <td class="px-4 py-2">{{ $comment->created_at }}</td>
                                    <td class="px-4 py-2">{{ $comment->updated_at }}</td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('admin.comments.destroy', ['comment' => $comment->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')">
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
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#comments-table').DataTable({
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
    .prev-icon:before {
        content: "<";
    }

    .next-icon:before {
        content: ">";
    }
</style>

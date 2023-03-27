<x-dashboard.layout>
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Form Todo</h4>
                        <p>Enter your todo</p>

                        <form class="form form-vertical mt-4" method="POST" action="{{ route('todos.store') }}">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Todo</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Todo " required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Project</label>
                                            <select class="form-select" aria-label="Select project" name="project_id" id="project_id" required>
                                                <option selected value disabled>Open this select menu</option>
                                                @foreach ($projects as $key=>$project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">User</label>
                                            <select class="form-select" aria-label="Select project" name="user_id" id="user_id" required>
                                                <option selected value disabled>Open this select menu</option>
                                                @foreach ($users as $key=>$user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button id="reset" type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Data Todos</h4>
                        <p>Here is data that you have submitted</p>

                        @if($todos->count() == 0)
                        <x-no-data-found></x-no-data-found>
                        @else
                        <table class="table" id="table-product">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Assigned User</th>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Todo name</th>
                                    <th scope="col">Crated At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $key => $todo)
                                <tr>
                                    <td>{{ $todos->firstItem()+$key }}</td>
                                    <td>{{ $todo->project->user->name ?? "" }}</td>
                                    <td>{{ $todo->project->name ?? "" }}</td>
                                    <td>{{ $todo->name }}</td>
                                    <td>{{ $todo->created_at }}</td>
                                    <td>{{ $todo->updated_at }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#exampleModal" data-todo="{{ $todo }}">
                                            Edit
                                        </button>
                                        <button type="submit" form="form-delete" class="btn btn-danger btn-delete" data-id="{{ $todo->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{ $todos->withQueryString()->links() }}
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Todo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" class="form form-vertical row g-3" method="POST" action="{{ route('todos.update', ':id') }}">
                        @csrf
                        @method("PUT")
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Todo</label>
                                        <input type="text" class="form-control" name="name" id="edit-name" placeholder="Todo " required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Project</label>
                                        <select class="form-select" aria-label="Select project" name="project_id" id="edit-project-id" required>
                                            <option selected value disabled>Open this select menu</option>
                                            @foreach ($projects as $key=>$project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 my-4">
                                    <ul class="list-group list-group-flush" id="comment-list">
                                        <li class="list-group-item">An item</li>
                                        <li class="list-group-item">A second item</li>
                                        <li class="list-group-item">A third item</li>
                                        <li class="list-group-item">A fourth item</li>
                                        <li class="list-group-item">And a fifth one</li>
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <label for="comment" class="form-label">New Comment</label>
                                    <textarea class="form-control" id="comment" name="body" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-edit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('todos.destroy', ':id') }}" method="POST" id="form-delete">
        @csrf
        @method("DELETE")
    </form>

    @push("scripts")
    <script>
        $(function () {
            $("#project_id").selectize({});
            $("#user_id").selectize({});
            let editSelect = $("#edit-project-id").selectize({})[0].selectize;
            $(".btn-edit").on("click", function(){
                const todo = $(this).data("todo");
                const newUrl = $("#form-edit").attr("action").replace(":id", todo.id);

                $("#comment-list").empty();
                todo.comment.forEach(element => {
                    $("#comment-list").append(`<li class='list-group-item'>${element.body}</li>`);
                });

                $("#form-edit").attr("action", newUrl);
                $("#edit-name").val(todo.name);
                editSelect.setValue(todo.project_id);
            })

            $(".btn-delete").on("click", function(e){
                e.preventDefault();
                const id = $(this).data("id");
                const newUrl = $("#form-delete").attr("action").replace(":id", id);
                $("#form-delete").attr("action", newUrl);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form-delete").submit();
                    }
                })
            })
        });

    </script>
    @endpush
</x-dashboard.layout>
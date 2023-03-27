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
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Todo name</th>
                                    <th scope="col">Crated At</th>
                                    <th scope="col">Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $key => $todo)
                                <tr>
                                    <td>{{ $todos->firstItem()+$key }}</td>
                                    <td>{{ $todo->project->name ?? "" }}</td>
                                    <td>{{ $todo->name }}</td>
                                    <td>{{ $todo->created_at }}</td>
                                    <td>{{ $todo->updated_at }}</td>
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

    @push("scripts")
    <script>
        $(function () {
            $("#project_id").selectize({});
        });
    </script>
    @endpush
</x-dashboard.layout>
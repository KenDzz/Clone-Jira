@extends('layouts.default')

@section('content')
    <div class="main-content">
        <header class="header-content">
            <div class="action list-btn-dashboard">

            </div>
        </header>
        <div class="dashboard">
            <div class="row list-project">
                {{-- <div class="col-xl-3 col-sm-6 list-project">
                    <div class="card bg-light p-2" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <div class="member mt-2">
                                <p class="card-text">Member:</p>
                            </div>
                            <div class="row list-btn-action">
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-primary w-full">Go Tasks</a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-primary w-full">Update</a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="/" class="btn btn-danger w-full">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        <!-- Modal New Project-->
        <div class="modal fade" id="newProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-new-project">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Describes</label>
                                <textarea type="text" class="form-control" name="describes"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Select User</label>
                                <select id="select-user" name="users[]" multiple placeholder="Select a user..."
                                    autocomplete="off">
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-new-project">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Update Project-->
        <div class="modal fade" id="updateProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-update-project">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID</label>
                                <input type="text" class="form-control" name="id" id="id-update-project" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" id="name-update-project">
                            </div>
                            <div class="form-group">
                                <label>Describes</label>
                                <textarea type="text" class="form-control" name="describes" id="describes-update-project"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Select User</label>
                                <select id="select-user-update" name="users[]" multiple placeholder="Select a user..."
                                    autocomplete="off">
                                </select>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <label class="form-check-label">
                                    <input type="hidden" id="value-isexit-project" value="0">
                                    <input type="checkbox" class="form-check-input" name="is_exist"
                                        id="isexit-update-project" value="0">Open
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-update-form-project">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('js/dashboard.js') }}"></script>
@endsection

@extends('layouts.default')

@section('content')

<div class="main-content">
    <header class="header-content">
        <ul class="list list-inline">
            <li>
                <a href="" title="">
                    <span class="state red"></span>
                    <span>Task</span>
                </a>
            </li>
            <li>
                <a href="" title="">
                    <span class="state yellow"></span>
                    <span>Story</span>
                </a>
            </li>
            <li>
                <a href="" title="">
                    <span class="state green"></span>
                    <span>Bug</span>
                </a>
            </li>
        </ul>
        <div class="action list-btn-task">

        </div>
    </header>
    <div class="dashboard">
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <article class="board red">
                    <header>
                        <h4>Backlog <span class="count-backlog">(0)</span></h4>
                        <span class="icon flaticon-more-1"></span>
                    </header>
                    <div class="board-content">

                        <ul class="list backlog-content">
                        {{--  <li class="el">
                                <div class="task yellow">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                    <div class="task-estimate">
                                        <p>Start Time:</p>
                                        <p>Estimate Time:</p>
                                        <p>Due Time:</p>
                                    </div>
                                </div>
                            </li>
                            <li class="el">
                                <div class="task red">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li>
                            <li class="el">
                                <div class="task green">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li>
                            <li class="el">
                                <div class="task yellow">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li>
                            <li class="el">
                                <div class="task yellow">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li>
                            <li class="el">
                                <div class="task yellow">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li>--}}
                        </ul>
                    </div>
                </article>
            </div>
            <div class="col-xl-3 col-sm-6">
                <article class="board yellow">
                    <header>
                        <h4>In progress <span class="count-progress">(0)</span></h4>
                        <span class="icon flaticon-more-1"></span>
                    </header>
                    <div class="board-content">
                        <ul class="list backlog-progress">
                            {{-- <li>
                                <div class="task red">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="task green">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li>--}}
                        </ul>
                    </div>
                </article>
            </div>
            <div class="col-xl-3 col-sm-6">
                <article class="board green">
                    <header>
                        <h4>Review <span class="count-review">(0)</span></h4>
                        <span class="icon flaticon-more-1"></span>
                    </header>
                    <div class="board-content">
                        <ul class="list backlog-review">
                         {{--   <li>
                                <div class="task red">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="task green">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="task blue">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li>--}}
                        </ul>
                    </div>
                </article>
            </div>
            <div class="col-xl-3 col-sm-6">
                <article class="board blue">
                    <header>
                        <h4>Done <span class="count-done">(0)</span></h4>
                        <span class="icon flaticon-more-1"></span>
                    </header>
                    <div class="board-content">
                        <ul class="list backlog-done">
                            {{-- <li>
                                <div class="task red">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="task green">
                                    <header>
                                        <h3>Splash screen</h3>
                                        <span class="icon flaticon-link"></span>
                                    </header>
                                    <div class="task-content">
                                        The book itself is surprisingly thin and it's not really a book
                                        perse it's a compilation.
                                    </div>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

<!-- Modal New Task-->
<div class="modal fade " id="newTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="form-new-task">
                <div class="form-group">
                    <label for="exampleInputEmail1">Project ID</label>
                    <input type="text" class="form-control project-id-new-task" value="" disabled>
                    <input type="hidden" class="form-control project-id-new-task-hidden" name="project_id" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                    <select id="select-category" name="category_id" placeholder="Select a Category..." autocomplete="off">
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Level</label>
                    <select id="select-level" name="level_id" placeholder="Select a Level..." autocomplete="off">
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Priority</label>
                    <select id="select-priority" name="priority_id" placeholder="Select a Priority..." autocomplete="off">
                    </select>
                </div>
                <div class="form-group">
                    <label>Select User</label>
                    <select id="select-user" name="users[]" multiple placeholder="Select a user..."
                        autocomplete="off">
                    </select>
                </div>
                <div class="form-group">
                    <label>Estimate</label>
                    <input type="text" class="form-control" name="datetimes" />
                </div>
                <div class="form-group">
                    <label>Describes</label>
                    <textarea id="editor" class="mt-1" ></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn-save-new-task">Save changes</button>
        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function() {
          $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
              format: 'M/DD/YYYY hh:mm A'
            }
          });
        });
        </script>
    <script src="{{ url('js/task.js') }}"></script>

@endsection

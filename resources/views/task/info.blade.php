@extends('layouts.default')

@section('content')

<div class="main-content bg-white">
    <header class="header-content">
        <ul class="list list-inline">
            <li>
                <h3 class="text-white p-2">Update Task</h3>
            </li>
        </ul>
        <div class="action list-btn-update-task">
            <button class="btn btn-blue btn-previous-task">Previous Progress <span class="flaticon-previous"></span></button>
            <button class="btn btn-blue btn-next-task">Next Progress  <span class="flaticon-next"></span></button>

        </div>
    </header>
    <div class="dashboard">
        <div class="row p-3">
            <form class="form-update-task w-100">
                <div class="form-group">
                    <label for="exampleInputEmail1">Task ID</label>
                    <input type="text" class="form-control task-id" value="" disabled>
                    <input type="hidden" class="form-control task-id-hidden" name="id" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" id="task-name">
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
                    <input type="text" class="form-control" name="datetimes"  id="estimate-date" />
                </div>
                <div class="form-group form-editor">
                    <label>Describes</label>
                    <textarea id="editor" class="mt-1" ></textarea>
                </div>
                <div class="content-desc">
                </div>
            </form>
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
    <script src="{{ url('js/task.update.js') }}"></script>

@endsection

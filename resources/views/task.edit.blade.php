@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Task</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('tasks.update', $task->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $task->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description" required>{{ $task->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                <label for="start_date" class="col-md-4 control-label">Start Date</label>

                                <div class="col-md-6">
                                    <input id="start_date" type="date" class="form-control" name="start_date" value="{{ $task->start_date }}" required>

                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                <label for="end_date" class="col-md-4 control-label">End Date</label>

                                <div class="col-md-6">
                                    <input id="end_date" type="date" class="form-control" name="end_date" value="{{ $task->end_date }}" required>

                                    @if ($errors->has('end_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('repeat_interval') ? ' has-error' : '' }}">
                                <label for="repeat_interval" class="col-md-4 control-label">Repeat Interval</label>

                                <div class="col-md-6">
                                    <select id="repeat_interval" class="form-control" name="repeat_interval" required>
                                        <option value="daily" {{ $task->repeat_interval == 'daily' ? 'selected' : '' }}>Daily</option>
                                        <option value="weekly" {{ $task->repeat_interval == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                        <option value="monthly" {{ $task->repeat_interval == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                        <option value="yearly" {{ $task->repeat_interval == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

                                       
